<?php

namespace Courses\Controller;

use Complements\Form\SearchForm;
use Complements\Form\UserContactsForm;
use Complements\Form\UserContactsFilter;
use Institutions\Form\InstitutionsRegisterForm;
use Institutions\Form\InstitutionsRegisterFilter;
use Institutions\Form\IntitutionContactForm;
use Institutions\Form\IntitutionContactFilter;
use Courses\Entity\Courses;

use Zend\Mvc\Controller\AbstractActionController;
use Doctrine\ORM\Tools\Pagination\Paginator as DoctrinePaginator;
use DoctrineORMModule\Paginator\Adapter\DoctrinePaginator as PaginatorAdapter;
use Zend\Paginator;
use Zend\Crypt\Password\Bcrypt;
use Application\Module;
use Zend\View\Model\ViewModel;
use Zend\Authentication\AuthenticationService;
//use Complements\Utils;
use Application\library\Utils;

use Zend\Mail\Transport\Smtp as SmtpTransport;
use Zend\Mail\Transport\SmtpOptions;
use Zend\Mail;
use Zend\Mime\Part as MimePart; 
use Zend\Mime\Message as MimeMessage; 


class CoursesController extends AbstractActionController
{
    /**
    * @var Doctrine\ORM\EntityManager
    */
    protected $em;
    protected $em_user;

    public function setEntityManager(EntityManager $em)
    {
        $this->em = $em;
    }
 
    public function getEntityManager()
    {
        //$config = Module::getCustomConfig();
        //$country = $config['country'];
        
        if (null === $this->em) {
            $this->em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_alternative_com');
        }
        return $this->em;
    }

    public function setEntityManagerUser(EntityManager $em_user)
    {
        $this->em_user = $em_user;
    }

    //Entity Manager para acceder a la bd usuarios (definido como bd por defecto)
    public function getEntityManagerUser()
    {
        if (null === $this->em_user) {
            $this->em_user = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
        }
        return $this->em_user;
    }


    public function indexAction()
    {
        $em = $this->getEntityManager();
        $slug = $this->params('slug', null);
        
        /*
        $request = $this->getRequest();
        $cookies = $request->getCookie(); // Todas las cookies en el navegador
        var_dump($request);*/

        
        return array('vars'=>'vars');
    }
    
    public function coursesByTypeAction()
    {
        $em = $this->getEntityManager();
        $typeSlug = $this->params('typeSlug', null);
        $page = $this->params('page', null);
        $config = Module::getCustomConfig();
        $globalPagination = $config['paginate'];
        $memcache = $this->getServiceLocator()->get('my_memcached_alias');
        $form = new SearchForm($em, $memcache, $typeSlug);
        $form->setData(array('course_type'=>$typeSlug));
        
        $typeCourse = $em->getRepository('Courses\Entity\TypeCourses')->findOneBy(array('slug'=>$typeSlug));
        if(is_null($typeCourse)){
            $this->getResponse()->setStatusCode(404);
            return;
        }   
        
        //$type_courses = $em->getRepository('Courses\Entity\TypeCourses')->getTypesInCache($memcache);
        $idTypeCourse = $typeCourse->getId();
        $query = $em->getRepository('Courses\Entity\Courses')->getCoursesByType($typeSlug);
                
        $paginatorAdapter = new PaginatorAdapter(new DoctrinePaginator($query));
        $paginator = new Paginator\Paginator($paginatorAdapter);
        $paginator->setCurrentPageNumber($page);
        $paginator->setItemCountPerPage($globalPagination); //cantidad de filas (Se definirá como variable global en el Module.php de Aplication)

        //cantidad de cursos agrupados por tipo (opción: afinar busqueda)
        //$group = $em->getRepository('Courses\Entity\Courses')->getCountCoursesByType();
        //$total_courses = $paginator->getPages()->totalItemCount;    

        $metaDescription = '';
        $title = utf8_encode($typeCourse->getName()).' en '.$config['country_name'];
        $this->layout()->headerTitle = $title;
        return array('paginator'=>$paginator, 'typeSlug'=>$typeSlug, 'idTypeCourse'=>$idTypeCourse, 'searchForm'=>$form, /*'typeGroup'=>$group,*/ 'title'=>$title, 'metaDescription'=>$metaDescription);
    }

