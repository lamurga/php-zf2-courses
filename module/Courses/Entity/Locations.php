<?php

namespace Courses\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Courses\Entity\Locations
 *
 * @ORM\Table(name="ct_locations")
 * @ORM\Entity(repositoryClass="Courses\Entity\LocationsRepository")
 */
class Locations
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
     * @var string $name
     *
     * @ORM\Column(name="name", type="string", length=150, nullable=false)
     */
    private $name;

    /**
     * @var string $coordinates
     *
     * @ORM\Column(name="coordinates", type="string", length=120, nullable=true)
     */
    private $coordinates;

    /**
     * @var string $address
     *
     * @ORM\Column(name="address", type="string", length=170, nullable=true)
     */
    private $address;

    /**
     * @var string $detailAddress
     *
     * @ORM\Column(name="detail_address", type="string", length=255, nullable=true)
     */
    private $detailAddress;

    /**
     * @var string $phoneOne
     *
     * @ORM\Column(name="phone_one", type="string", length=15, nullable=true)
     */
    private $phoneOne;

    /**
     * @var string $phoneTwo
     *
     * @ORM\Column(name="phone_two", type="string", length=15, nullable=true)
     */
    private $phoneTwo;

    /**
     * @var string $phoneThree
     *
     * @ORM\Column(name="phone_three", type="string", length=15, nullable=true)
     */
    private $phoneThree;

    /**
     * @var string $annexOne
     *
     * @ORM\Column(name="annex_one", type="string", length=15, nullable=true)
     */
    private $annexOne;

    /**
     * @var string $annexTwo
     *
     * @ORM\Column(name="annex_two", type="string", length=15, nullable=true)
     */
    private $annexTwo;

    /**
     * @var string $annexThree
     *
     * @ORM\Column(name="annex_three", type="string", length=15, nullable=true)
     */
    private $annexThree;

    /**
     * @var string $contactEmail
     *
     * @ORM\Column(name="contact_email", type="string", length=80, nullable=true)
     */
    private $contactEmail;

    /**
     * @var string $website
     *
     * @ORM\Column(name="website", type="string", length=120, nullable=true)
     */
    private $website;

    /**
     * @var boolean $status
     *
     * @ORM\Column(name="status", type="boolean", nullable=true)
     */
    private $status;

    /**
     * @var Complements\Entity\Ubigeo
     *
     * @ORM\ManyToOne(targetEntity="Complements\Entity\Ubigeo")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ct_ubigeo_id", referencedColumnName="id")
     * })
     */
    private $ubigeo;

    /**
     * @var Courses\Entity\TypeLocations
     *
     * @ORM\ManyToOne(targetEntity="Courses\Entity\TypeLocations")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ct_type_locations_id", referencedColumnName="id")
     * })
     */
    private $type_locations;


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
     * Set name
     *
     * @param string $name
     * @return Locations
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
     * Set coordinates
     *
     * @param string $coordinates
     * @return Locations
     */
    public function setCoordinates($coordinates)
    {
        $this->coordinates = $coordinates;
    
        return $this;
    }

    /**
     * Get coordinates
     *
     * @return string 
     */
    public function getCoordinates()
    {
        return $this->coordinates;
    }

    /**
     * Set address
     *
     * @param string $address
     * @return Locations
     */
    public function setAddress($address)
    {
        $this->address = $address;
    
        return $this;
    }

    /**
     * Get address
     *
     * @return string 
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set detailAddress
     *
     * @param string $detailAddress
     * @return Locations
     */
    public function setDetailAddress($detailAddress)
    {
        $this->detailAddress = $detailAddress;
    
        return $this;
    }

    /**
     * Get detailAddress
     *
     * @return string 
     */
    public function getDetailAddress()
    {
        return $this->detailAddress;
    }

    /**
     * Set phoneOne
     *
     * @param string $phoneOne
     * @return Locations
     */
    public function setPhoneOne($phoneOne)
    {
        $this->phoneOne = $phoneOne;
    
        return $this;
    }

    /**
     * Get phoneOne
     *
     * @return string 
     */
    public function getPhoneOne()
    {
        return $this->phoneOne;
    }

    /**
     * Set phoneTwo
     *
     * @param string $phoneTwo
     * @return Locations
     */
    public function setPhoneTwo($phoneTwo)
    {
        $this->phoneTwo = $phoneTwo;
    
        return $this;
    }

    /**
     * Get phoneTwo
     *
     * @return string 
     */
    public function getPhoneTwo()
    {
        return $this->phoneTwo;
    }

    /**
     * Set phoneThree
     *
     * @param string $phoneThree
     * @return Locations
     */
    public function setPhoneThree($phoneThree)
    {
        $this->phoneThree = $phoneThree;
    
        return $this;
    }

    /**
     * Get phoneThree
     *
     * @return string 
     */
    public function getPhoneThree()
    {
        return $this->phoneThree;
    }

    /**
     * Set annexOne
     *
     * @param string $annexOne
     * @return Locations
     */
    public function setAnnexOne($annexOne)
    {
        $this->annexOne = $annexOne;
    
        return $this;
    }

    /**
     * Get annexOne
     *
     * @return string 
     */
    public function getAnnexOne()
    {
        return $this->annexOne;
    }

    /**
     * Set annexTwo
     *
     * @param string $annexTwo
     * @return Locations
     */
    public function setAnnexTwo($annexTwo)
    {
        $this->annexTwo = $annexTwo;
    
        return $this;
    }

    /**
     * Get annexTwo
     *
     * @return string 
     */
    public function getAnnexTwo()
    {
        return $this->annexTwo;
    }

    /**
     * Set annexThree
     *
     * @param string $annexThree
     * @return Locations
     */
    public function setAnnexThree($annexThree)
    {
        $this->annexThree = $annexThree;
    
        return $this;
    }

    /**
     * Get annexThree
     *
     * @return string 
     */
    public function getAnnexThree()
    {
        return $this->annexThree;
    }

    /**
     * Set contactEmail
     *
     * @param string $contactEmail
     * @return Locations
     */
    public function setContactEmail($contactEmail)
    {
        $this->contactEmail = $contactEmail;
    
        return $this;
    }

    /**
     * Get contactEmail
     *
     * @return string 
     */
    public function getContactEmail()
    {
        return $this->contactEmail;
    }

    /**
     * Set website
     *
     * @param string $website
     * @return Locations
     */
    public function setWebsite($website)
    {
        $this->website = $website;
    
        return $this;
    }

    /**
     * Get website
     *
     * @return string 
     */
    public function getWebsite()
    {
        return $this->website;
    }

    /**
     * Set status
     *
     * @param boolean $status
     * @return Locations
     */
    public function setStatus($status)
    {
        $this->status = $status;
    
        return $this;
    }

    /**
     * Get status
     *
     * @return boolean 
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set ubigeo
     *
     * @param Complements\Entity\Ubigeo $ubigeo
     * @return Locations
     */
    public function setUbigeo(\Complements\Entity\Ubigeo $ubigeo = null)
    {
        $this->ubigeo = $ubigeo;
    
        return $this;
    }

    /**
     * Get ubigeo
     *
     * @return Complements\Entity\Ubigeo 
     */
    public function getUbigeo()
    {
        return $this->ubigeo;
    }

    /**
     * Set type_locations
     *
     * @param Courses\Entity\TypeLocations $typeLocations
     * @return Locations
     */
    public function setTypeLocations(\Courses\Entity\TypeLocations $typeLocations = null)
    {
        $this->type_locations = $typeLocations;
    
        return $this;
    }

    /**
     * Get type_locations
     *
     * @return Courses\Entity\TypeLocations 
     */
    public function getTypeLocations()
    {
        return $this->type_locations;
    }
}
