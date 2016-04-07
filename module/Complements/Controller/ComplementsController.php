<?php
//http://framework.zend.com/manual/2.0/en/modules/zend.http.client.html
namespace Complements\Controller;

use Complements\Form\SearchForm;
use Complements\Form\AlertsForm;
use Complements\Form\AlertsFilter;
use Complements\Form\ContactsForm;
use Complements\Form\ContactsFilter;
use Complements\Form\RecommendFilter;
use Complements\Form\RecommendForm;
use Zend\Mvc\Controller\AbstractActionController;
use Doctrine\ORM\Tools\Pagination\Paginator as DoctrinePaginator;
use DoctrineORMModule\Paginator\Adapter\DoctrinePaginator as PaginatorAdapter;
use Zend\Paginator;
use Application\Module;
use Zend\View\Model\ViewModel;
use Zend\Crypt\Password\Bcrypt;
use Zend\Session\Container;
use Zend\Authentication\AuthenticationService;

use Zend\Mail\Transport\Smtp as SmtpTransport;
use Zend\Mail\Transport\SmtpOptions;
use Zend\Mail;
use Zend\Mime\Part as MimePart; 
use Zend\Mime\Message as MimeMessage;

use Application\library\Utils;


class ComplementsController extends AbstractActionController
{
    /**
    * @var Doctrine\ORM\EntityManager
    */
    protected $em;
    protected $em_user;
    protected $em_ccd;

    public function setEntityManager(EntityManager $em)
    {
        $this->em = $em;
    }
 
    public function getEntityManager()
    {
        if (null === $this->em) {
            $this->em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_alternative_com');
        }
        return $this->em;
    }

    public function setEntityManagerCcd(EntityManager $em_ccd)
    {
        $this->em_ccd = $em_ccd;
    }
 
    public function getEntityManagerCcd()
    {
        if (null === $this->em_ccd) {
            $this->em_ccd = $this->getServiceLocator()->get('doctrine.entitymanager.orm_alternative_ccd');
        }
        return $this->em_ccd;
    }
    
    public function setEntityManagerUser(EntityManager $em_user)
    {
        $this->em_user = $em_user;
    }
 
    public function getEntityManagerUser()
    {
        if (null === $this->em_user) {
            $this->em_user = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
        }
        return $this->em_user;
    }

    public function searchAction()
    {
        $em = $this->getEntityManager();
        
        $page = $this->params('page', null);
        $module = new Module();
        $config = $module->getCustomConfig();
        $globalPagination = $config['paginate'];
        
        $memcache = $this->getServiceLocator()->get('my_memcached_alias');
        $form = new searchForm($em, $memcache);
        
        $query = array();
        
        $request = $this->getRequest();
        $getValues = $request->getQuery();
        
        $q = $getValues->q;
        $options = $getValues->tb;
        $ieSlug = $getValues->ie_type;
        $courseSlug = $getValues->course_type;
        $typeSlug = $getValues->t;

        $utils = new Utils();
        $words = $utils->normalizeWords($q);

        if(!is_null($words)){
            $query = ($options == '0') ? $em->getRepository('Courses\Entity\Courses')->getCoursesBySearch($words, $courseSlug) : $em->getRepository('Institutions\Entity\Institutions')->getIesBySearch($words, $ieSlug);
            //seteando el formulario
            $form->setData(array('q'=>$q, 'tb'=>$options, 'course_type'=>$courseSlug, 'ie_type'=>$ieSlug));
        }

        $paginatorAdapter = new PaginatorAdapter(new DoctrinePaginator($query));
        $paginator = new Paginator\Paginator($paginatorAdapter);
        $paginator->setCurrentPageNumber($page);
        $paginator->setItemCountPerPage($globalPagination); //cantidad de filas (Se definirá como variable global en el Module.php de Aplication)
        
        //cantidad de cursos agrupados por tipo (opción: afinar busqueda)
        
        //$group = ($options == '0') ? $em->getRepository('Courses\Entity\Courses')->getCountCoursesByType($courseSlug) : $em->getRepository('Institutions\Entity\Institutions')->getCountIeByType();
        $group = ($options == '0') ? $em->getRepository('Courses\Entity\Courses')->getCountCoursesByType($words) : $em->getRepository('Institutions\Entity\Institutions')->getCountIeByType($words);
        
        $title = '';
        if($options == "0" && $courseSlug != 'todo'){
            $typeCourse = $em->getRepository('Courses\Entity\TypeCourses')->findOneBy(array('slug'=>$courseSlug));
            if(is_null($typeCourse)){
                $this->getResponse()->setStatusCode(404);
                return;
            }
            $title = utf8_encode($typeCourse->getName()).' de '.$q.' en '.$config['country_name'];
        }elseif($options == "0" ){
            $title = $q.' en '.$config['country_name'];    
        }
        
        if($options == "1" && $ieSlug != 'instituciones'){
            $typeIe = $em->getRepository('Institutions\Entity\TypeInstitutions')->findOneBy(array('slug'=>$ieSlug));
            if(is_null($typeIe)){
                $this->getResponse()->setStatusCode(404, 'el tipo no existe');
                return;
            }
            $title = utf8_encode($typeIe->getName()).' : '.$q;
        }elseif($options == "1" ){
            $title = $q.' en '.$config['country_name'];    
        }

        $metaDescription = '';
        $slugWords = str_replace(' ', '-', $words);
        $this->layout()->headerTitle = $title;
        return array('paginator'=>$paginator, 'searchForm'=>$form, 'option'=>$options, 'typeGroup'=>$group, 'ieSlug'=>$ieSlug, 'courseSlug'=>$courseSlug, 'words'=>$slugWords, 'title'=>$title, 'metaDescription'=>$metaDescription);
    }

