<?php
/**
 * Account Repository
 * @package       Auth Module
 */
namespace Courses\Entity;
use Doctrine\ORM\EntityRepository;
use Application\Module;

class TypeCoursesRepository extends EntityRepository
{
    /**
     * Authenticate user
     * @param           void
     * @return           void
     *
     */
    public function getTypes()
    {
        # get data
        return $this->findAll();
    }


    public function getTypesInCache($memcache=null, $mem_time_out=null)
    {        
        //$config = Module::getCustomConfig();
        //$mem_time_out = $config['cacheTimeExpire']; 
        $name_cache = 'mem_types_courses_'.COUNTRY_ABBREV;       
        
        if(!$memcache->get($name_cache)){ //La data no está en memcache, lo recuperamos de la bd y lo colocamos en memcache
            error_reporting(E_ALL ^ E_NOTICE); //Solo si queremos cachear una entidad, evita que muestre la noticia que no se pueden serializar objetos de tipo 'private'
            $q = $this->_em->createQueryBuilder()
                ->select('t')
                ->from('Courses\Entity\TypeCourses', 't')
                ->where('t.status = :status')
                ->setParameter('status', 1);
            $type_courses = $q->getQuery()->getResult();
    
            //$type_courses = $this->findAll();
            $memcache->add($name_cache, $type_courses, MEMCACHE_COMPRESSED, $mem_time_out);
        }else{
            $type_courses = $memcache->get($name_cache);
            //$memcache->delete($name_cache);
        }
            
        return $type_courses;
    }


}