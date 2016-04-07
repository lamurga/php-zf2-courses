<?php

namespace Complements\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Complements\Entity\MoreInfo
 *
 * @ORM\Table(name="ct_more_info")
 * @ORM\Entity(repositoryClass="Complements\Entity\MoreInfoRepository")
 */
class MoreInfo
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
     * @ORM\Column(name="name", type="string", length=50, nullable=true)
     */
    private $name;

    /**
     * @var string $last_name
     *
     * @ORM\Column(name="last_name", type="string", length=50, nullable=true)
     */
    private $last_name;

    /**
     * @var string $email
     *
     * @ORM\Column(name="email", type="string", length=50, nullable=true)
     */
    private $email;

    /**
     * @var string $phone
     *
     * @ORM\Column(name="phone", type="string", length=30, nullable=true)
     */
    private $phone;

    /**
     * @var string $cellphone
     *
     * @ORM\Column(name="cellphone", type="string", length=30, nullable=true)
     */
    private $cellphone;

    /**
     * @var string $city
     *
     * @ORM\Column(name="city", type="string", length=80, nullable=true)
     */
    private $city;

    /**
     * @var string $country
     *
     * @ORM\Column(name="country", type="string", length=15, nullable=true)
     */
    private $country;

    /**
     * @var string $course_type
     *
     * @ORM\Column(name="course_type", type="string", length=250, nullable=true)
     */
    private $course_type;

    /**
     * @var string $topics_interest
     *
     * @ORM\Column(name="topics_interest", type="string", length=250, nullable=true)
     */
    private $topics_interest;

    /**
     * @var string $url_ref
     *
     * @ORM\Column(name="url_ref", type="string", length=250, nullable=true)
     */
    private $url_ref;

    /**
     * @var \DateTime $createdAt
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=true)
     */
    private $createdAt;


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
     * @return MoreInfo
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
     * Set last_name
     *
     * @param string $lastName
     * @return MoreInfo
     */
    public function setLastName($lastName)
    {
        $this->last_name = $lastName;
    
        return $this;
    }

    /**
     * Get last_name
     *
     * @return string 
     */
    public function getLastName()
    {
        return $this->last_name;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return MoreInfo
     */
    public function setEmail($email)
    {
        $this->email = $email;
    
        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set phone
     *
     * @param string $phone
     * @return MoreInfo
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
    
        return $this;
    }

    /**
     * Get phone
     *
     * @return string 
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set cellphone
     *
     * @param string $cellphone
     * @return MoreInfo
     */
    public function setCellphone($cellphone)
    {
        $this->cellphone = $cellphone;
    
        return $this;
    }

    /**
     * Get cellphone
     *
     * @return string 
     */
    public function getCellphone()
    {
        return $this->cellphone;
    }

    /**
     * Set city
     *
     * @param string $city
     * @return MoreInfo
     */
    public function setCity($city)
    {
        $this->city = $city;
    
        return $this;
    }

    /**
     * Get city
     *
     * @return string 
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set country
     *
     * @param string $country
     * @return MoreInfo
     */
    public function setCountry($country)
    {
        $this->country = $country;
    
        return $this;
    }

    /**
     * Get country
     *
     * @return string 
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Set course_type
     *
     * @param string $courseType
     * @return MoreInfo
     */
    public function setCourseType($courseType)
    {
        $this->course_type = $courseType;
    
        return $this;
    }

    /**
     * Get course_type
     *
     * @return string 
     */
    public function getCourseType()
    {
        return $this->course_type;
    }

    /**
     * Set topics_interest
     *
     * @param string $topicsInterest
     * @return MoreInfo
     */
    public function setTopicsInterest($topicsInterest)
    {
        $this->topics_interest = $topicsInterest;
    
        return $this;
    }

    /**
     * Get topics_interest
     *
     * @return string 
     */
    public function getTopicsInterest()
    {
        return $this->topics_interest;
    }

    /**
     * Set url_ref
     *
     * @param string $urlRef
     * @return MoreInfo
     */
    public function setUrlRef($urlRef)
    {
        $this->url_ref = $urlRef;
    
        return $this;
    }

    /**
     * Get url_ref
     *
     * @return string 
     */
    public function getUrlRef()
    {
        return $this->url_ref;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return MoreInfo
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
    
        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime 
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }
}