    public function ieSearchAction()
    {
        $em = $this->getEntityManager();
        
        $ieSlug = $this->params('typeSlug', null);
        $q = $this->params('words', null);
        $page = $this->params('page', null);
        $module = new Module();
        $config = $module->getCustomConfig();
        $globalPagination = $config['paginate'];
        $words = str_replace('-',' ',$q);
        $memcache = $this->getServiceLocator()->get('my_memcached_alias');
        $form = new SearchForm($em, $memcache);
        $form->setData(array('q'=>$words, 'tb'=>'1', 'course_type'=>'', 'ie_type'=>$ieSlug));
        $query = array();
        
        $request = $this->getRequest();
        
        $query = $em->getRepository('Institutions\Entity\Institutions')->getIesBySearch($words, $ieSlug);
        $paginatorAdapter = new PaginatorAdapter(new DoctrinePaginator($query));
        $paginator = new Paginator\Paginator($paginatorAdapter);
        $paginator->setCurrentPageNumber($page);
        $paginator->setItemCountPerPage($globalPagination); //cantidad de filas (Se definirá como variable global en el Module.php de Aplication)
        $title = '';
        //cantidad de cursos agrupados por tipo (opción: afinar busqueda)
        $group = $em->getRepository('Institutions\Entity\Institutions')->getCountIeByType($words);

        if($ieSlug != 'instituciones'){
            $typeIe = $em->getRepository('Institutions\Entity\TypeInstitutions')->findOneBy(array('slug'=>$ieSlug));
            if(is_null($typeIe)){
                $this->getResponse()->setStatusCode(404);
                return;
            }
            $title = utf8_encode($typeIe->getName()).' : '.$words;
        }else{
            $title = $q.' en '.$config['country_name'];
        }

        $metaDescription = '';
        $this->layout()->headerTitle = $title;
        $view = new ViewModel(array('paginator'=>$paginator, 'ieSlug'=>$ieSlug,  'courseSlug'=>'', 'searchForm'=>$form, 'option'=>'1', 'words'=>$q, 'typeGroup'=>$group, 'title'=>$title, 'metaDescription'=>$metaDescription));
        $view->setTemplate('complements/complements/search.phtml'); 
        return $view;
        
    }

