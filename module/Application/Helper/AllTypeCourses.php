<?php
namespace Application\Helper;
 
use Zend\Http\Request;
use Zend\View\Helper\AbstractHelper;

use Doctrine\ORM\EntityManager;
use Zend\ServiceManager\ServiceManagerAwareInterface;
use Zend\ServiceManager\ServiceManager;
 
class AllTypeCourses extends AbstractHelper 
{
    protected $request;
     /*
    * @var Doctrine\ORM\EntityManager
    */
    protected $em;
    protected $sm;
 
    //public function __construct(Request $request)
    public function __construct($sm)
    {
        $this->sm = $sm;
    }
 
    public function __invoke()
    {
        $memcache = $this->sm->getServiceLocator()->get('my_memcached_alias');
        $time_out = time()+60*60*24*30;
    	$type_courses = $this->getEntityManager()->getRepository('Courses\Entity\TypeCourses')->getTypesInCache($memcache,$time_out);
        return $type_courses;
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