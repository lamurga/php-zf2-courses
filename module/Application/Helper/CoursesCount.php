<?php
namespace Application\Helper;

use Application\Module;
use Zend\Http\Request;
use Zend\View\Helper\AbstractHelper;
use Doctrine\ORM\EntityManager;
use Zend\ServiceManager\ServiceManagerAwareInterface;
use Zend\ServiceManager\ServiceManager;
 
class CoursesCount extends AbstractHelper
{
    protected $request;
     /*
    * @var Doctrine\ORM\EntityManager
    */
    protected $em;
    protected $sm;
 
    public function __construct($sm)
    {
        $this->sm = $sm;
    }
 
    public function __invoke()
    {
        $memcache = $this->sm->getServiceLocator()->get('my_memcached_alias');
        $time_expire = $this->sm->getServiceLocator()->get('time_expire_cache_daily');
        
        $courses = $this->getEntityManager()->getRepository('Courses\Entity\Courses')->getCountCoursesInCache($memcache,$time_expire);
    	return number_format($courses);

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

}