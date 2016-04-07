<?php
namespace Instituciones\Entity;
use Doctrine\ORM\Mapping as ORM;
/**
 * @ORM\Entity
 * @ORM\Table(name="tipo_instituciones")
 * @property int $id
 * @property string $nombre
 * @ORM\Entity(repositoryClass="Instituciones\Entity\TipoInstitucionesRepository")
 */
class TipoInstituciones 
{
    /**
    *primary identifier
    *
    * @ORM\Id 
    * @ORM\Column(type="integer")
    * @ORM\GeneratedValue(strategy="AUTO")
    * @var integer
    * @access protected
    */
    protected $id;

    /**
    *@ORM\Column(type="string",length=80,nullable=true)
    * @var string
    * @access protected
    */
    protected $nombre;
    
    /**
    *
    * @param \Doctrine\Common\Collections\Collection $property
    *
    * @ORM\OneToMany(targetEntity="Instituciones",mappedBy="instituciones", cascade={"persist","remove"})
    */
    private $instituciones;

    public function __get($property)
    {
        return $this->$property;
    }
    
    public function __set($property,$value)
    {
        $this->$property = $value;
    }
    
    /*
    public function getId()
    {
        return $this->id;
    }
    
    public function setId($id)
    {
        $this->id = $id;
    }
    
    public function getNombre()
    {
        return $this->nombre;
    }
    
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }
    */
    
    
}