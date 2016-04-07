<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application;

use Zend\Mvc\ModuleRouteListener,
    Doctrine\ORM\EntityManager,
    Zend\Mvc\MvcEvent,
    Application\Helper\AllTypeCourses,
    Application\Helper\InstitutionsCount,
    Application\Helper\CoursesCount,
    Application\Helper\CoursesBySearchCount,
    Application\Helper\TruncateText,
    Application\Helper\FriendlyUrl,
    Application\Helper\Requesthelper,
    Application\Helper\CustomFlashMessenger,
    Application\Helper\CacheView;
use Doctrine\ORM\Mapping\Driver\YamlDriver;
use Zend\ModuleManager\Feature\ServiceProviderInterface;
use DoctrineORMModule\Service\EntityManagerFactory;
use DoctrineORMModule\Service\DBALConnectionFactory;

use Zend\Mail\Transport\Smtp;
use Zend\Mail\Transport\SmtpOptions;

use Doctrine\Common\Annotations\AnnotationRegistry;

class Module implements ServiceProviderInterface
{

    public function onBootstrap($e)
    {
        //Configurar zonas horarias
        $app     = $e->getParam('application');
        $sm      = $app->getServiceManager();
        
        //Cargar los mapeadores
        $chain = $sm->get('doctrine.driver.orm_default');
        $chain->addDriver(new YamlDriver(__DIR__ . '/../../data/doctrine/mapping'), 'Users\Entity');
        $chain->addDriver(new YamlDriver(__DIR__ . '/../../data/doctrine/mapping'), 'Courses\Entity');   
        $chain->addDriver(new YamlDriver(__DIR__ . '/../../data/doctrine/mapping'), 'Institutions\Entity');   
        $chain->addDriver(new YamlDriver(__DIR__ . '/../../data/doctrine/mapping'), 'Complements\Entity');   

        $config = $sm->get('Config');
        $phpSettings = isset($config['php_settings']) ? $config['php_settings'] : array();
        if(!empty($phpSettings)) {
            foreach($phpSettings as $key => $value) {
                ini_set($key, $value);
            }
        }
    }

    public function getServiceConfig()
    {
       return array(
            'factories' => array(
                'doctrine.entitymanager.orm_alternative_com'        => new EntityManagerFactory('orm_alternative_com'),
                'doctrine.entitymanager.orm_alternative_ccd'        => new EntityManagerFactory('orm_alternative_ccd'),
                'doctrine.connection.orm_alternative_com'           => new DBALConnectionFactory('orm_alternative_com'),
                'doctrine.connection.orm_alternative_ccd'           => new DBALConnectionFactory('orm_alternative_ccd'),

                'mail_transport' => function ($sm) {
                    $config = $sm->get('Config');
                    $transport = new Smtp();
                    $transport->setOptions(new SmtpOptions($config['mail']['transport']['options']));
                    return $transport;
                },

                'time_expire_cookie' => function ($sm) {
                    $config = $sm->get('Config');
                    return $config['time_expire']['cookie']['core'];
                },

                'time_expire_cache' => function ($sm) {
                    $config = $sm->get('Config');
                    return $config['time_expire']['cache']['core'];
                },

                'time_expire_cache_list' => function ($sm) {
                    $config = $sm->get('Config');
                    return $config['time_expire']['cache']['list'];
                },

                'time_expire_cache_daily' => function ($sm) {
                    $config = $sm->get('Config');
                    return $config['time_expire']['cache']['daily'];
                },

                'time_expire_cache_average' => function ($sm) {
                    $config = $sm->get('Config');
                    return $config['time_expire']['cache']['average'];
                },
            ),
        );
    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return array('Zend\Loader\StandardAutoloader' => array('namespaces' => array(__NAMESPACE__ => __DIR__)));
    }

