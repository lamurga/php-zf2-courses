<?php
namespace Instituciones\Entity;
use Doctrine\ORM\Mapping as ORM;
/**
*
* @ORM\Entity
* @ORM\Table(name="instituciones")
* @property int $id
* @property string $nombre
* @property string $ciudad
* @property string $descripcion
* @ORM\Entity(repositoryClass="Instituciones\Entity\InstitucionesRepository")
*/
class Instituciones
{
  /**
   * Primary Identifier
   *
   * @ORM\Id
   * @ORM\Column(type="integer")
   * @ORM\GeneratedValue(strategy="AUTO")
   * @var integer
   * @access protected
   */
  protected $id;
  
  /**
   *
   * @ORM\Column(type="string")
   * @var string
   * @access protected
   */
  protected $nombre;

  /**
   *
   * @ORM\Column(type="string")
   * @var string
   * @access protected
   */
  protected $ciudad;
  
  /**
   * descripcionual content of our Blog Post
   *
   * @ORM\Column(type="text")
   * @var string
   * @access protected
   */
  protected $descripcion;
  
  /**
   * Sets the Identifier
   *
   * @param int $id
   * @access public
   */

  /**
    * @var TipoInstituciones
    * @ORM\ManyToOne(targetEntity="TipoInstituciones")
    * @ORM\JoinColumns({
    *   @ORM\JoinColumn(name="tipo_instituciones", referencedColumnName="id")
    * })
  */
  private $tipo_instituciones;

  public function __construct()
  {
    $this->created = new \DateTime(date("Y-m-d H:i:s"));
  }
  
      /**
* Magic getter to expose protected properties.
*
* @param string $property
* @return mixed
*/
    public function __get($property)
    {
        return $this->$property;
    }

    /**
* Magic setter to save protected properties.
*
* @param string $property
* @param mixed $value
*/
    public function __set($property, $value)
    {
        $this->$property = $value;
    }


    /**
* Convert the object to an array.
*
* @return array
*/
    public function getArrayCopy()
    {
        return get_object_vars($this);
    }

    /**
* Populate from an array.
*
* @param array $data
*/
    public function populate($data = array())
    {
        //$this->id = $data['id'];
        $this->nombre = $data['nombre'];
        $this->descripcion = $data['descripcion'];
        $this->ciudad = $data['ciudad'];
        $this->tipo_instituciones = $data['tipo_instituciones'];
    }

    public function setInputFilter(InputFilterInterface $inputFilter)
    {
        throw new \Exception("Not used");
    }

    public function getInputFilter()
    {
        if (!$this->inputFilter) {
            $inputFilter = new InputFilter();

            $factory = new InputFactory();

            $inputFilter->add($factory->createInput(array(
                'name' => 'id',
                'required' => true,
                'filters' => array(
                    array('name' => 'Int'),
                ),
            )));

            $inputFilter->add($factory->createInput(array(
                'name' => 'nombre',
                'required' => true,
                'filters' => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                'validators' => array(
                    array(
                        'name' => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min' => 1,
                            'max' => 100,
                        ),
                    ),
                ),
            )));

            $inputFilter->add($factory->createInput(array(
                'name' => 'descripcion',
                'required' => true,
                'filters' => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                'validators' => array(
                    array(
                        'name' => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min' => 1,
                            'max' => 100,
                        ),
                    ),
                ),
            )));

            $inputFilter->add($factory->createInput(array(
                'name' => 'ciudad',
                'required' => true,
                'filters' => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                'validators' => array(
                    array(
                        'name' => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min' => 1,
                            'max' => 100,
                        ),
                    ),
                ),
            )));

            $inputFilter->add($factory->createInput(array(
                'name' => 'tipo_instituciones',
                'required' => true,
                'filters' => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                'validators' => array(
                    array(
                        'name' => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min' => 1,
                            'max' => 100,
                        ),
                    ),
                ),
            )));

            $this->inputFilter = $inputFilter;
        }

        return $this->inputFilter;
    }

}