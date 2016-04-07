<?php
namespace Application\Helper;

use Application\Module;
use Application\library\Utils;
use Zend\Http\Request;
use Zend\View\Helper\AbstractHelper;
use Doctrine\ORM\EntityManager;
use Zend\ServiceManager\ServiceManagerAwareInterface;
use Zend\ServiceManager\ServiceManager;
 
class CoursesBySearchCount extends AbstractHelper
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
 
    public function __invoke($words,$courseTypeSlug)
    {        
        $utils = new Utils();
        $words = $utils->normalizeWords($words);

        if(!is_null($words)){
            $courses = $this->getEntityManager()->getRepository('Courses\Entity\Courses')->getCountCoursesBySearch($words,$courseTypeSlug);
    	    return number_format($courses);
        }else{
            return 0;
        }
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