    public function coursesByTypeShowAction()
    {
        $em_user = $this->getEntityManagerUser();
        $em = $this->getEntityManager();
        $typeSlug = $this->params('typeSlug', null);
        $courseSlug = $this->params('courseSlug', null);
        $request = $this->getRequest();

        $typeCourse = $em->getRepository('Courses\Entity\TypeCourses')->findOneBy(array('slug'=>$typeSlug));
        if(is_null($typeCourse)){
            $this->getResponse()->setStatusCode(404);
            return array('message'=>'el tipo de curso no existe');
        }
        $idTypeCourse = $typeCourse->getId();

        $memcache = $this->getServiceLocator()->get('my_memcached_alias');
        $searchForm = new SearchForm($em, $memcache, $typeSlug);
        
        $course = $em->getRepository('Courses\Entity\Courses')->findOneBy(array('slug'=>$courseSlug));
        if(!$course){
            $this->getResponse()->setStatusCode(404);
            return; 
        }
        
        $form = new UserContactsForm($em, $memcache);
        
        $uri = $request->getUri();
        $url_ref = $uri->getScheme().'://'.$uri->getHost().$uri->getPath();
        
        if ($request->isPost()) {

            $contactFilter = new UserContactsFilter();
            $form->setInputFilter($contactFilter->getInputFilter());
            $form->setData($request->getPost());

            if ($form->isValid()) {
                $data = $request->getPost();
                $utils = new Utils();
                $saveMoreInfo = $utils->saveMoreInfo($em_user, $data, $url_ref);
                if($saveMoreInfo){
                    $this->flashMessenger()->setNamespace('success')->addMessage('Gracias por ponerse en contacto con nosotros');
                    $this->redirect()->toRoute('courses/show', array('typeSlug'=>$typeSlug, 'courseSlug'=>$courseSlug));    
                }
            }else{
                //var_dump($form);
                $this->flashMessenger()->setNamespace('error')->addMessage('Error en el ingreso de datos, revice el formulario por favor.');
            }
        }

        $title = utf8_encode($course->getName().' - '.$course->getInstitutions()->getName());
        $metaDescription = utf8_encode($course->getMetaDescription());
        $this->layout()->headerTitle = $title;

        return array('course'=>$course, 'idTypeCourse'=>$idTypeCourse, 'searchForm'=>$searchForm, 'title'=>$title, 'metaDescription'=>$metaDescription, 'form'=>$form);
    }


