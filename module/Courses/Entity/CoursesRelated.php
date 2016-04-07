<?php

namespace Courses\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Courses\Entity\CoursesRelated
 *
 * @ORM\Table(name="ct_courses_related")
 * @ORM\Entity(repositoryClass="Courses\Entity\CoursesRelatedRepository")
 */
class CoursesRelated
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
     * @var string $related
     *
     * @ORM\Column(name="related", type="text", nullable=false)
     */
    private $related;

    /**
     * @var Courses\Entity\Courses
     *
     * @ORM\OneToOne(targetEntity="Courses\Entity\Courses")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="courses_id", referencedColumnName="id", unique=true)
     * })
     */
    private $courses;


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
     * Set related
     *
     * @param string $related
     * @return CoursesRelated
     */
    public function setRelated($related)
    {
        $this->related = $related;
    
        return $this;
    }

    /**
     * Get related
     *
     * @return string 
     */
    public function getRelated()
    {
        return $this->related;
    }

    /**
     * Set courses
     *
     * @param Courses\Entity\Courses $courses
     * @return CoursesRelated
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