    public function courseSearchAction()
    {
        $em = $this->getEntityManager();
        
        $courseSlug = $this->params('typeSlug', null);
        $q = $this->params('words', null);
        $page = $this->params('page', null);
        $module = new Module();
        $config = $module->getCustomConfig();
        $globalPagination = $config['paginate'];
        $words = str_replace('-',' ',$q);
        $memcache = $this->getServiceLocator()->get('my_memcached_alias');
        $form = new SearchForm($em, $memcache);
        $form->setData(array('q'=>$words, 'tb'=>'0', 'course_type'=>$courseSlug, 'ie_type'=>''));
        
        $request = $this->getRequest();
        $query = $em->getRepository('Courses\Entity\Courses')->getCoursesBySearch($words, $courseSlug);
        $paginatorAdapter = new PaginatorAdapter(new DoctrinePaginator($query));
        $paginator = new Paginator\Paginator($paginatorAdapter);
        $paginator->setCurrentPageNumber($page);
        $paginator->setItemCountPerPage($globalPagination); //cantidad de filas (Se definirá como variable global en el Module.php de Aplication)
        $title = '';
        
        $group = $em->getRepository('Courses\Entity\Courses')->getCountCoursesByType($words);

        if($courseSlug != 'todo'){
            $typeCourse = $em->getRepository('Courses\Entity\TypeCourses')->findOneBy(array('slug'=>$courseSlug));
            if(is_null($typeCourse)){
                $this->getResponse()->setStatusCode(404);
                return array('message'=>'el tipo de curso no existe', 'myVar'=>'hola mundo!!!');
            }
            $title = utf8_encode($typeCourse->getName()).' de '.$q.' en '.$config['country_name'];
        }else{
            $title = $q.' en '.$config['country_name'];
        }
        
        $metaDescription = '';
        $this->layout()->headerTitle = $title;
        $view = new ViewModel(array('paginator'=>$paginator, 'ieSlug'=>'',  'courseSlug'=>$courseSlug, 'searchForm'=>$form, 'option'=>'0', 'words'=>$q, 'typeGroup'=>$group, 'title'=>$title, 'metaDescription'=>$metaDescription));
        $view->setTemplate('complements/complements/search.phtml'); 
        return $view;
        
    }

    public function ubigeoFilterAction()
    {

        $em = $this->getEntityManager();
        
        $request = $this->getRequest();
        $dist_choices = array();
        
        $parent_id = (isset($_GET['parent_id'])) ? $_GET['parent_id'] : null;

        $obj = $this->em->getRepository('Complements\Entity\Ubigeo')->getUbigeo($parent_id);
        
        foreach($obj as $p) $dist_choices[] = array($p->getId(), utf8_encode($p->getName()));    
        
        echo json_encode($dist_choices);
        exit;        
    }

    public function subscribeCcdAction()
    {

        $em_ccd = $this->getEntityManagerCcd();
        $request = $this->getRequest();
        $data = array();
        if ($request->isPost()) {
            $email = $request->getPost()->email;
            
            if(!filter_var($email, FILTER_VALIDATE_EMAIL) or $email == ''){
                $data = array('success'=>false, 'message'=>'Ingresa un email correcto por favor', 'email'=>$email);
            }else{
                $subscriber = $em_ccd->getRepository('Complements\Entity\CcdSubscribers')->findOneBy(array('email'=>$email));
                if($subscriber){
                    $data = array('success'=>false, 'message'=>'El email ya existe');
                }else{
                    $ccd =  new \Complements\Entity\CcdSubscribers();
                    $ccd->setEmail($email);
                    $ccd->setStatus(true);
                    $ccd->setCreatedAt(new \DateTime());
                    $ccd->setUpdatedAt(new \DateTime());
                    $em_ccd->persist($ccd);
                    $em_ccd->flush();
                    $data = array('success'=>true, 'message'=>'Se registró correctamente');
                }
            }
        }

        echo json_encode($data);
        exit;        
    }

    public function loadAlertAction()
    {
        $em_user = $this->getEntityManagerUser();
        $request = $this->getRequest();
        $data = array();
        if ($request->isPost()) {
            $email = $request->getPost()->email;
            if(!filter_var($email, FILTER_VALIDATE_EMAIL) or $email == ''){
                $data = array('success'=>false, 'message'=>'Ingresa un email correcto por favor', 'email'=>$email);
            }else{
                $user = $em_user->getRepository('Users\Entity\User')->findOneBy(array('email'=>$email));
                //if($user){$data = array('success'=>false, 'message'=>'El email ya existe');}
                $session = new Container('alertEmail');
                $session->userEmail = $email;
                $data = array('success'=>true, 'message'=>'Habilitado para crear alerta');
            }
        }
        echo json_encode($data);
        exit;        
    }

