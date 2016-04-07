<?php
namespace Application\Helper;
 
use Application\Module;
use Zend\Http\Request;
use Zend\View\Helper\AbstractHelper;

use Doctrine\ORM\EntityManager;
use Zend\ServiceManager\ServiceManagerAwareInterface;
use Zend\ServiceManager\ServiceManager;

use Zend\Cache\Storage\Adapter\AbstractAdapter;
use Zend\Cache\Storage\StorageInterface;
use Zend\Cache\PatternFactory;
use Zend\Cache\Pattern\OutputCache;
 
class CacheView extends AbstractHelper implements ServiceManagerAwareInterface
{
    protected $request;
     /*
    * @var Doctrine\ORM\EntityManager
    */
    protected $em;
 
    public function __construct($sm)
    {
        $this->sm = $sm;
    }
 
    public function __invoke()
    {
        $frontendOptions = array(
           'caching' => true,
           'lifetime' => 5,                   // cache lifetime of 30 seconds
           'automatic_serialization' => false  // this is the default anyways
        );

        $backendOptions = array('cache_dir' => 'data/tmp/');

        $outputCache = PatternFactory::factory('output', array(
            'storage' => 'filesystem',
            'public_dir' => 'data/tmp/',
        ),'File',
         $frontendOptions,
         $backendOptions);

        return $outputCache;
    }

    public function getEntityManager() {
        if (null === $this->em) {
            $config = Module::getCustomConfig();
            $country = $config['country'];
            $this->em = $this->sm->getServiceLocator()->get('doctrine.entitymanager.orm_alternative_'.$country);
        }
        return $this->em;
    }

    public function setEntityManager(EntityManager $em) {
        $this->em = $em;
    }

}