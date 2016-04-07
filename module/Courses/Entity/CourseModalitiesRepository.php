<?php
/**
 * Account Repository
 * @package       Auth Module
 */
namespace Courses\Entity;
use Doctrine\ORM\EntityRepository;
class CourseModalitiesRepository extends EntityRepository
{
    /**
     * Authenticate user
     * @param           void
     * @return           void
     *
     */
    public function getTypes()
    {
        # get data
        return $this->findAll();
    }
}