    public function contactAction()
    {
        
        $em = $this->getEntityManager();
        $memcache = $this->getServiceLocator()->get('my_memcached_alias');
        $searchForm = new SearchForm($em, $memcache);
        $form = new ContactsForm();

        $request = $this->getRequest();
        $data = array();
        if ($request->isPost()) {
            $contactsFilter = new ContactsFilter();
            $form->setInputFilter($contactsFilter->getInputFilter($request->getPost()));
            $form->setData($request->getPost());
            if ($form->isValid()) {
                $data = $form->getData();

                $module = new Module();
                $config = $module->getCustomConfig();
                $emailConfig = $config['emails'];
                
                $from = $data['txtEmail'];
                $to = $emailConfig['recipient'];
                $subject = ''.COUNTRY_TITLE.' - Notificación desde el formulario de contacto';
                $content = 'Se ha recibio un mensaje desde el formulario de contacto, datos:<br /><br />';
                $content .= '<b>Nombres: </b>'.$data['txtNombres'].'<br>';
                $content .= '<b>Apellidos: </b>'.$data['txtApellidos'].'<br>';
                $content .= '<b>Email: </b>'.$data['txtEmail'].'<br>';
                $content .= '<b>Teléfono: </b>'.$data['txtTelefono'].'<br>';
                $content .= '<b>Asunto: </b>'.$data['txtAsunto'].'<br>';
                $content .= '<b>Mensaje: </b>'.$data['txtMensaje'].'<br>';

                $this->renderer = $this->getServiceLocator()->get('ViewRenderer');      
                $content = $this->renderer->render('emails/basic_template', array('content'=>$content)); 
                $email = $this->sendEmail($from, $to, $subject, $content);
                
                $this->flashMessenger()->setNamespace('success')->addMessage('Gracias por contactarse con nosotros, en breve estaremos comunicándonos con Ud.');    
                
                return $this->redirect()->toRoute('contact');
                
            }else{
                //var_dump($form->getMessages());
                $this->flashMessenger()->setNamespace('error')->addMessage('Hubo un error, por favor verifica tus datos y vuelve a intentarlo.');
                
            }
        }

        $this->layout()->headerTitle = 'Contáctenos';

        return array('searchForm'=>$searchForm, 'form'=>$form);
    }

    public function recommendAction()
    {
        $em = $this->getEntityManager();
        $memcache = $this->getServiceLocator()->get('my_memcached_alias');
        $searchForm = new SearchForm($em, $memcache);
        $form = new RecommendForm();
        $request = $this->getRequest();

        if ($request->isPost()) {
            
            $recFilter = new RecommendFilter();
            $form->setInputFilter($recFilter->getInputFilter());
            $form->setData($request->getPost());

            if ($form->isValid()) {
                $data = $request->getPost();
                $module = new Module();
                $config = $module->getCustomConfig();
                $emailConfig = $config['emails'];
                $from = $data['txtEmail'];
                $subject = 'Recomendación de tu amigo';

                $emailsTo = array();
                for($i =1; $i <= 20; $i++) {
                    if($data['txtPara'.$i] != ''){
                        array_push($emailsTo, $data['txtPara'.$i]);
                        $to = $data['txtPara'.$i];
                        $content = '<b>Recomenación a company</b><br><br>';
                        $content = $content.'<b>Tu amigo:</b> '.$data['txtNombre'].' desea que conozcas company.com <br>';
                        if($data['txtMensaje'] != '')
                            $content = $content.'<b>Mensaje:</b> '.$data['txtMensaje'].'<br>';
                        $content = $content.'Si tienes alguna consulta, por favor revisa las preguntas frecuentes de nuestra página en: <a href="http://www.company.com.pe/ct/preguntas-frecuentes">http://www.company.com.pe/ct/preguntas-frecuentes</a>.<br><br><br>';
                        

                        $this->renderer = $this->getServiceLocator()->get('ViewRenderer');      
                        //$content = $this->renderer->render('complements/emails/basic_template', array('content'=>$content)); 
                        $content = $this->renderer->render('emails/basic_template', array('content'=>$content)); 
                        $email = $this->sendEmail($from, $to, $subject, $content);
                    }                        
                }

                $this->flashMessenger()->setNamespace('success')->addMessage('Gracias por recomendar company');
                $this->redirect()->toRoute('recommend');

            }else{
                //var_dump($form->getMessages());
                $this->flashMessenger()->setNamespace('error')->addMessage('Error al ingresar los datos, revice el formulario  por favor');
            }
        }

        return array('searchForm'=>$searchForm, 'form'=>$form);
    }

