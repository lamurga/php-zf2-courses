<?php
namespace Institutions\Entity;
use Doctrine\ORM\EntityRepository;
class InstitutionsRepository extends EntityRepository
{
	public function getIesByFilter($words, $type){
	    $q = $this->_em->createQueryBuilder()->select('i')->from('Institutions\Entity\Institutions', 'i');
	    $q = $q->where('i.name LIKE :words OR i.businessName LIKE :words OR i.tags LIKE :words');
	    //$q = $q->where('i.name LIKE :words OR i.businessName LIKE :words');
	    $q = $q->setParameter('words', '%'.$words.'%');
	    if($type > 0)
	    	$q = $q->andWhere('i.type_institutions = :type')->setParameter('type', $type);
	    
	    return $q; // Retornar el objeto sin formato para el paginador
	    //return $q->getQuery()->getResult();
	}

	public function getIesBySearch($words, $ieTypeSlug = null){
	    $q = $this->_em->createQueryBuilder()->select('i')->from('Institutions\Entity\Institutions', 'i');
	    $q = $q->where('i.name LIKE :words OR i.businessName LIKE :words OR i.tags LIKE :words');
	    //$q = $q->where('i.name LIKE :words OR i.businessName LIKE :words');
	    $q = $q->setParameter('words', '%'.$words.'%');
	    
	    if($ieTypeSlug){
	    	$q = $q->innerJoin('i.type_institutions', 't');
	    	if($ieTypeSlug != 'instituciones'){
	    		$q = $q->andWhere('t.slug = :typeSlug');
	    		$q = $q->setParameter('typeSlug', $ieTypeSlug);	
	    	}
	    }

	    //var_dump($q->getQuery()->getSql());
	    return $q; // Retornar el objeto sin formato para el paginador
	    //return $q->getQuery()->getResult();
	}

	public function getIesByName($name){
	    $q = $this->_em->createQueryBuilder()->select('i')->from('Institutions\Entity\Institutions', 'i');
	    $q = $q->where('i.name LIKE :name');
	    $q = $q->setParameter('name', '%'.$name.'%');
	    
	    return $q->getQuery()->getResult();
	}

	public function getCountIeByType($words, $ieTypeSlug = null){
	    $q = $this->_em->createQueryBuilder()->select('t.slug, t.name, COUNT(i.id) AS cant')->from('Institutions\Entity\Institutions', 'i');
	    $q = $q->where('i.name LIKE :words OR i.businessName LIKE :words OR i.tags LIKE :words');
	    $q = $q->setParameter('words', '%'.$words.'%');
	    $q = $q->innerJoin('i.type_institutions', 't');
	    if($ieTypeSlug){
	    	if($ieTypeSlug != 'instituciones'){
	    		$q = $q->andWhere('t.slug = :typeSlug');
	    		$q = $q->setParameter('typeSlug', $ieTypeSlug);	
	    	}
	    }

	    $q = $q->groupBy('t.name');
	    return $q->getQuery()->getResult();
	}
	
	public function getCountIeByType1()
	{   
	    $sql = " 
	        SELECT t.slug, t.name, COUNT(*) AS cant FROM ct_institutions i
			INNER JOIN ct_type_institutions t ON (i.ct_type_institutions_id = t.id)
			GROUP BY t.name ORDER BY cant DESC;
			";
	
	    $stmt = $this->getEntityManager()->getConnection()->prepare($sql);
	    $stmt->execute();
	    return $stmt->fetchAll();
	}

	public function getCountInstitutionsInCache($memcache = null, $mem_time_out = null){

		$name_cache = 'mem_institutions_'.COUNTRY_ABBREV;  
        
        if(!$memcache->get($name_cache)){ //La data no está en memcache, lo recuperamos de la bd y lo colocamos en memcache
            error_reporting(E_ALL ^ E_NOTICE); //Solo si queremos cachear una entidad, evita que muestre la noticia que no se pueden serializar objetos de tipo 'private'
            $institutions = $this->_em->createQueryBuilder()->select('i.id')->from('institutions\Entity\Institutions', 'i')->getQuery()->getResult();
            $memcache->add($name_cache, $institutions, MEMCACHE_COMPRESSED, $mem_time_out);
        }else{            
            $institutions = $memcache->get($name_cache);
            //$memcache->delete($name_cache);
        }
	    
	    return count($institutions);
	}
}
