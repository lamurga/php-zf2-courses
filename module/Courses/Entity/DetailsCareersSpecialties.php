<?php

namespace Courses\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Courses\Entity\DetailsCareersSpecialties
 *
 * @ORM\Table(name="detail_careers_specialties")
 * @ORM\Entity(repositoryClass="Courses\Entity\DetailsCareersSpecialtiesRepository")
 */
class DetailsCareersSpecialties
{
    /**
     * @var integer $amount
     *
     * @ORM\Column(name="amount", type="integer", nullable=true)
     */
    private $amount;

    /**
     * @var Courses\Entity\Careers
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\ManyToOne(targetEntity="Courses\Entity\Careers")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ct_careers_id", referencedColumnName="id")
     * })
     */
    private $ct_careers;

    /**
     * @var Courses\Entity\Specialties
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\ManyToOne(targetEntity="Courses\Entity\Specialties")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ct_specialties_id", referencedColumnName="id")
     * })
     */
    private $ct_specialties;


    /**
     * Set amount
     *
     * @param integer $amount
     * @return DetailsCareersSpecialties
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;
    
        return $this;
    }

    /**
     * Get amount
     *
     * @return integer 
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * Set ct_careers
     *
     * @param Courses\Entity\Careers $ctCareers
     * @return DetailsCareersSpecialties
     */
    public function setCtCareers(\Courses\Entity\Careers $ctCareers)
    {
        $this->ct_careers = $ctCareers;
    
        return $this;
    }

    /**
     * Get ct_careers
     *
     * @return Courses\Entity\Careers 
     */
    public function getCtCareers()
    {
        return $this->ct_careers;
    }

    /**
     * Set ct_specialties
     *
     * @param Courses\Entity\Specialties $ctSpecialties
     * @return DetailsCareersSpecialties
     */
    public function setCtSpecialties(\Courses\Entity\Specialties $ctSpecialties)
    {
        $this->ct_specialties = $ctSpecialties;
    
        return $this;
    }

    /**
     * Get ct_specialties
     *
     * @return Courses\Entity\Specialties 
     */
    public function getCtSpecialties()
    {
        return $this->ct_specialties;
    }
}