    public function myAlertsAction()
    {
        $auth = new AuthenticationService();
        $userId = $auth->getIdentity(); //Id del usuario logueado en el momento
        if(is_null($userId)){
            $this->redirect()->toRoute('home');
        }
        $em = $this->getEntityManager();        
        $memcache = $this->getServiceLocator()->get('my_memcached_alias');
        $searchForm = new SearchForm($em, $memcache);
        $em_user = $this->getEntityManagerUser();
        $alerts = $em_user->getRepository('Users\Entity\Search')->getAlertsByUserId($userId);
        $success = false;

        $request = $this->getRequest();
        if ($request->isPost()) {
            $ids = $request->getPost()->ids;
            if(!is_null($ids)){
                foreach($ids as $id){
                    $search = $em_user->getRepository('Users\Entity\Search')->find($id);
                    //$alert = $search->getAlert();

                    $em_user->remove($search);
                    //$em_user->remove($alert);
                    $em_user->flush();    
                    $success = true;
                }
            }
            if($success){
                $this->flashMessenger()->setNamespace('success')->addMessage('Las alertas se eliminaron con éxito.');
                $this->redirect()->toRoute('my_alerts');
            }
        }

        //var_dump($alerts);
        return array('searchForm'=>$searchForm, 'alerts'=>$alerts);
    }