    //Helpers personalizados, se deben crear dentro del directorio Helper
    public function getViewHelperConfig()
    {
        return array(
            'factories' => array(     
                'all_type_courses' => function($sm) {
                    //$locator = $sm->getServiceLocator();
                    return new AllTypeCourses($sm);
                },
                'count_institutions' => function($sm) {
                    //$locator = $sm->getServiceLocator(); 
                    return new InstitutionsCount($sm);
                },
                'count_courses' => function($sm) {
                    //$locator = $sm->getServiceLocator(); 
                    return new CoursesCount($sm);
                },
                'count_courses_search' => function($sm) {
                    //$locator = $sm->getServiceLocator(); 
                    //return new CoursesBySearchCount($locator->get('Request'));
                    return new CoursesBySearchCount($sm);
                },
                'cache_view' => function($sm) {
                    //$locator = $sm->getServiceLocator(); 
                    return new CacheView($sm);
                },
                'friendly_url' => function($sm) {
                    return new FriendlyUrl();
                },
                'truncate_text' => function($sm) {
                    return new TruncateText();
                },
                'flashMessages' => function($sm) {
                    $flashmessenger = $sm->getServiceLocator()
                        ->get('ControllerPluginManager')
                        ->get('flashmessenger');
                    $messages = new CustomFlashMessenger();
                    $messages->setFlashMessenger($flashmessenger);
                    return $messages;
               } 
            ),
            'invokables' => array(
                'formelementerrors' => 'Application\Helper\FormElementErrors'
            ),
        );
    }

    //variables de configuración local
    public function getCustomConfig()
    {
        return array(
            'paginate' => "20",
            'country' => COUNTRY_ABBREV,
            'country_name' => COUNTRY_TITLE,
            'group_user_site_id' => "6",
            'group_user_sapie_id' => "7",
            'password_temp_user' => "654321",

            //'cookieTimeExpire' => time()+60*60*24*30, //30 dias
            'cacheTimeExpire' => time()+60*60*24*30, //30 dias (el valor no puede exceder a 2592000 segundos "30 dias" )
            'group_types' => array( // Agrpacion de tipo de cursos para las alertas (Fijarse en los ids de los tipos)
                '1' => array("3", "6", "7"), //Postgrado
                '2' => array("1", "2"), //Carreras Pregrado
                '3' => array("4", "5", "11"), //Cursos Cortos
                '4' => array("9", "10"), //Cursos In-House
            ),
            'principal_cities'=> array( //Ciudades que se mostrarán por defecto en crear alertas (acordeon)
                25 => 'Cuenca',
                99 => 'Guayaquil',
                132 => 'Loja',
                207 => 'Quito',
                67 => 'Riobamba',
                212 => 'Santo domingo',
            ),
            //Cursos agrupados para home
            'administracion'=> array('Administración', 'Recursos Humanos', 'Logística', 'Aduanas', 'Proyectos', 'Negocios Internacionales', 'Comercio Exterior'),
            'finanzas'=> array('Contabilidad', 'Finanzas', 'Tributación', 'Economía', 'Auditoria', 'Bolsa', 'Cajero', 'Inversión'),
            'ingenieria'=> array('Sistemas', 'Industrial', 'Ambiental', 'Civil', 'Informática', 'de Minas', 'Textil', 'Química'),
            'salud_y_social'=> array('Salud', 'Educación', 'Psicología', 'Medicina', 'Enfermería', 'Farmacia', 'Sociología', 'Tecnología Médica'),
            'maestrias'=> array('Virtual', 'Administración', 'Comunicación', 'Sistemas', 'Educación', 'Diseño', 'Derecho', 'Psicología'),
            'comunicacion'=> array('Marketing', 'Ventas', 'Diseño', 'Publicidad', 'Comunicación', 'Periodismo', 'Imagen corporativa', 'Audio visual'),
            'computacion'=> array('Computación', 'SAP', 'Excel', 'Autocad', 'Word', 'Photoshop', 'Multimedia', 'Video Juegos'),
            'otros_profesionales'=> array('Derecho', 'Gestión Pública', 'Seguridad y Salud Ocupacional', 'Secretariado', 'Coaching', 'Arquitectura', 'Seguridad Industrial'),
            'otros_personales'=> array('Manualidades', 'Natación', 'Oratoria', 'Inglés', 'Cocina', 'Música', 'Clown', 'Estimulación Temprana'),
            'diplomados'=> array('Virtual', 'Administración', 'Comunicación', 'Sistemas', 'Educación', 'Diseño', 'Derecho', 'Psicología'),

            'emails' => array(
                "from" => "soporte@company.com",
                "recipient" => "webmaster@company.com"
            ),
        );
    }
}