    public function publishCourseAction()
    {
        $em = $this->getEntityManager();
        $em_user = $this->getEntityManagerUser();
        $memcache = $this->getServiceLocator()->get('my_memcached_alias');
        $searchForm = new SearchForm($em, $memcache);
        $form = new InstitutionsRegisterForm($em, $memcache);
        $validationOptions = $this->validationsPublishCourse();
        $form->setData(array('txtEmail'=>$validationOptions['email']));
        $form->setData(array('id'=>$validationOptions['user_id']));
        
        $request = $this->getRequest();
        $data = array();

        $change_to_sapie = (($validationOptions['is_user_sapie'] == 'false') and ($validationOptions['is_login'] == 'true')) ? true : false;
        $save = true; $save_new_sapie = false; 
        $config = Module::getCustomConfig();
        
        if ($request->isPost()) {

            $ieFilter = new InstitutionsRegisterFilter();
            $form->setInputFilter($ieFilter->getInputFilter($em_user, $request->getPost()));
            $form->setData($request->getPost());

            //creamos arreglo distrito
            $distritos = array();
            $distrito = $request->getPost()->district;
            $distritos[$distrito] = $distrito;
            $form->get('district')->setOptions(array('value_options'=> $distritos)) ;
            
            if ($form->isValid()) {
                //$data = $form->getData();
                $data = $request->getPost();
                
                $password = $config['password_temp_user'];
                $sapie_group_id = $config['group_user_sapie_id'];
                                
                if($validationOptions['user_no_master'] =='true'){
                    //$message = 'Error: Ya eres un usuario del sapie (No master)  y no puedes crearte una cuenta master en esta IE';
                    $message = 'Hubo un error, la cuenta ya esta asociado a la institución, por favor comunicate con nosotros. <a href="'.$this->url('contact').'">Contáctenos</a>';
                    $save = false;
                }

                if($save){
                    //Creando la institucion con estado pendiente
                    $institution = new \Institutions\Entity\Institutions();
                    $ieName = $data['txtInstitucion'];
                    $institution->setName($ieName);
                    $institution->setBusinessName($data['txtRazonSocial']);

                    $type = $em->getRepository('Institutions\Entity\TypeInstitutions')->find($data['tipo-institucion']);
                    $institution->setTypeInstitutions($type);

                    $ubigeo = $em->getRepository('Complements\Entity\Ubigeo')->find($distrito);
                    $institution->setUbigeo($ubigeo);
                    
                    $institution->setRuc($data['txtRUC']);
                    $institution->setLegalAddress($data['txtDireccion']);
                    $institution->setPhone($data['txtTelefono'].$data['txtTelefono2']);
                    $institution->setWebsite($data['txtURL']);
                    $institution->setCreatedAt(new \DateTime());
                    $institution->setUpdatedAt(new \DateTime());
                    $institution->setIsCrawler(false);
                    $institution->setStatus(false);
                    
                    $em->persist($institution);
                    $em->flush();

                    if($change_to_sapie){
                        $user = $validationOptions['user'];
                        
                        //Cambiando el grupo a usuarios "sapie"
                        $group = $em_user->getRepository('Users\Entity\Group')->find($sapie_group_id);
                        $user->setGroup($group);
                        
                        $user->setUpdatedAt(new \DateTime());
                        $em_user->persist($user);
                        $em_user->flush();

                        $save_new_sapie = true;
                        //$message = "Ahora eres un usuario sapie Master para la IE: ".$data['txtInstitucion'];
                        $message = 'Hubo un error, la cuenta ya esta asociado a la institución '.$data['txtInstitucion'].', por favor comunicate con nosotros. <a href="'.$this->url('contact').'">Contáctenos</a>';

                    }elseif($validationOptions['is_user_sapie'] == 'true'){ //usuario sapie logueado, solo agregará el detalle de la sapie_ie(sin crearse una cuenta de usuario)
                        $user = $validationOptions['user'];
                        $userSapie = $validationOptions['user_sapie'];
                        $detail = new \Users\Entity\DetailsUserSapie();
                        $detail->setCtUserSapie($userSapie);
                        $detail->setCtInstitutions($institution);
                        $detail->setIsMaster(true);
                        
                        $em->persist($detail);
                        $em->flush();

                        //$message = "Eres un usuario sapie registado y ahora eres master de la IE: ".$data['txtInstitucion'];
                        $message = 'Hubo un error, la cuenta ya esta asociado a la institución '.$data['txtInstitucion'].', por favor comunicate con nosotros. <a href="'.$this->url('contact').'">Contáctenos</a>';
                    }else{ //Usuarios no logueados
                        //Creando al usuario
                        $user = new \Users\Entity\User();
                        $user->setEmail($data['txtMailContacto']);
                        $user->setName($data['txtNomContacto']);
                        //Agregando el grupo de usuarios "sapie"
                        $group = $em_user->getRepository('Users\Entity\Group')->find($sapie_group_id);
                        $user->setGroup($group);
                        $user->setStatus(false);
                        
                        $bcrypt = new Bcrypt;
                        $bcrypt->setCost(14);

                        $user->setPassword($bcrypt->create($password));
                        $user->setCreatedAt(new \DateTime());
                        $user->setUpdatedAt(new \DateTime());
                        $em_user->persist($user);
                        $em_user->flush();
                        
                        $save_new_sapie = true;
                        //$message = "Gracias por registrate como usuario sapie para la IE: ".$data['txtInstitucion'].', en breve nos comunicaremos con ud.';
                        $message = "Gracias por registrarte como usuario para ".$data['txtInstitucion'].", en breve nos comunicaremos con Ud por correo electrónico.";
                    }

                    if($save_new_sapie){
                        //Creando al usuario Sapie
                        $sapie = new \Users\Entity\UserSapie();
                        $sapie->setUserId($user->getId());
                        $sapie->setFirstName($data['txtNomContacto']);
                        $sapie->setLastName('');
                        $sapie->setPhone($data['txtTelefono'].$data['txtTelefono2']);
                        $sapie->setAddress($data['txtDireccion']);
                        $sapie->setCreatedAt(new \DateTime());
                        $sapie->setUpdatedAt(new \DateTime());
                        $em->persist($sapie);
                        $em->flush();
                        
                        //Creando al detalle_usuario_Sapie
                        $userSapie = new \Users\Entity\DetailsUserSapie();
                        
                        $userSapie->setCtUserSapie($sapie);
                        $userSapie->setCtInstitutions($institution);
                        $userSapie->setIsMaster(true);
                        
                        $em->persist($userSapie);
                        $em->flush();
                    }

                    //Generamos el Slug con las 3 primeras letras del tipo y el id de la IE
                    $utils = new Utils();
                    $letter = substr($type->getName(), 0,3);
                    $parent_id = strtolower($letter).$institution->getId();
                    $institution->setParentId($parent_id);
                    $slug = $utils->uniqueSlug($em, $ieName, 'Institutions\Entity\Institutions', $parent_id);
                    $institution->setSlug($slug);

                    //Actualizamos la Ie con el id del usuario que la está registrando 
                    $institution->setCreatedCoreCtUsersId($user->getId());
                    $em->persist($institution);
                    $em->flush();

                    $this->flashMessenger()->setNamespace('success')->addMessage($message);
                    return $this->redirect()->toRoute('publish_course');

                    /*
                    * TODO: Enviar emails al usuario sapie master y al  responsable de ct
                    */
                }else{
                    $this->flashMessenger()->setNamespace('error')->addMessage($message);
                    //$this->redirect()->toRoute('publish_course');
                }
                
            }else{
                //var_dump($form->getMessages());
                $view = new ViewModel(array('searchForm'=>$searchForm, 'institutions'=>array(), 'form'=>$form));
                $view->setTemplate('courses/courses/ie-register.phtml'); 
                return $view;

            }

        }
        return array('validation_options'=>$validationOptions, 'institutions'=>0, 'searchForm'=>$searchForm, 'form'=>$form);
    }

