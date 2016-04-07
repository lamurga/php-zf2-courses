<?php

namespace Complements\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Complements\Entity\Ubigeo
 *
 * @ORM\Table(name="ct_ubigeo")
 * @ORM\Entity(repositoryClass="Complements\Entity\UbigeoRepository")
 */
class Ubigeo
{
    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var integer $parentId
     *
     * @ORM\Column(name="parent_id", type="integer", nullable=true)
     */
    private $parentId;

    /**
     * @var string $name
     *
     * @ORM\Column(name="name", type="string", length=100, nullable=false)
     */
    private $name;

    /**
     * @var string $slug
     *
     * @ORM\Column(name="slug", type="string", length=150, nullable=true)
     */
    private $slug;

    /**
     * @var string $latitude
     *
     * @ORM\Column(name="latitude", type="string", length=250, nullable=true)
     */
    private $latitude;

    /**
     * @var string $longitude
     *
     * @ORM\Column(name="longitude", type="string", length=250, nullable=true)
     */
    private $longitude;

    /**
     * @var integer $coursesQuantity
     *
     * @ORM\Column(name="courses_quantity", type="integer", nullable=true)
     */
    private $coursesQuantity;

    /**
     * @var string $localCode
     *
     * @ORM\Column(name="local_code", type="string", length=7, nullable=true)
     */
    private $localCode;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set parentId
     *
     * @param integer $parentId
     * @return Ubigeo
     */
    public function setParentId($parentId)
    {
        $this->parentId = $parentId;
    
        return $this;
    }

    /**
     * Get parentId
     *
     * @return integer 
     */
    public function getParentId()
    {
        return $this->parentId;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Ubigeo
     */
    public function setName($name)
    {
        $this->name = $name;
    
        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set slug
     *
     * @param string $slug
     * @return Ubigeo
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;
    
        return $this;
    }

    /**
     * Get slug
     *
     * @return string 
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set latitude
     *
     * @param string $latitude
     * @return Ubigeo
     */
    public function setLatitude($latitude)
    {
        $this->latitude = $latitude;
    
        return $this;
    }

    /**
     * Get latitude
     *
     * @return string 
     */
    public function getLatitude()
    {
        return $this->latitude;
    }

    /**
     * Set longitude
     *
     * @param string $longitude
     * @return Ubigeo
     */
    public function setLongitude($longitude)
    {
        $this->longitude = $longitude;
    
        return $this;
    }

    /**
     * Get longitude
     *
     * @return string 
     */
    public function getLongitude()
    {
        return $this->longitude;
    }

    /**
     * Set coursesQuantity
     *
     * @param integer $coursesQuantity
     * @return Ubigeo
     */
    public function setCoursesQuantity($coursesQuantity)
    {
        $this->coursesQuantity = $coursesQuantity;
    
        return $this;
    }

    /**
     * Get coursesQuantity
     *
     * @return integer 
     */
    public function getCoursesQuantity()
    {
        return $this->coursesQuantity;
    }

    /**
     * Set localCode
     *
     * @param string $localCode
     * @return Ubigeo
     */
    public function setLocalCode($localCode)
    {
        $this->localCode = $localCode;
    
        return $this;
    }

    /**
     * Get localCode
     *
     * @return string 
     */
    public function getLocalCode()
    {
        return $this->localCode;
    }
}
