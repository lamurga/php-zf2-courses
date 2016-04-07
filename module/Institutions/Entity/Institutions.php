<?php

namespace Institutions\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Institutions\Entity\Institutions
 *
 * @ORM\Table(name="ct_institutions")
 * @ORM\Entity(repositoryClass="Institutions\Entity\InstitutionsRepository")
 */
class Institutions
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
     * @ORM\Column(name="name", type="string", length=255, nullable=false)
     */
    private $name;

    /**
     * @var string $parentId
     *
     * @ORM\Column(name="parent_id", type="string", length=10, nullable=true)
     */
    private $parentId;

    /**
     * @var string $businessName
     *
     * @ORM\Column(name="business_name", type="string", length=100, nullable=false)
     */
    private $businessName;

    /**
     * @var string $ruc
     *
     * @ORM\Column(name="ruc", type="string", length=11, nullable=true)
     */
    private $ruc;

    /**
     * @var string $legalAddress
     *
     * @ORM\Column(name="legal_address", type="string", length=255, nullable=true)
     */
    private $legalAddress;

    /**
     * @var string $phone
     *
     * @ORM\Column(name="phone", type="string", length=15, nullable=true)
     */
    private $phone;

    /**
     * @var string $fax
     *
     * @ORM\Column(name="fax", type="string", length=10, nullable=true)
     */
    private $fax;

    /**
     * @var string $email
     *
     * @ORM\Column(name="email", type="string", length=100, nullable=true)
     */
    private $email;

    /**
     * @var string $website
     *
     * @ORM\Column(name="website", type="string", length=180, nullable=true)
     */
    private $website;

    /**
     * @var string $coordinates
     *
     * @ORM\Column(name="coordinates", type="string", length=120, nullable=true)
     */
    private $coordinates;

    /**
     * @var string $generalInformation
     *
     * @ORM\Column(name="general_information", type="text", nullable=true)
     */
    private $generalInformation;

    /**
     * @var string $generalOffer
     *
     * @ORM\Column(name="general_offer", type="text", nullable=true)
     */
    private $generalOffer;

    /**
     * @var \DateTime $createdAt
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=true)
     */
    private $createdAt;

    /**
     * @var \DateTime $updatedAt
     *
     * @ORM\Column(name="updated_at", type="datetime", nullable=true)
     */
    private $updatedAt;

    /**
     * @var integer $createdCoreCtUsersId
     *
     * @ORM\Column(name="created_core_ct_users_id", type="integer", nullable=true)
     */
    private $createdCoreCtUsersId;

    /**
     * @var integer $updatedCoreCtUsersId
     *
     * @ORM\Column(name="updated_core_ct_users_id", type="integer", nullable=true)
     */
    private $updatedCoreCtUsersId;

    /**
     * @var string $tags
     *
     * @ORM\Column(name="tags", type="text", nullable=true)
     */
    private $tags;

    /**
     * @var string $slug
     *
     * @ORM\Column(name="slug", type="string", length=255, nullable=true)
     */
    private $slug;

    /**
     * @var string $metaTitle
     *
     * @ORM\Column(name="meta_title", type="string", length=70, nullable=true)
     */
    private $metaTitle;

    /**
     * @var string $metaDescription
     *
     * @ORM\Column(name="meta_description", type="string", length=170, nullable=true)
     */
    private $metaDescription;

    /**
     * @var integer $crawlerId
     *
     * @ORM\Column(name="crawler_id", type="integer", nullable=true)
     */
    private $crawlerId;

    /**
     * @var boolean $isCrawler
     *
     * @ORM\Column(name="is_crawler", type="boolean", nullable=true)
     */
    private $isCrawler;

    /**
     * @var boolean $status
     *
     * @ORM\Column(name="status", type="boolean", nullable=true)
     */
    private $status;

    /**
     * @var string $logoName
     *
     * @ORM\Column(name="logo_name", type="string", length=20, nullable=true)
     */
    private $logoName;

    /**
     * @var Institutions\Entity\TypeInstitutions
     *
     * @ORM\ManyToOne(targetEntity="Institutions\Entity\TypeInstitutions")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ct_type_institutions_id", referencedColumnName="id")
     * })
     */
    private $type_institutions;

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
     * @return Institutions
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
     * Set parentId
     *
     * @param string $parentId
     * @return Institutions
     */
    public function setParentId($parentId)
    {
        $this->parentId = $parentId;
    
        return $this;
    }

    /**
     * Get parentId
     *
     * @return string 
     */
    public function getParentId()
    {
        return $this->parentId;
    }

    /**
     * Set businessName
     *
     * @param string $businessName
     * @return Institutions
     */
    public function setBusinessName($businessName)
    {
        $this->businessName = $businessName;
    
        return $this;
    }

    /**
     * Get businessName
     *
     * @return string 
     */
    public function getBusinessName()
    {
        return $this->businessName;
    }

    /**
     * Set ruc
     *
     * @param string $ruc
     * @return Institutions
     */
    public function setRuc($ruc)
    {
        $this->ruc = $ruc;
    
        return $this;
    }

    /**
     * Get ruc
     *
     * @return string 
     */
    public function getRuc()
    {
        return $this->ruc;
    }

    /**
     * Set legalAddress
     *
     * @param string $legalAddress
     * @return Institutions
     */
    public function setLegalAddress($legalAddress)
    {
        $this->legalAddress = $legalAddress;
    
        return $this;
    }

    /**
     * Get legalAddress
     *
     * @return string 
     */
    public function getLegalAddress()
    {
        return $this->legalAddress;
    }

    /**
     * Set phone
     *
     * @param string $phone
     * @return Institutions
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
     * Set fax
     *
     * @param string $fax
     * @return Institutions
     */
    public function setFax($fax)
    {
        $this->fax = $fax;
    
        return $this;
    }

    /**
     * Get fax
     *
     * @return string 
     */
    public function getFax()
    {
        return $this->fax;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return Institutions
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
     * Set website
     *
     * @param string $website
     * @return Institutions
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
     * Set coordinates
     *
     * @param string $coordinates
     * @return Institutions
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
     * Set generalInformation
     *
     * @param string $generalInformation
     * @return Institutions
     */
    public function setGeneralInformation($generalInformation)
    {
        $this->generalInformation = $generalInformation;
    
        return $this;
    }

    /**
     * Get generalInformation
     *
     * @return string 
     */
    public function getGeneralInformation()
    {
        return $this->generalInformation;
    }

    /**
     * Set generalOffer
     *
     * @param string $generalOffer
     * @return Institutions
     */
    public function setGeneralOffer($generalOffer)
    {
        $this->generalOffer = $generalOffer;
    
        return $this;
    }

    /**
     * Get generalOffer
     *
     * @return string 
     */
    public function getGeneralOffer()
    {
        return $this->generalOffer;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return Institutions
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

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     * @return Institutions
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;
    
        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime 
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Set createdCoreCtUsersId
     *
     * @param integer $createdCoreCtUsersId
     * @return Institutions
     */
    public function setCreatedCoreCtUsersId($createdCoreCtUsersId)
    {
        $this->createdCoreCtUsersId = $createdCoreCtUsersId;
    
        return $this;
    }

    /**
     * Get createdCoreCtUsersId
     *
     * @return integer 
     */
    public function getCreatedCoreCtUsersId()
    {
        return $this->createdCoreCtUsersId;
    }

    /**
     * Set updatedCoreCtUsersId
     *
     * @param integer $updatedCoreCtUsersId
     * @return Institutions
     */
    public function setUpdatedCoreCtUsersId($updatedCoreCtUsersId)
    {
        $this->updatedCoreCtUsersId = $updatedCoreCtUsersId;
    
        return $this;
    }

    /**
     * Get updatedCoreCtUsersId
     *
     * @return integer 
     */
    public function getUpdatedCoreCtUsersId()
    {
        return $this->updatedCoreCtUsersId;
    }

    /**
     * Set tags
     *
     * @param string $tags
     * @return Institutions
     */
    public function setTags($tags)
    {
        $this->tags = $tags;
    
        return $this;
    }

    /**
     * Get tags
     *
     * @return string 
     */
    public function getTags()
    {
        return $this->tags;
    }

    /**
     * Set slug
     *
     * @param string $slug
     * @return Institutions
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
     * Set metaTitle
     *
     * @param string $metaTitle
     * @return Institutions
     */
    public function setMetaTitle($metaTitle)
    {
        $this->metaTitle = $metaTitle;
    
        return $this;
    }

    /**
     * Get metaTitle
     *
     * @return string 
     */
    public function getMetaTitle()
    {
        return $this->metaTitle;
    }

    /**
     * Set metaDescription
     *
     * @param string $metaDescription
     * @return Institutions
     */
    public function setMetaDescription($metaDescription)
    {
        $this->metaDescription = $metaDescription;
    
        return $this;
    }

    /**
     * Get metaDescription
     *
     * @return string 
     */
    public function getMetaDescription()
    {
        return $this->metaDescription;
    }

    /**
     * Set crawlerId
     *
     * @param integer $crawlerId
     * @return Institutions
     */
    public function setCrawlerId($crawlerId)
    {
        $this->crawlerId = $crawlerId;
    
        return $this;
    }

    /**
     * Get crawlerId
     *
     * @return integer 
     */
    public function getCrawlerId()
    {
        return $this->crawlerId;
    }

    /**
     * Set isCrawler
     *
     * @param boolean $isCrawler
     * @return Institutions
     */
    public function setIsCrawler($isCrawler)
    {
        $this->isCrawler = $isCrawler;
    
        return $this;
    }

    /**
     * Get isCrawler
     *
     * @return boolean 
     */
    public function getIsCrawler()
    {
        return $this->isCrawler;
    }

    /**
     * Set status
     *
     * @param boolean $status
     * @return Institutions
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
     * Set logoName
     *
     * @param string $logoName
     * @return Institutions
     */
    public function setLogoName($logoName)
    {
        $this->logoName = $logoName;
    
        return $this;
    }

    /**
     * Get logoName
     *
     * @return string 
     */
    public function getLogoName()
    {
        return $this->logoName;
    }

    /**
     * Set type_institutions
     *
     * @param Institutions\Entity\TypeInstitutions $typeInstitutions
     * @return Institutions
     */
    public function setTypeInstitutions(\Institutions\Entity\TypeInstitutions $typeInstitutions = null)
    {
        $this->type_institutions = $typeInstitutions;
    
        return $this;
    }

    /**
     * Get type_institutions
     *
     * @return Institutions\Entity\TypeInstitutions 
     */
    public function getTypeInstitutions()
    {
        return $this->type_institutions;
    }

    /**
     * Set ubigeo
     *
     * @param Complements\Entity\Ubigeo $ubigeo
     * @return Institutions
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
}