    public function createAlertsAction()
    {
        $em = $this->getEntityManager();
        $em_user = $this->getEntityManagerUser();
        $memcache = $this->getServiceLocator()->get('my_memcached_alias');
        $auth = new AuthenticationService();
        $userId = $auth->getIdentity(); //Id del usuario logueado en el momento
        $request = $this->getRequest();
        $search_name = $request->getQuery()->n;
        $cookie = $this->getServiceLocator()->get('time_expire_cookie');

        $searchForm = new SearchForm($em, $memcache);
        $form = new AlertsForm($em, $memcache, $cookie);

        $session = new Container('alertEmail');
        $sessionEmail = $session->userEmail;
        $form->setData(array('txtEmail'=>$sessionEmail));
        
        
        //$data = array();
        $data = $request->getPost();
        $message = ''; $new_user = true;

        $module = new Module();
        $config = $module->getCustomConfig();

        
        if(!is_null($search_name)){
            $form->setData(array('txtTag1'=>$search_name));
        }
        
        
        if ($request->isPost()) {
            $alertsFilter = new AlertsFilter();
            $form->setInputFilter($alertsFilter->getInputFilter($userId, $em_user, $request->getPost()));
            $form->setData($data);

            if ($form->isValid()) {
                
                $group_types = $config['group_types'];
                $email = $data['txtEmail'];
                
                //Obteniendo los tipos agrupados en base a los criterios definidos en Application/Module.php
                $tipos = array();
                foreach ($data['tipo_curso'] as $tipo) {
                    foreach($group_types[$tipo] as $i)
                        array_push($tipos, $i);
                }
                
                //Temas conatenados para los tags
                $temas = array();
                for($i =1; $i <= 3; $i++) {
                    if($data['txtTag'.$i] != '')
                        array_push($temas, $data['txtTag'.$i]);
                }

                $ubigeo_ids = \Zend\Json\Json::encode($data['ciudades']);
                $tipos_check = \Zend\Json\Json::encode($data['tipo_curso']);
                $tipo_ids = \Zend\Json\Json::encode($tipos);
                $tags = \Zend\Json\Json::encode($temas);
                
                if(!is_null($userId)){ //Si ya está logueado, ya no lo creamos como nuevo usuario
                    $user = $em_user->getRepository('Users\Entity\User')->find($userId);
                    $new_user = false;
                }else{
                    //Registrar un usuario sin perfil (con un password generado)
                    //$password = $config['password_temp_user'];
                    $password = uniqid();
                    $group_user_site_id = $config['group_user_site_id'];

                    $user = new \Users\Entity\User();
                    $date_now = new \DateTime("now", new \DateTimeZone('America/Lima'));
                    $bcrypt = new Bcrypt;
                    $bcrypt->setCost(14);
                    $user->setEmail($email);
                    $user->setStatus(false);
                    $user->setCreatedAt(new \DateTime());
                    $user->setPassword($bcrypt->create($password));
                    $group = $em_user->getRepository('Users\Entity\Group')->find($group_user_site_id);
                    $user->setGroup($group);
                    $em_user->persist($user);
                    $em_user->flush();
                }
                
                //Alertas
                $alert = new \Users\Entity\Alerts();
                $alert->setStatus(true);
                $alert->setFrecuency($data['frecuencia']);
                $em_user->persist($alert);
                $em_user->flush();

                //Registrando las busquedas
                $search = new \Users\Entity\Search();
                $search->setUser($user);
                $search->setAlert($alert);
                $search->setName($data['txtName']);
                $search->setDescription($data['txtDescripcion']);
                $search->setEmail($email);
                $search->setOrigin('crear-alertas');
                $search->setCountry($config['country']);
                $search->setUbigeosId($ubigeo_ids);
                $search->setTypesForCheck($tipos_check);
                $search->setTypesId($tipo_ids);
                $search->setStatus(true);
                $search->setTags($tags);
                $search->setCreatedAt(new \DateTime());
                $search->setUpdatedAt(new \DateTime());
                $em_user->persist($search);
                $em_user->flush();

                if ($new_user){
                    $message = 'Has creado tu alerta correctamente. Hemos enviado a <b>'.$email.'</b> los datos para <a href="'.$this->url('login').'">iniciar sesión</a> y crear o cambiar alertas.';
                    //Enviando email
                    $emailConfig = $config['emails'];
                    //$from = $email;
                    $from = $emailConfig['from'];
                    $to = $email;
                    $subject = 'Alertas de company';
                    $content = '<b>Bienvenido a company</b><br><br>';
                    $content = $content.'Los datos para iniciar sesión y crear o cambiar alertas son los siguientes:<br><br>';
                    $content = $content.'<b>Usuario:</b> '.$to.'<br>';
                    $content = $content.'<b>Contraseña Temporal:</b> '.$password.'<br><br>';
                    $content = $content.'Ingresa a <a href="http://'.COUNTRY_URL.'/login">'.COUNTRY_URL.'/login</a> para actualizar tus datos.<br><br>';
                    $content = $content.'Si tienes alguna consulta, por favor revisa las preguntas frecuentes de nuestra página en: <a href="http://www.company.com.pe/ct/preguntas-frecuentes">http://www.company.com.pe/ct/preguntas-frecuentes</a>.<br><br><br>';

                    $this->renderer = $this->getServiceLocator()->get('ViewRenderer');      
                    //$content = $this->renderer->render('complements/emails/basic_template', array('content'=>$content)); 
                    $content = $this->renderer->render('emails/basic_template', array('content'=>$content)); 
                    $email = $this->sendEmail($from, $to, $subject, $content);
                }else{
                    $message = 'Has creado tu alerta correctamente. <a href="'.$this->url('my_alerts').'">Administrar</a>.';
                }
                
                $this->flashMessenger()->setNamespace('success')->addMessage($message);
                $this->redirect()->toRoute('alerts');
                //$this->redirect()->toRoute('my_alerts');

            }else{
                //var_dump($form->getMessages());
                $this->flashMessenger()->setNamespace('error')->addMessage('Error al ingresar los datos, revice el formulario  por favor');
            }
        }
        
        return array('searchForm'=>$searchForm, 'form'=>$form, 'principal_cities'=>$config['principal_cities'], 'ubigeos'=>array(), 'id'=>null);
    }

