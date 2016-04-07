<?php

namespace Complements\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Complements\Entity\ExchangeRate
 *
 * @ORM\Table(name="ct_exchange_rate")
 * @ORM\Entity(repositoryClass="Complements\Entity\ExchangeRateRepository")
 */
class ExchangeRate
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
     * @var float $rate
     *
     * @ORM\Column(name="rate", type="float", nullable=true)
     */
    private $rate;

    /**
     * @var string $month
     *
     * @ORM\Column(name="month", type="string", length=2, nullable=true)
     */
    private $month;

    /**
     * @var string $year
     *
     * @ORM\Column(name="year", type="string", length=4)
     */
    private $year;

    /**
     * @var \DateTime $updatedAt
     *
     * @ORM\Column(name="updated_at", type="datetime", nullable=true)
     */
    private $updatedAt;


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
     * Set rate
     *
     * @param float $rate
     * @return ExchangeRate
     */
    public function setRate($rate)
    {
        $this->rate = $rate;
    
        return $this;
    }

    /**
     * Get rate
     *
     * @return float 
     */
    public function getRate()
    {
        return $this->rate;
    }

    /**
     * Set month
     *
     * @param string $month
     * @return ExchangeRate
     */
    public function setMonth($month)
    {
        $this->month = $month;
    
        return $this;
    }

    /**
     * Get month
     *
     * @return string 
     */
    public function getMonth()
    {
        return $this->month;
    }

    /**
     * Set year
     *
     * @param string $year
     * @return ExchangeRate
     */
    public function setYear($year)
    {
        $this->year = $year;
    
        return $this;
    }

    /**
     * Get year
     *
     * @return string 
     */
    public function getYear()
    {
        return $this->year;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     * @return ExchangeRate
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
}
