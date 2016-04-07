<?php
/**
 * Account Repository
 * @package       Auth Module
 */
namespace Institutions\Entity;
use Doctrine\ORM\EntityRepository;
use Application\Module;

class TypeInstitutionsRepository extends EntityRepository
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

    public function getTypesInCache($memcache=null)
    {        
        $config = Module::getCustomConfig();
        $mem_time_out = $config['cacheTimeExpire'];
        
        if(!$memcache->get('mem_types_ie_es')){ //La data no está en memcache, lo recuperamos de la bd y lo colocamos en memcache
            error_reporting(E_ALL ^ E_NOTICE); //Solo si queremos cachear una entidad, evita que muestre la noticia que no se pueden serializar objetos de tipo 'private'
            $type_ie = $this->findAll();
            $memcache->add("mem_types_ie_es", $type_ie, MEMCACHE_COMPRESSED, $mem_time_out);
        }else{
            $type_ie = $memcache->get("mem_types_ie_es");
            //$memcache->delete('mem_types_ie_es');
        }
            
        return $type_ie;
    }

}