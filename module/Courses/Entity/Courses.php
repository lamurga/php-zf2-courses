<?php

namespace Courses\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Courses\Entity\Courses
 *
 * @ORM\Table(name="ct_courses")
 * @ORM\Entity(repositoryClass="Courses\Entity\CoursesRepository")
 */
class Courses
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
     * @var string $parentId
     *
     * @ORM\Column(name="parent_id", type="string", length=10, nullable=true)
     */
    private $parentId;

    /**
     * @var integer $createdCoreCtUsersId
     *
     * @ORM\Column(name="created_core_ct_users_id", type="integer", nullable=false)
     */
    private $createdCoreCtUsersId;

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
     * @ORM\Column(name="duration", type="string", length=45, nullable=true)
     */
    private $duration;

    /**
     * @var string $description
     *
     * @ORM\Column(name="description", type="text", nullable=false)
     */
    private $description;

    /**
     * @var string $shortTitle
     *
     * @ORM\Column(name="short_title", type="string", length=70, nullable=true)
     */
    private $shortTitle;

    /**
     * @var string $shortDescription
     *
     * @ORM\Column(name="short_description", type="string", length=170, nullable=true)
     */
    private $shortDescription;

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
     * @var string $numberParticipants
     *
     * @ORM\Column(name="number_participants", type="string", length=20, nullable=true)
     */
    private $numberParticipants;

    /**
     * @var string $numberTimes
     *
     * @ORM\Column(name="number_times", type="string", length=20, nullable=true)
     */
    private $numberTimes;

    /**
     * @var boolean $numbersExhibitors
     *
     * @ORM\Column(name="numbers_exhibitors", type="boolean", nullable=true)
     */
    private $numbersExhibitors;

    /**
     * @var string $treatTopic
     *
     * @ORM\Column(name="treat_topic", type="text", nullable=true)
     */
    private $treatTopic;

    /**
     * @var string $treatTopicFile
     *
     * @ORM\Column(name="treat_topic_file", type="blob", nullable=true)
     */
    private $treatTopicFile;

    /**
     * @var string $methodology
     *
     * @ORM\Column(name="methodology", type="text", nullable=true)
     */
    private $methodology;

    /**
     * @var string $otherCertification
     *
     * @ORM\Column(name="other_certification", type="text", nullable=true)
     */
    private $otherCertification;

    /**
     * @var string $otherCosts
     *
     * @ORM\Column(name="other_costs", type="text", nullable=true)
     */
    private $otherCosts;

    /**
     * @var string $otherTimes
     *
     * @ORM\Column(name="other_times", type="text", nullable=true)
     */
    private $otherTimes;

    /**
     * @var string $otherInformation
     *
     * @ORM\Column(name="other_information", type="text", nullable=true)
     */
    private $otherInformation;

    /**
     * @var string $requirements
     *
     * @ORM\Column(name="requirements", type="text", nullable=true)
     */
    private $requirements;

    /**
     * @var string $exhibitorSummary
     *
     * @ORM\Column(name="exhibitor_summary", type="text", nullable=true)
     */
    private $exhibitorSummary;

    /**
     * @var string $includesMaterial
     *
     * @ORM\Column(name="includes_material", type="text", nullable=true)
     */
    private $includesMaterial;

    /**
     * @var string $registerMethod
     *
     * @ORM\Column(name="register_method", type="text", nullable=true)
     */
    private $registerMethod;

    /**
     * @var string $participantProfile
     *
     * @ORM\Column(name="participant_profile", type="text", nullable=true)
     */
    private $participantProfile;

    /**
     * @var string $dataInformation
     *
     * @ORM\Column(name="data_information", type="text", nullable=true)
     */
    private $dataInformation;

    /**
     * @var string $methodPayment
     *
     * @ORM\Column(name="method_payment", type="text", nullable=true)
     */
    private $methodPayment;

    /**
     * @var string $dataSource
     *
     * @ORM\Column(name="data_source", type="text", nullable=true)
     */
    private $dataSource;

    /**
     * @var string $tagsInstitution
     *
     * @ORM\Column(name="tags_institution", type="string", length=45, nullable=true)
     */
    private $tagsInstitution;

    /**
     * @var string $contactEmail
     *
     * @ORM\Column(name="contact_email", type="string", length=100, nullable=true)
     */
    private $contactEmail;

    /**
     * @var boolean $ccd
     *
     * @ORM\Column(name="ccd", type="boolean", nullable=true)
     */
    private $ccd;

    /**
     * @var integer $moneyType
     *
     * @ORM\Column(name="money_type", type="integer", length=1, nullable=true)
     */
    private $moneyType;

    /**
     * @var integer $igv
     *
     * @ORM\Column(name="igv", type="integer", length=1, nullable=true)
     */
    private $igv;

    /**
     * @var boolean $certificationType
     *
     * @ORM\Column(name="certification_type", type="boolean", nullable=true)
     */
    private $certificationType;

    /**
     * @var string $status
     *
     * @ORM\Column(name="status", type="string", length=45, nullable=true)
     */
    private $status;

    /**
     * @var boolean $isCrawler
     *
     * @ORM\Column(name="is_crawler", type="boolean", nullable=true)
     */
    private $isCrawler;

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
     * @var \DateTime $publishedAt
     *
     * @ORM\Column(name="published_at", type="datetime", nullable=true)
     */
    private $publishedAt;

    /**
     * @var Institutions\Entity\Institutions
     *
     * @ORM\ManyToOne(targetEntity="Institutions\Entity\Institutions")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ct_institutions_id", referencedColumnName="id")
     * })
     */
    private $institutions;

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
     * @var \Doctrine\Common\Collections\ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="Courses\Entity\Certification", inversedBy="courses")
     * @ORM\JoinTable(name="ct_courses_ct_certification",
     *   joinColumns={
     *     @ORM\JoinColumn(name="ct_course_id", referencedColumnName="id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="ct_certification_id", referencedColumnName="id")
     *   }
     * )
     */
    private $certification;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="Users\Entity\Exhibitors", inversedBy="courses")
     * @ORM\JoinTable(name="ct_courses_ct_exhibitors",
     *   joinColumns={
     *     @ORM\JoinColumn(name="ct_course_id", referencedColumnName="id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="ct_exhibitors_id", referencedColumnName="id")
     *   }
     * )
     */
    private $exhibitors;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="Courses\Entity\Careers", inversedBy="courses")
     * @ORM\JoinTable(name="ct_courses_ct_careers",
     *   joinColumns={
     *     @ORM\JoinColumn(name="ct_course_id", referencedColumnName="id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="ct_careers_id", referencedColumnName="id")
     *   }
     * )
     */
    private $careers;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="Courses\Entity\Videos", inversedBy="courses")
     * @ORM\JoinTable(name="ct_courses_ct_videos",
     *   joinColumns={
     *     @ORM\JoinColumn(name="ct_course_id", referencedColumnName="id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="ct_videos_id", referencedColumnName="id")
     *   }
     * )
     */
    private $videos;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="Courses\Entity\Photos", inversedBy="courses")
     * @ORM\JoinTable(name="ct_courses_ct_photos",
     *   joinColumns={
     *     @ORM\JoinColumn(name="ct_course_id", referencedColumnName="id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="ct_photos_id", referencedColumnName="id")
     *   }
     * )
     */
    private $photos;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->certification = new \Doctrine\Common\Collections\ArrayCollection();
        $this->exhibitors = new \Doctrine\Common\Collections\ArrayCollection();
        $this->careers = new \Doctrine\Common\Collections\ArrayCollection();
        $this->videos = new \Doctrine\Common\Collections\ArrayCollection();
        $this->photos = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
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
     * @param string $parentId
     * @return Courses
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
     * Set createdCoreCtUsersId
     *
     * @param integer $createdCoreCtUsersId
     * @return Courses
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
     * @return Courses
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
     * @return Courses
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
     * @return Courses
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
     * @return Courses
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
     * Set shortTitle
     *
     * @param string $shortTitle
     * @return Courses
     */
    public function setShortTitle($shortTitle)
    {
        $this->shortTitle = $shortTitle;
    
        return $this;
    }

    /**
     * Get shortTitle
     *
     * @return string 
     */
    public function getShortTitle()
    {
        return $this->shortTitle;
    }

    /**
     * Set shortDescription
     *
     * @param string $shortDescription
     * @return Courses
     */
    public function setShortDescription($shortDescription)
    {
        $this->shortDescription = $shortDescription;
    
        return $this;
    }

    /**
     * Get shortDescription
     *
     * @return string 
     */
    public function getShortDescription()
    {
        return $this->shortDescription;
    }

    /**
     * Set slug
     *
     * @param string $slug
     * @return Courses
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
     * @return Courses
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
     * @return Courses
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
     * @return Courses
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
     * @return Courses
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
     * @return Courses
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
     * @return Courses
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
     * Set numberParticipants
     *
     * @param string $numberParticipants
     * @return Courses
     */
    public function setNumberParticipants($numberParticipants)
    {
        $this->numberParticipants = $numberParticipants;
    
        return $this;
    }

    /**
     * Get numberParticipants
     *
     * @return string 
     */
    public function getNumberParticipants()
    {
        return $this->numberParticipants;
    }

    /**
     * Set numberTimes
     *
     * @param string $numberTimes
     * @return Courses
     */
    public function setNumberTimes($numberTimes)
    {
        $this->numberTimes = $numberTimes;
    
        return $this;
    }

    /**
     * Get numberTimes
     *
     * @return string 
     */
    public function getNumberTimes()
    {
        return $this->numberTimes;
    }

    /**
     * Set numbersExhibitors
     *
     * @param boolean $numbersExhibitors
     * @return Courses
     */
    public function setNumbersExhibitors($numbersExhibitors)
    {
        $this->numbersExhibitors = $numbersExhibitors;
    
        return $this;
    }

    /**
     * Get numbersExhibitors
     *
     * @return boolean 
     */
    public function getNumbersExhibitors()
    {
        return $this->numbersExhibitors;
    }

    /**
     * Set treatTopic
     *
     * @param string $treatTopic
     * @return Courses
     */
    public function setTreatTopic($treatTopic)
    {
        $this->treatTopic = $treatTopic;
    
        return $this;
    }

    /**
     * Get treatTopic
     *
     * @return string 
     */
    public function getTreatTopic()
    {
        return $this->treatTopic;
    }

    /**
     * Set treatTopicFile
     *
     * @param string $treatTopicFile
     * @return Courses
     */
    public function setTreatTopicFile($treatTopicFile)
    {
        $this->treatTopicFile = $treatTopicFile;
    
        return $this;
    }

    /**
     * Get treatTopicFile
     *
     * @return string 
     */
    public function getTreatTopicFile()
    {
        return $this->treatTopicFile;
    }

    /**
     * Set methodology
     *
     * @param string $methodology
     * @return Courses
     */
    public function setMethodology($methodology)
    {
        $this->methodology = $methodology;
    
        return $this;
    }

    /**
     * Get methodology
     *
     * @return string 
     */
    public function getMethodology()
    {
        return $this->methodology;
    }

    /**
     * Set otherCertification
     *
     * @param string $otherCertification
     * @return Courses
     */
    public function setOtherCertification($otherCertification)
    {
        $this->otherCertification = $otherCertification;
    
        return $this;
    }

    /**
     * Get otherCertification
     *
     * @return string 
     */
    public function getOtherCertification()
    {
        return $this->otherCertification;
    }

    /**
     * Set otherCosts
     *
     * @param string $otherCosts
     * @return Courses
     */
    public function setOtherCosts($otherCosts)
    {
        $this->otherCosts = $otherCosts;
    
        return $this;
    }

    /**
     * Get otherCosts
     *
     * @return string 
     */
    public function getOtherCosts()
    {
        return $this->otherCosts;
    }

    /**
     * Set otherTimes
     *
     * @param string $otherTimes
     * @return Courses
     */
    public function setOtherTimes($otherTimes)
    {
        $this->otherTimes = $otherTimes;
    
        return $this;
    }

    /**
     * Get otherTimes
     *
     * @return string 
     */
    public function getOtherTimes()
    {
        return $this->otherTimes;
    }

    /**
     * Set otherInformation
     *
     * @param string $otherInformation
     * @return Courses
     */
    public function setOtherInformation($otherInformation)
    {
        $this->otherInformation = $otherInformation;
    
        return $this;
    }

    /**
     * Get otherInformation
     *
     * @return string 
     */
    public function getOtherInformation()
    {
        return $this->otherInformation;
    }

    /**
     * Set requirements
     *
     * @param string $requirements
     * @return Courses
     */
    public function setRequirements($requirements)
    {
        $this->requirements = $requirements;
    
        return $this;
    }

    /**
     * Get requirements
     *
     * @return string 
     */
    public function getRequirements()
    {
        return $this->requirements;
    }

    /**
     * Set exhibitorSummary
     *
     * @param string $exhibitorSummary
     * @return Courses
     */
    public function setExhibitorSummary($exhibitorSummary)
    {
        $this->exhibitorSummary = $exhibitorSummary;
    
        return $this;
    }

    /**
     * Get exhibitorSummary
     *
     * @return string 
     */
    public function getExhibitorSummary()
    {
        return $this->exhibitorSummary;
    }

    /**
     * Set includesMaterial
     *
     * @param string $includesMaterial
     * @return Courses
     */
    public function setIncludesMaterial($includesMaterial)
    {
        $this->includesMaterial = $includesMaterial;
    
        return $this;
    }

    /**
     * Get includesMaterial
     *
     * @return string 
     */
    public function getIncludesMaterial()
    {
        return $this->includesMaterial;
    }

    /**
     * Set registerMethod
     *
     * @param string $registerMethod
     * @return Courses
     */
    public function setRegisterMethod($registerMethod)
    {
        $this->registerMethod = $registerMethod;
    
        return $this;
    }

    /**
     * Get registerMethod
     *
     * @return string 
     */
    public function getRegisterMethod()
    {
        return $this->registerMethod;
    }

    /**
     * Set participantProfile
     *
     * @param string $participantProfile
     * @return Courses
     */
    public function setParticipantProfile($participantProfile)
    {
        $this->participantProfile = $participantProfile;
    
        return $this;
    }

    /**
     * Get participantProfile
     *
     * @return string 
     */
    public function getParticipantProfile()
    {
        return $this->participantProfile;
    }

    /**
     * Set dataInformation
     *
     * @param string $dataInformation
     * @return Courses
     */
    public function setDataInformation($dataInformation)
    {
        $this->dataInformation = $dataInformation;
    
        return $this;
    }

    /**
     * Get dataInformation
     *
     * @return string 
     */
    public function getDataInformation()
    {
        return $this->dataInformation;
    }

    /**
     * Set methodPayment
     *
     * @param string $methodPayment
     * @return Courses
     */
    public function setMethodPayment($methodPayment)
    {
        $this->methodPayment = $methodPayment;
    
        return $this;
    }

    /**
     * Get methodPayment
     *
     * @return string 
     */
    public function getMethodPayment()
    {
        return $this->methodPayment;
    }

    /**
     * Set dataSource
     *
     * @param string $dataSource
     * @return Courses
     */
    public function setDataSource($dataSource)
    {
        $this->dataSource = $dataSource;
    
        return $this;
    }

    /**
     * Get dataSource
     *
     * @return string 
     */
    public function getDataSource()
    {
        return $this->dataSource;
    }

    /**
     * Set tagsInstitution
     *
     * @param string $tagsInstitution
     * @return Courses
     */
    public function setTagsInstitution($tagsInstitution)
    {
        $this->tagsInstitution = $tagsInstitution;
    
        return $this;
    }

    /**
     * Get tagsInstitution
     *
     * @return string 
     */
    public function getTagsInstitution()
    {
        return $this->tagsInstitution;
    }

    /**
     * Set contactEmail
     *
     * @param string $contactEmail
     * @return Courses
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
     * Set ccd
     *
     * @param boolean $ccd
     * @return Courses
     */
    public function setCcd($ccd)
    {
        $this->ccd = $ccd;
    
        return $this;
    }

    /**
     * Get ccd
     *
     * @return boolean 
     */
    public function getCcd()
    {
        return $this->ccd;
    }

    /**
     * Set moneyType
     *
     * @param integer $moneyType
     * @return Courses
     */
    public function setMoneyType($moneyType)
    {
        $this->moneyType = $moneyType;
    
        return $this;
    }

    /**
     * Get moneyType
     *
     * @return integer 
     */
    public function getMoneyType()
    {
        return $this->moneyType;
    }

    /**
     * Set igv
     *
     * @param integer $igv
     * @return Courses
     */
    public function setIgv($igv)
    {
        $this->igv = $igv;
    
        return $this;
    }

    /**
     * Get igv
     *
     * @return integer 
     */
    public function getIgv()
    {
        return $this->igv;
    }

    /**
     * Set certificationType
     *
     * @param boolean $certificationType
     * @return Courses
     */
    public function setCertificationType($certificationType)
    {
        $this->certificationType = $certificationType;
    
        return $this;
    }

    /**
     * Get certificationType
     *
     * @return boolean 
     */
    public function getCertificationType()
    {
        return $this->certificationType;
    }

    /**
     * Set status
     *
     * @param string $status
     * @return Courses
     */
    public function setStatus($status)
    {
        $this->status = $status;
    
        return $this;
    }

    /**
     * Get status
     *
     * @return string 
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set isCrawler
     *
     * @param boolean $isCrawler
     * @return Courses
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
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return Courses
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
     * @return Courses
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
     * Set publishedAt
     *
     * @param \DateTime $publishedAt
     * @return Courses
     */
    public function setPublishedAt($publishedAt)
    {
        $this->publishedAt = $publishedAt;
    
        return $this;
    }

    /**
     * Get publishedAt
     *
     * @return \DateTime 
     */
    public function getPublishedAt()
    {
        return $this->publishedAt;
    }

    /**
     * Set institutions
     *
     * @param Institutions\Entity\Institutions $institutions
     * @return Courses
     */
    public function setInstitutions(\Institutions\Entity\Institutions $institutions = null)
    {
        $this->institutions = $institutions;
    
        return $this;
    }

    /**
     * Get institutions
     *
     * @return Institutions\Entity\Institutions 
     */
    public function getInstitutions()
    {
        return $this->institutions;
    }

    /**
     * Set type_courses
     *
     * @param Courses\Entity\TypeCourses $typeCourses
     * @return Courses
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
     * @return Courses
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

    /**
     * Add certification
     *
     * @param Courses\Entity\Certification $certification
     * @return Courses
     */
    public function addCertification(\Courses\Entity\Certification $certification)
    {
        $this->certification[] = $certification;
    
        return $this;
    }

    /**
     * Remove certification
     *
     * @param Courses\Entity\Certification $certification
     */
    public function removeCertification(\Courses\Entity\Certification $certification)
    {
        $this->certification->removeElement($certification);
    }

    /**
     * Get certification
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getCertification()
    {
        return $this->certification;
    }

    /**
     * Add exhibitors
     *
     * @param Users\Entity\Exhibitors $exhibitors
     * @return Courses
     */
    public function addExhibitor(\Users\Entity\Exhibitors $exhibitors)
    {
        $this->exhibitors[] = $exhibitors;
    
        return $this;
    }

    /**
     * Remove exhibitors
     *
     * @param Users\Entity\Exhibitors $exhibitors
     */
    public function removeExhibitor(\Users\Entity\Exhibitors $exhibitors)
    {
        $this->exhibitors->removeElement($exhibitors);
    }

    /**
     * Get exhibitors
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getExhibitors()
    {
        return $this->exhibitors;
    }

    /**
     * Add careers
     *
     * @param Courses\Entity\Careers $careers
     * @return Courses
     */
    public function addCareer(\Courses\Entity\Careers $careers)
    {
        $this->careers[] = $careers;
    
        return $this;
    }

    /**
     * Remove careers
     *
     * @param Courses\Entity\Careers $careers
     */
    public function removeCareer(\Courses\Entity\Careers $careers)
    {
        $this->careers->removeElement($careers);
    }

    /**
     * Get careers
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getCareers()
    {
        return $this->careers;
    }

    /**
     * Add videos
     *
     * @param Courses\Entity\Videos $videos
     * @return Courses
     */
    public function addVideo(\Courses\Entity\Videos $videos)
    {
        $this->videos[] = $videos;
    
        return $this;
    }

    /**
     * Remove videos
     *
     * @param Courses\Entity\Videos $videos
     */
    public function removeVideo(\Courses\Entity\Videos $videos)
    {
        $this->videos->removeElement($videos);
    }

    /**
     * Get videos
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getVideos()
    {
        return $this->videos;
    }

    /**
     * Add photos
     *
     * @param Courses\Entity\Photos $photos
     * @return Courses
     */
    public function addPhoto(\Courses\Entity\Photos $photos)
    {
        $this->photos[] = $photos;
    
        return $this;
    }

    /**
     * Remove photos
     *
     * @param Courses\Entity\Photos $photos
     */
    public function removePhoto(\Courses\Entity\Photos $photos)
    {
        $this->photos->removeElement($photos);
    }

    /**
     * Get photos
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getPhotos()
    {
        return $this->photos;
    }
}
