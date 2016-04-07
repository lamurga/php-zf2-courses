<?php

namespace Courses\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Courses\Entity\DetailsLocationsCourses
 *
 * @ORM\Table(name="details_ct_locations_ct_courses")
 * @ORM\Entity(repositoryClass="Courses\Entity\DetailsLocationsCoursesRepository")
 */
class DetailsLocationsCourses
{
    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $id;

    /**
     * @var string $locationDetails
     *
     * @ORM\Column(name="location_details", type="string", length=45, nullable=true)
     */
    private $locationDetails;

    /**
     * @var string $scheduleInfo
     *
     * @ORM\Column(name="schedule_info", type="text", nullable=true)
     */
    private $scheduleInfo;

    /**
     * @var string $shiftConfig
     *
     * @ORM\Column(name="shift_config", type="text", nullable=true)
     */
    private $shiftConfig;

    /**
     * @var string $shiftIds
     *
     * @ORM\Column(name="shift_ids", type="string", length=50, nullable=true)
     */
    private $shiftIds;

    /**
     * @var string $shiftType
     *
     * @ORM\Column(name="shift_type", type="string", length=2, nullable=true)
     */
    private $shiftType;

    /**
     * @var Courses\Entity\Locations
     *
     * @ORM\ManyToOne(targetEntity="Courses\Entity\Locations")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ct_locations_id", referencedColumnName="id")
     * })
     */
    private $location;

    /**
     * @var Courses\Entity\Courses
     *
     * @ORM\ManyToOne(targetEntity="Courses\Entity\Courses")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ct_courses_id", referencedColumnName="id")
     * })
     */
    private $courses;


    /**
     * Set id
     *
     * @param integer $id
     * @return DetailsLocationsCourses
     */
    public function setId($id)
    {
        $this->id = $id;
    
        return $this;
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
     * Set locationDetails
     *
     * @param string $locationDetails
     * @return DetailsLocationsCourses
     */
    public function setLocationDetails($locationDetails)
    {
        $this->locationDetails = $locationDetails;
    
        return $this;
    }

    /**
     * Get locationDetails
     *
     * @return string 
     */
    public function getLocationDetails()
    {
        return $this->locationDetails;
    }

    /**
     * Set scheduleInfo
     *
     * @param string $scheduleInfo
     * @return DetailsLocationsCourses
     */
    public function setScheduleInfo($scheduleInfo)
    {
        $this->scheduleInfo = $scheduleInfo;
    
        return $this;
    }

    /**
     * Get scheduleInfo
     *
     * @return string 
     */
    public function getScheduleInfo()
    {
        return $this->scheduleInfo;
    }

    /**
     * Set shiftConfig
     *
     * @param string $shiftConfig
     * @return DetailsLocationsCourses
     */
    public function setShiftConfig($shiftConfig)
    {
        $this->shiftConfig = $shiftConfig;
    
        return $this;
    }

    /**
     * Get shiftConfig
     *
     * @return string 
     */
    public function getShiftConfig()
    {
        return $this->shiftConfig;
    }

    /**
     * Set shiftIds
     *
     * @param string $shiftIds
     * @return DetailsLocationsCourses
     */
    public function setShiftIds($shiftIds)
    {
        $this->shiftIds = $shiftIds;
    
        return $this;
    }

    /**
     * Get shiftIds
     *
     * @return string 
     */
    public function getShiftIds()
    {
        return $this->shiftIds;
    }

    /**
     * Set shiftType
     *
     * @param string $shiftType
     * @return DetailsLocationsCourses
     */
    public function setShiftType($shiftType)
    {
        $this->shiftType = $shiftType;
    
        return $this;
    }

    /**
     * Get shiftType
     *
     * @return string 
     */
    public function getShiftType()
    {
        return $this->shiftType;
    }

    /**
     * Set location
     *
     * @param Courses\Entity\Locations $location
     * @return DetailsLocationsCourses
     */
    public function setLocation(\Courses\Entity\Locations $location = null)
    {
        $this->location = $location;
    
        return $this;
    }

    /**
     * Get location
     *
     * @return Courses\Entity\Locations 
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * Set courses
     *
     * @param Courses\Entity\Courses $courses
     * @return DetailsLocationsCourses
     */
    public function setCourses(\Courses\Entity\Courses $courses = null)
    {
        $this->courses = $courses;
    
        return $this;
    }

    /**
     * Get courses
     *
     * @return Courses\Entity\Courses 
     */
    public function getCourses()
    {
        return $this->courses;
    }
}