    public function validatePublicationAction()
    {
        $em = $this->getEntityManager();
        $em_user = $this->getEntityManagerUser();
        $memcache = $this->getServiceLocator()->get('my_memcached_alias');
        
        $institutions = array();
        $form = new InstitutionsRegisterForm($em, $memcache);
        $validationOptions = $this->validationsPublishCourse();
        $request = $this->getRequest();
        $data = array();
        
        $ie = '';
        if ($request->isPost()) {
            $form->setData(array('txtMailContacto'=>$validationOptions['email']));
            $form->setData(array('id'=>$validationOptions['user_id']));
            
            $ie = $request->getPost()->q;
            $op = $request->getPost()->op;
            $institutions = ($op == '3') ? array() : $em->getRepository('Institutions\Entity\Institutions')->getIesByName($ie);
            //$institutions = $em->getRepository('Institutions\Entity\Institutions')->getIesByName($ie);
            $form->setData(array('txtInstitucion'=>$ie));

        }
        
        $this->layout('layout/ajax-layout');
        return array('validation_options'=>$validationOptions, 'institutions'=>$institutions, 'ieName'=>$ie, 'form'=>$form, 'flashMessages' => $this->flashMessenger()->getMessages(),);
    }

    public function publisherRegisterAction()
    {
        $em = $this->getEntityManager();
        $em_user = $this->getEntityManagerUser();
        $memcache = $this->getServiceLocator()->get('my_memcached_alias');
        $searchForm = new SearchForm($em, $memcache);

        $ieSlug = $this->params('ieSlug');
        $institution = $em->getRepository('Institutions\Entity\Institutions')->findOneBy(array('slug'=>$ieSlug));

        if(!$institution or is_null($ieSlug)){
            $this->getResponse()->setStatusCode(404);
            return; 
        }

        $validationOptions = $this->validationsPublishCourse($institution->getId());
        $form = new IntitutionContactForm();
        $form->setData(array('id'=>$validationOptions['user_id']));
        $form->setData(array('txtEmail'=>$validationOptions['email']));
        
        $request = $this->getRequest();
        $data = array();
        $change_to_sapie = (($validationOptions['is_user_sapie'] == 'false') and ($validationOptions['is_login'] == 'true')) ? true : false;
        $is_master = ($validationOptions['ie_have_master'] == 'false') ? true : false;
        $save = true; $save_new_sapie = false; 
        $config = Module::getCustomConfig();
        $sapie_group_id = $config['group_user_sapie_id'];
        //var_dump($is_master);
        if ($request->isPost()) {

            $ieFilter = new IntitutionContactFilter();
            $form->setInputFilter($ieFilter->getInputFilter($em_user, $request->getPost()));
            $form->setData($request->getPost());
            
            if ($form->isValid()) {
                $data = $form->getData();
                
                if($validationOptions['user_no_master'] =='true'){
                    //$message = 'Ya eres un usuario del sapie (No master)  y no puedes crearte una cuenta master en esta IE';
                    $message = 'Hubo un error, la cuenta ya esta asociado a la institución, por favor comunicate con nosotros. <a href="'.$this->url('contact').'">Contáctenos</a>';
                    $save = false;
                }
                
                if($validationOptions['user_in_ie'] =='true'){
                    //$message = 'Ya estás registrado como usuario Sapie en esta institución';
                    $message = 'Hubo un error, la cuenta ya esta asociado a la institución, por favor comunicate con nosotros. <a href="'.$this->url('contact').'">Contáctenos</a>';
                    $save = false;
                }

                if($save){
                    if($change_to_sapie){
                        $user = $validationOptions['user'];
                        
                        //Cambiando el grupo a usuarios "sapie"
                        $group = $em_user->getRepository('Users\Entity\Group')->find($sapie_group_id);
                        $user->setGroup($group);
                        
                        $user->setUpdatedAt(new \DateTime());
                        $em_user->persist($user);
                        $em_user->flush();

                        $save_new_sapie = true;
                        //$message = "Ahora eres un usuario sapie Master para la IE: ".utf8_encode($institution->getName());
                        $message = "Gracias por registrarte como usuario para <b>".utf8_encode($institution->getName())."</b>, en breve nos comunicaremos con Ud por correo electrónico.";

                    }elseif($validationOptions['is_user_sapie'] == 'true'){ //usuario sapie logueado, solo agregará el detalle de la sapie_ie(sin crearse una cuenta de usuario)
                        $userSapie = $validationOptions['user_sapie'];
                        $user = $validationOptions['user'];

                        $detail = new \Users\Entity\DetailsUserSapie();
                        $detail->setCtUserSapie($userSapie);
                        $detail->setCtInstitutions($institution);
                        $detail->setIsMaster($is_master);
                        
                        $em->persist($detail);
                        $em->flush();

                        //$message = "Eres un usuario sapie registado en la IE: ".utf8_encode($institution->getName());
                        $message = "Gracias por registrarte como usuario para <b>".utf8_encode($institution->getName())."</b>, en breve nos comunicaremos con Ud por correo electrónico.";
                    }else{
                        //Creando al usuario
                        $password = $config['password_temp_user'];
                        
                        $bcrypt = new Bcrypt;
                        $bcrypt->setCost(14);

                        $user = new \Users\Entity\User();
                        $user->setEmail($data['txtEmail']);
                        $user->setName($data['contacto']);
                        $user->setLastName($data['apellido']);
                        //Agregando el grupo de usuarios "sapie"
                        $group = $em_user->getRepository('Users\Entity\Group')->find($sapie_group_id);
                        $user->setGroup($group);
                        $user->setStatus(false);
                        $user->setPassword($bcrypt->create($password));
                        $user->setCreatedAt(new \DateTime());
                        $user->setUpdatedAt(new \DateTime());
                        $em_user->persist($user);
                        $em_user->flush();

                        $save_new_sapie = true;
                        //$message = "Gracias por registrate como usuario sapie para la IE: ".utf8_encode($institution->getName()).', en breve nos comunicaremos con ud.';
                        $message = "Gracias por registrarte como usuario para <b>".utf8_encode($institution->getName())."</b>, en breve nos comunicaremos con Ud por correo electrónico.";
                    }

                    if($save_new_sapie){
                    
                        //Creando al usuario Sapie
                        $sapie = new \Users\Entity\UserSapie();
                        $sapie->setUserId($user->getId());
                        $sapie->setFirstName($data['contacto']);
                        $sapie->setLastName($data['apellido']);
                        $sapie->setPhone($data['txtTelefono'].$data['txtTelefono2']);
                        $sapie->setCreatedAt(new \DateTime());
                        $sapie->setUpdatedAt(new \DateTime());
                        $em->persist($sapie);
                        $em->flush();
                        
                        //Creando al detalle_usuario_Sapie
                        $userSapie = new \Users\Entity\DetailsUserSapie();
                        $userSapie->setCtUserSapie($sapie);
                        $userSapie->setCtInstitutions($institution);
                        $userSapie->setIsMaster($is_master);
                        $em->persist($userSapie);
                        $em->flush();
                    }

                    $institution->setCreatedCoreCtUsersId($user->getId());
                    $institution->setUpdatedAt(new \DateTime());
                    $em->persist($institution);
                    $em->flush();


                    $emailConfig = $config['emails'];
                    
                    $from = $data['txtEmail'];
                    $to = $emailConfig['recipient'];
                    $subject = 'Registro de institución';

                    $content = '<b>Institución / Empresa: </b>'.$data['contacto'].'<br>';
                    $content = $content.'<b>Razón Social: </b>'.$data['apellido'].'<br>';
                    $content = $content.'<b>Email: </b>'.$data['txtEmail'].'<br>';
                    $content = $content.'<b>Teléfono: </b>'.$data['txtTelefono'].$data['txtTelefono2'].'<br>';
                    $content = $content.'<b>Comentarios: </b>'.$data['txtComentarios'].'<br>';

                    $this->renderer = $this->getServiceLocator()->get('ViewRenderer');  
                    
                    //$content = $this->renderer->render('users/user/email_template', array('vars'=>'hola pe')); 
                    //$email = $this->sendEmail($from, $to, $subject, $content);

                    $this->flashMessenger()->setNamespace('success')->addMessage($message);
                    return $this->redirect()->toRoute('publish_course');
                }else{
                    $this->flashMessenger()->setNamespace('error')->addMessage($message);
                }

            }else{
                //var_dump($form->getMessages());
            }

        }

        return array('validation_options'=>$validationOptions, 'searchForm'=>$searchForm, 'form'=>$form, 'institution'=>$institution, 'flashMessages' => $this->flashMessenger()->getMessages());
    }

