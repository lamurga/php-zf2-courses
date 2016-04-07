<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;

use Complements\Form\SearchForm;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Doctrine\ORM\EntityManager;
use Application\Module;
use Application\library\Utils;
use Zend\Http\Client;

use Zend\Cache\Storage\Adapter\AbstractAdapter;
use Zend\Cache\Storage\StorageInterface;
use Zend\Cache\PatternFactory;

//use Zend\Cache\PatternFactory as Zend_Cache ;


class IndexController extends AbstractActionController
{
	/**
    * @var Doctrine\ORM\EntityManager
    */
    protected $em;

    public function setEntityManager(EntityManager $em)
    {
        $this->em = $em;
    }
 
    public function getEntityManager()
    {
        //$config = Module::getCustomConfig();
        //$country = $config['country'];
        
        if (null === $this->em) {
            #$this->em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_alternative_'.$country);
            $this->em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_alternative_com');
        }
        return $this->em;
    }


    public function indexAction()
    {
        $em = $this->getEntityManager();

        $memcache = $this->getServiceLocator()->get('my_memcached_alias');
        //var_dump($memcache->getStats());
        $form = new SearchForm($em, $memcache);

        return array('searchForm'=>$form);  
    }

    public function loginAction()
    {
    	$em = $this->getEntityManager();
        $memcache = $this->getServiceLocator()->get('my_memcached_alias');
        
        $form = new SearchForm($em, $memcache);
        
        return array('searchForm'=>$form);
    }


    public function generatehomeAction()
    {
        if(APPLICATION_ENV=='development'){
            $module = new Module();
            $config = $module->getCustomConfig();
            $group_courses = array(
                'Administración'=> $config['administracion'],
                'Finanzas'=> $config['finanzas'],
                'Ingeniería'=> $config['ingenieria'],
                'Salud y Social'=> $config['salud_y_social'],
                'Maestrías'=> $config['maestrias'],
                'Comunicación'=> $config['comunicacion'],
                'Computación'=> $config['computacion'],
                'Otros (Profesionales)'=> $config['otros_profesionales'],
                'Otros (Personales)'=> $config['otros_personales'],
                'Diplomados'=> $config['diplomados'],
            );
            
            $this->renderer = $this->getServiceLocator()->get('ViewRenderer');
            $content = $this->renderer->render('application/index/generatehome', array(
                'group_courses'=>$group_courses,
                )
            );
            
            $file = @fopen(DIR_GENERATE_HTML."home.phtml", "w+");       
            @fwrite($file, "$content");
            @fclose($file);
        }
        $this->getResponse()->setStatusCode(404);
        return;
    }


    public function index___Action()
    {
        $apiUrl = 'http://ct.com/sso';
        $data = array('country'=>'co', 'apiKey'=>'123456');

        //realizar una peticion GET por defecto al crawler, al cargar la url
        $output = $this->restClient('get', $apiUrl, $data);
        
        //Deshabilitando el layout
        /*$result = new ViewModel(array('results'=>$output, 'form'=>$form, 'country'=>$country));
        $result->setTerminal(true);
        return $result;*/
        
        return array('results'=>$output, 'form'=>$form, 'country'=>$country);
    }

    //Método que sirve para obtener los datos del Api del Crawler, soporta las peticiones GET, PUT, POST
    public function restClient($method, $apiUrl, $data){
        $client = new Client($apiUrl);
        if($method == 'get'){
            $client->setParameterGet($data);
        }if($method == 'post'){
            $client = $client->setMethod('POST');
            $client->setParameterPost($data);
        }if($method == 'put'){
            $client->setMethod('PUT');
            $client->setParameterPost($data);
        }
        $result = $client->send();
        return json_decode($result->getBody());
    }
}

/*
pruebas



        //$type_courses = $em->getRepository('Courses\Entity\TypeCourses')->getTypesInCache($memcache);
        //header( "Access-Control-Allow-Origin: http://ct.com" );

        //$apiUrl = 'http://ct.com/sso';
        //$data = array('country'=>'co', 'apiKey'=>'123456');

        //realizar una peticion GET por defecto al crawler, al cargar la url
        //$output = $this->restClient('get', $apiUrl, $data);
        //$output = file_get_contents($apiUrl);
        //$output = fopen($apiUrl, "r");
        /*$output = file_get_contents("http://ct.com/sso?order_id=" . session_name() . '=' . session_id());

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $apiUrl);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, false);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);

        $html = curl_exec($ch);
        

        var_dump(session_name());
        var_dump(session_id());
        var_dump($html);
*/
