<?php

namespace Courses\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Courses\Entity\TempCourses
 *
 * @ORM\Table(name="ct_temp_courses")
 * @ORM\Entity(repositoryClass="Courses\Entity\TempCoursesRepository")
 */
class TempCourses
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
     * @var integer $updatedCoreCtUsersId
     *
     * @ORM\Column(name="updated_core_ct_users_id", type="integer", nullable=true)
     */
    private $updatedCoreCtUsersId;

    /**
     * @var string $name
     *
     * @ORM\Column(name="name", type="string", length=220, nullable=false)
     */
    private $name;

    /**
     * @var string $duration
     *
     * @ORM\Column(name="duration", type="string", length=45, nullable=false)
     */
    private $duration;

    /**
     * @var string $description
     *
     * @ORM\Column(name="description", type="text", nullable=false)
     */
    private $description;

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
     * @var string $metaTags
     *
     * @ORM\Column(name="meta_tags", type="text", nullable=true)
     */
    private $metaTags;

    /**
     * @var float $price
     *
     * @ORM\Column(name="price", type="float", nullable=true)
     */
    private $price;

    /**
     * @var \DateTime $startDate
     *
     * @ORM\Column(name="start_date", type="date", nullable=true)
     */
    private $startDate;

    /**
     * @var \DateTime $endDate
     *
     * @ORM\Column(name="end_date", type="date", nullable=true)
     */
    private $endDate;

    /**
     * @var string $certification
     *
     * @ORM\Column(name="certification", type="text", nullable=true)
     */
    private $certification;

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
     * @var Institutions\Entity\TempInstitutions
     *
     * @ORM\ManyToOne(targetEntity="Institutions\Entity\TempInstitutions")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ct_temp_institutions_id", referencedColumnName="id")
     * })
     */
    private $temp_institutions;

    /**
     * @var Courses\Entity\TypeCourses
     *
     * @ORM\ManyToOne(targetEntity="Courses\Entity\TypeCourses")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ct_type_courses_id", referencedColumnName="id")
     * })
     */
    private $type_courses;

    /**
     * @var Courses\Entity\CourseModalities
     *
     * @ORM\ManyToOne(targetEntity="Courses\Entity\CourseModalities")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ct_course_modalities_id", referencedColumnName="id")
     * })
     */
    private $course_modalities;


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
     * Set updatedCoreCtUsersId
     *
     * @param integer $updatedCoreCtUsersId
     * @return TempCourses
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
     * Set name
     *
     * @param string $name
     * @return TempCourses
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
     * Set duration
     *
     * @param string $duration
     * @return TempCourses
     */
    public function setDuration($duration)
    {
        $this->duration = $duration;
    
        return $this;
    }

    /**
     * Get duration
     *
     * @return string 
     */
    public function getDuration()
    {
        return $this->duration;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return TempCourses
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
     * Set slug
     *
     * @param string $slug
     * @return TempCourses
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
     * @return TempCourses
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
     * @return TempCourses
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
     * Set metaTags
     *
     * @param string $metaTags
     * @return TempCourses
     */
    public function setMetaTags($metaTags)
    {
        $this->metaTags = $metaTags;
    
        return $this;
    }

    /**
     * Get metaTags
     *
     * @return string 
     */
    public function getMetaTags()
    {
        return $this->metaTags;
    }

    /**
     * Set price
     *
     * @param float $price
     * @return TempCourses
     */
    public function setPrice($price)
    {
        $this->price = $price;
    
        return $this;
    }

    /**
     * Get price
     *
     * @return float 
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set startDate
     *
     * @param \DateTime $startDate
     * @return TempCourses
     */
    public function setStartDate($startDate)
    {
        $this->startDate = $startDate;
    
        return $this;
    }

    /**
     * Get startDate
     *
     * @return \DateTime 
     */
    public function getStartDate()
    {
        return $this->startDate;
    }

    /**
     * Set endDate
     *
     * @param \DateTime $endDate
     * @return TempCourses
     */
    public function setEndDate($endDate)
    {
        $this->endDate = $endDate;
    
        return $this;
    }

    /**
     * Get endDate
     *
     * @return \DateTime 
     */
    public function getEndDate()
    {
        return $this->endDate;
    }

    /**
     * Set certification
     *
     * @param string $certification
     * @return TempCourses
     */
    public function setCertification($certification)
    {
        $this->certification = $certification;
    
        return $this;
    }

    /**
     * Get certification
     *
     * @return string 
     */
    public function getCertification()
    {
        return $this->certification;
    }

    /**
     * Set status
     *
     * @param boolean $status
     * @return TempCourses
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
     * @return TempCourses
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
     * @return TempCourses
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
     * Set temp_institutions
     *
     * @param Institutions\Entity\TempInstitutions $tempInstitutions
     * @return TempCourses
     */
    public function setTempInstitutions(\Institutions\Entity\TempInstitutions $tempInstitutions = null)
    {
        $this->temp_institutions = $tempInstitutions;
    
        return $this;
    }

    /**
     * Get temp_institutions
     *
     * @return Institutions\Entity\TempInstitutions 
     */
    public function getTempInstitutions()
    {
        return $this->temp_institutions;
    }

    /**
     * Set type_courses
     *
     * @param Courses\Entity\TypeCourses $typeCourses
     * @return TempCourses
     */
    public function setTypeCourses(\Courses\Entity\TypeCourses $typeCourses = null)
    {
        $this->type_courses = $typeCourses;
    
        return $this;
    }

    /**
     * Get type_courses
     *
     * @return Courses\Entity\TypeCourses 
     */
    public function getTypeCourses()
    {
        return $this->type_courses;
    }

    /**
     * Set course_modalities
     *
     * @param Courses\Entity\CourseModalities $courseModalities
     * @return TempCourses
     */
    public function setCourseModalities(\Courses\Entity\CourseModalities $courseModalities = null)
    {
        $this->course_modalities = $courseModalities;
    
        return $this;
    }

    /**
     * Get course_modalities
     *
     * @return Courses\Entity\CourseModalities 
     */
    public function getCourseModalities()
    {
        return $this->course_modalities;
    }
}
