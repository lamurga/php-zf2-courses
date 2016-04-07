<?php

namespace Institutions\Controller;

use Complements\Form\SearchForm;
use Zend\Mvc\Controller\AbstractActionController;
use Application\Module;
use Complements\Form\UserContactsForm;
use Complements\Form\UserContactsFilter;
use Application\library\Utils;
use Zend\View\Model\ViewModel;

class InstitutionsController extends AbstractActionController
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
        $institutions = $em->createQuery("SELECT i FROM Institutions\Entity\Institutions i")->getResult();
        
        return array('country'=>'co', 'institutions'=>$institutions);
    }

    public function universitiesAction()
    {
        $em = $this->getEntityManager();
        $institutions = $em->createQuery("SELECT i FROM Institutions\Entity\Institutions i")->getResult();
        
        return array('country'=>'co', 'institutions'=>$institutions);
    }

    public function universitiesShowAction()
    {
        $vars = $this->globalVarsShowAction();
        $view = new ViewModel($vars);
        $view->setTemplate('institutions/institutions/institution-show.phtml'); 
        return $view;
    }

    public function institutesShowAction()
    {
        $vars = $this->globalVarsShowAction();
        $view = new ViewModel($vars);
        $view->setTemplate('institutions/institutions/institution-show.phtml'); 
        return $view;
    }

    public function professionalcollegeShowAction()
    {
        $vars = $this->globalVarsShowAction();
        $view = new ViewModel($vars);
        $view->setTemplate('institutions/institutions/institution-show.phtml'); 
        return $view;
    }

    public function companyShowAction()
    {
        $vars = $this->globalVarsShowAction();
        $view = new ViewModel($vars);
        $view->setTemplate('institutions/institutions/institution-show.phtml'); 
        return $view;
    }

    public function academyShowAction()
    {
        $vars = $this->globalVarsShowAction();
        $view = new ViewModel($vars);
        $view->setTemplate('institutions/institutions/institution-show.phtml'); 
        return $view;
    }

    public function graduateschoolShowAction()
    {
        $vars = $this->globalVarsShowAction();
        $view = new ViewModel($vars);
        $view->setTemplate('institutions/institutions/institution-show.phtml'); 
        return $view;
    }

    public function languageschoolShowAction()
    {
        $vars = $this->globalVarsShowAction();
        $view = new ViewModel($vars);
        $view->setTemplate('institutions/institutions/institution-show.phtml'); 
        return $view;
    }

    public function otherinstitutionShowAction()
    {
        $vars = $this->globalVarsShowAction();
        $view = new ViewModel($vars);
        $view->setTemplate('institutions/institutions/institution-show.phtml'); 
        return $view;
    }

    public function globalVarsShowAction()
    {

        $em_user = $this->getEntityManagerUser();
        $request = $this->getRequest();
        $em = $this->getEntityManager();
        $slug = $this->params('slug', null);
        
        $memcache = $this->getServiceLocator()->get('my_memcached_alias');
        $searchForm = new SearchForm($em, $memcache);
        
        $institution = $em->getRepository('Institutions\Entity\Institutions')->findOneBy(array('slug'=>$slug));
        if(!$institution){
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
                    $url_ie_show = str_replace('-','_',$institution->getTypeInstitutions()->getSlug()).'_show';
                    $this->flashMessenger()->setNamespace('success')->addMessage('Gracias por ponerse en contacto con nosotros');
                    $this->redirect()->toRoute($url_ie_show, array('slug'=>$slug));    
                }
            }else{
                //var_dump($form);
                $this->flashMessenger()->setNamespace('error')->addMessage('Error en el ingreso de datos, revice el formulario por favor.');
            }

        }


        $title = utf8_encode($institution->getName()).' - '.$institution->getTypeInstitutions()->getName();
        $this->layout()->headerTitle = $title;
        $courses = $em->getRepository('Courses\Entity\Courses')->getCoursesByIe($institution->getId());
        $output = array();
        foreach ($courses as $course) {
            $output[utf8_encode($course->getTypeCourses()->getName())][] = $course;
        }
        
        $metaDescription = utf8_encode($institution->getMetaDescription());
        return array('institution'=>$institution, 'form'=>$form, 'searchForm'=>$searchForm, 'title'=>$title, 'courses'=>$output, 'metaDescription'=>$metaDescription);
        
    }


}