    public function editAlertsAction()
    {
        $em = $this->getEntityManager();
        $em_user = $this->getEntityManagerUser();
        $memcache = $this->getServiceLocator()->get('my_memcached_alias');
        $auth = new AuthenticationService();
        $userId = $auth->getIdentity(); //Id del usuario logueado en el momento

        $id = $this->params('id', null);
        $searchForm = new SearchForm($em, $memcache);
        $form = new AlertsForm($em, $memcache);
        $title = 'Editar mis alertas';

        $module = new Module();
        $config = $module->getCustomConfig();
        
        //$alert = $em_user->getRepository('Users\Entity\Alerts')->find($id);
        $search = $em_user->getRepository('Users\Entity\Search')->find($id);
        
        $tags = json_decode($search->getTags());
        $ubigeos = json_decode($search->getUbigeosId());
        $types = json_decode($search->getTypesId());      
        $types_check = json_decode($search->getTypesForCheck());      

        $group_types = $config['group_types'];
        $tag1 = (isset($tags[0])) ? $tags[0] : '';
        $tag2 = (isset($tags[1])) ? $tags[1] : '';
        $tag3 = (isset($tags[2])) ? $tags[2] : '';
        $data_bd = array('txtTag1'=>$tag1, 'txtTag2'=>$tag2, 'txtTag3'=>$tag3, 'ciudades'=>$ubigeos, 'tipo_curso'=>$types_check, 'txtName'=>$search->getName(), 'txtDescripcion'=>$search->getDescription(), 'txtEmail'=>$search->getEmail(), 'frecuencia'=>$search->getAlert()->getFrecuency()); 

        $form->setData($data_bd);
        
        $request = $this->getRequest();
        $data = $request->getPost();
        if ($request->isPost()) {
            $alertsFilter = new AlertsFilter();
            $form->setInputFilter($alertsFilter->getInputFilter());
            $form->setData($data);

            if ($form->isValid()) {
                //Obteniendo los tipos agrupados en base a los criterios definidos en Application/Module.php
                $tipos = array();
                foreach ($data['tipo_curso'] as $tipo) {
                    foreach($group_types[$tipo] as $i)
                        array_push($tipos, $i);
                }
                
                //Temas conatenados para los tags
                $temas = array();
                for($i =1; $i <= 3; $i++) {
                    if($data['txtTag'.$i] != '')
                        array_push($temas, $data['txtTag'.$i]);
                }

                $ubigeo_ids = \Zend\Json\Json::encode($data['ciudades']);
                $tipo_ids = \Zend\Json\Json::encode($tipos);
                $tags = \Zend\Json\Json::encode($temas);
                $tipos_check = \Zend\Json\Json::encode($data['tipo_curso']);
                
                //Registrando las busquedas
                $search->setName($data['txtName']);
                $search->setDescription($data['txtDescripcion']);
                $search->setEmail($data['txtEmail']);
                $search->setUbigeosId($ubigeo_ids);
                $search->setTypesId($tipo_ids);
                $search->setTypesForCheck($tipos_check);
                $search->setTags($tags);
                $search->setUpdatedAt(new \DateTime());
                $search->getAlert()->setFrecuency($data['frecuencia']);
                $em_user->persist($search);
                $em_user->flush();                
                
                $this->flashMessenger()->setNamespace('success')->addMessage('Los datos fueron actualizados con éxito.');
                $this->redirect()->toRoute('alerts_edit', array('id'=>$id));
            }else{
                $this->flashMessenger()->setNamespace('error')->addMessage('Ocurrió un error al editar la alerta');
                //var_dump($form->getMessages());
            }
        }

        $view = new ViewModel(array('searchForm'=>$searchForm, 'form'=>$form, 'principal_cities'=>$config['principal_cities'], 'ubigeos'=>$ubigeos, 'id'=>$id));
        $view->setTemplate('complements/complements/create-alerts.phtml'); 
        return $view;
    }

   
    public function sendEmail($from, $to, $subject, $content){
        $output = array();
        try{

            $transport = $this->getServiceLocator()->get('mail_transport');
            //$memcache = $this->getServiceLocator()->get('my_memcached_alias');
            
            $html = new MimePart($content);  
            $html->type = "text/html";  
            $html->charset  = "utf-8";
            $body = new MimeMessage();  
            $body->setParts(array($html,));
            
            $mail = new Mail\Message();
            $mail->setBody($body);
            $mail->setFrom($from);
            $mail->addTo($to);
            $mail->setSubject($subject);

            $transport->send($mail);
            
        }catch(Exception $e){
            $output = array(
                'success'=>false,
                'message'=>'Error del servidor de correo: '.$e->getMessage()
            );
        }
        return $output;
    }

}