    public function newCoursesAction(){
        $em = $this->getEntityManager();
        $memcache = $this->getServiceLocator()->get('my_memcached_alias');
        $searchForm = new SearchForm($em, $memcache);

        $page = $this->params('page', null);
        $config = Module::getCustomConfig();
        $globalPagination = $config['paginate'];

        $query = $em->getRepository('Courses\Entity\Courses')->getNewCourses();
        $paginatorAdapter = new PaginatorAdapter(new DoctrinePaginator($query));
        $paginator = new Paginator\Paginator($paginatorAdapter);
        $paginator->setCurrentPageNumber($page);
        $paginator->setItemCountPerPage($globalPagination); //cantidad de filas (Se definirá como variable global en el Module.php de Aplication)
        
        return array('paginator'=>$paginator, 'searchForm'=>$searchForm);
        
    }
    
    public function sendEmail($from, $to, $subject, $content){
        $output = array();
        try{

            $transport = $this->getServiceLocator()->get('mail_transport');
            
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
    
    /*
    public function sendEmail($from, $to, $subject, $content){
        $output = array();
        $config = Module::getCustomConfig();
        $emailConfig = $config['emails'];
        try{
            //Configuración para usar gmail como servidor
            $options = new SmtpOptions( array(
                "name" => 'gmail',
                "host" => $emailConfig['host'],
                "port" => $emailConfig['port'],
                "connection_class" => $emailConfig['connection_class'],
                "connection_config" => array(
                    "username" => $emailConfig['username'],
                    "password" => $emailConfig['password'],
                    "ssl" => $emailConfig['ssl']
                )
            ));

            $html = new MimePart($content);  
            $html->type = "text/html";  
            $body = new MimeMessage();  
            $body->setParts(array($html,));
            
            $mail = new Mail\Message();
            $mail->setBody($body);
            $mail->setFrom($from);
            $mail->addTo($to);
            $mail->setSubject($subject);

            $transport = new SmtpTransport();
            $transport->setOptions( $options ); //solo si usamos gmail
            $transport->send($mail);
            
        }catch(Exception $e){
            $output = array(
                'success'=>false,
                'message'=>'Error del servidor de correo: '.$e->getMessage()
            );
        }
        return $output;
    }
    */

    public function validationsPublishCourse($ieId=null){
        $em = $this->getEntityManager();
        $em_user = $this->getEntityManagerUser();
        $auth = new AuthenticationService();
        $userId = $auth->getIdentity(); //Id del usuario logueado en el momento

        $email = ''; $user_in_ie = 'false'; $is_user_sapie = 'false'; $is_login = 'false'; $ie_have_master = 'false'; $is_master = 'false'; $is_not_master = 'false'; $userSapie=array(); $user=array();

        if(!is_null($ieId)){
            $ieMaster = $em->getRepository('Users\Entity\DetailsUserSapie')->getUserSapieMasterByIe($ieId);
            if ($ieMaster){
                $ie_have_master = 'true';
                //$email_master = $ieMaster->getCtUserSapie()->getEmail();
                //var_dump($email_master);
            } 
        }

        if($userId){
            $user = $em_user->getRepository('Users\Entity\User')->find($userId);
            $email = $user->getEmail();
            if($user->getGroup()->getName() == 'Sapie'){
                $is_user_sapie = 'true';
                $userSapie = $em->getRepository('Users\Entity\UserSapie')->findOneBy(array('user_id'=>$userId));
                //var_dump($userId);
                //var_dump($userSapie);
                $userMaster = $em->getRepository('Users\Entity\DetailsUserSapie')->getUserSapieIsMaster($userSapie->getId());
                $userNoMaster = $em->getRepository('Users\Entity\DetailsUserSapie')->getUserSapieIsNotMaster($userSapie->getId());
                $is_master = ($userMaster) ? 'true' : 'false';
                $is_not_master = ($userNoMaster) ? 'true' : 'false';
                if(!is_null($ieId)){
                    $ie_sapie = $em->getRepository('Users\Entity\DetailsUserSapie')->getDetailBySapieAndIe($userSapie->getId(), $ieId);
                    if($ie_sapie) $user_in_ie = 'true';
                }
            }
            
            $is_login = 'true';


        }
        //return array('user_id'=>$userId, 'email'=>$email, 'is_user_sapie'=>$is_user_sapie, 'is_login'=>$is_login, 'ie_have_master'=>$ie_have_master, 'user_master'=>$is_master, 'user_no_master'=>$is_not_master);
        return array('user_sapie'=>$userSapie, 'user'=>$user, 'user_id'=>$userId, 'email'=>$email, 'is_user_sapie'=>$is_user_sapie, 'user_in_ie'=>$user_in_ie, 'is_login'=>$is_login, 'ie_have_master'=>$ie_have_master, 'user_master'=>$is_master, 'user_no_master'=>$is_not_master);
    }
     

}