<?php
namespace Application\Helper;
 
use Application\Module;
use Zend\Http\Request;
use Zend\View\Helper\AbstractHelper;

use Doctrine\ORM\EntityManager;
use Zend\ServiceManager\ServiceManagerAwareInterface;
use Zend\ServiceManager\ServiceManager;
 
class NewCourses extends AbstractHelper implements ServiceManagerAwareInterface
{
    protected $request;
     /*
    * @var Doctrine\ORM\EntityManager
    */
    protected $em;
 
    public function __construct(Request $request)
    {
        $this->request = $request;
    }
 
    public function __invoke()
    {
    	$memcache = $this->sm->getServiceLocator()->get('my_memcached_alias');
        $time_expire = $this->sm->getServiceLocator()->get('time_expire_cache_daily');
        
    	$new_courses = $this->getEntityManager()->getRepository('Courses\Entity\Courses')->getNewCoursesInCache($memcache,$time_expire);

    	return $new_courses;
    }

    public function getEntityManager() {    
        if (null === $this->em) {
            $this->em = $this->sm->getServiceLocator()->get('doctrine.entitymanager.orm_alternative_com');
        }
        return $this->em;
    }

    public function setEntityManager(EntityManager $em) {
        $this->em = $em;
    }

   /**
    * Retrieve service manager instance
    *
    * @return ServiceManager
    */
    public function getServiceManager()
    {
        return $this->sm->getServiceLocator();
    }

    /**
    * Set service manager instance
    *
    * @param ServiceManager $locator
    * @return void
    */
    public function setServiceManager(ServiceManager $serviceManager)
    {
        $this->sm = $serviceManager;
    } 
}