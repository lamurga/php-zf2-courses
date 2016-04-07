<?php

namespace Institutions\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Institutions\Entity\TempInstitutions
 *
 * @ORM\Table(name="ct_temp_institutions")
 * @ORM\Entity(repositoryClass="Institutions\Entity\TempInstitutionsRepository")
 */
class TempInstitutions
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
     * @var string $slug
     *
     * @ORM\Column(name="slug", type="string", length=255, nullable=true)
     */
    private $slug;

    /**
     * @var string $description
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;

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
     * @var string $tags
     *
     * @ORM\Column(name="tags", type="text", nullable=true)
     */
    private $tags;

    /**
     * @var string $logoName
     *
     * @ORM\Column(name="logo_name", type="string", length=20, nullable=true)
     */
    private $logoName;

    /**
     * @var boolean $status
     *
     * @ORM\Column(name="status", type="boolean", nullable=true)
     */
    private $status;

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
     * @return TempInstitutions
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
     * @return TempInstitutions
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
     * Set description
     *
     * @param string $description
     * @return TempInstitutions
     */
    public function setDescription($description)
    {
        $this->description = $description;
    
        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set metaTitle
     *
     * @param string $metaTitle
     * @return TempInstitutions
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
     * @return TempInstitutions
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
     * Set tags
     *
     * @param string $tags
     * @return TempInstitutions
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
     * Set logoName
     *
     * @param string $logoName
     * @return TempInstitutions
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
     * Set status
     *
     * @param boolean $status
     * @return TempInstitutions
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
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return TempInstitutions
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
     * @return TempInstitutions
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
     * Set type_institutions
     *
     * @param Institutions\Entity\TypeInstitutions $typeInstitutions
     * @return TempInstitutions
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
     * @return TempInstitutions
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
