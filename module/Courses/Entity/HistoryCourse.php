<?php

namespace Courses\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Courses\Entity\HistoryCourse
 *
 * @ORM\Table(name="history_course")
 * @ORM\Entity
 */
class HistoryCourse
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
     * @var integer $coreCtUsersId
     *
     * @ORM\Column(name="core_ct_users_id", type="integer", nullable=true)
     */
    private $coreCtUsersId;

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
     * Set coreCtUsersId
     *
     * @param integer $coreCtUsersId
     * @return HistoryCourse
     */
    public function setCoreCtUsersId($coreCtUsersId)
    {
        $this->coreCtUsersId = $coreCtUsersId;
    
        return $this;
    }

    /**
     * Get coreCtUsersId
     *
     * @return integer 
     */
    public function getCoreCtUsersId()
    {
        return $this->coreCtUsersId;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     * @return HistoryCourse
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
