<?php
namespace CoursesTest\Entity;

use PHPUnit_Framework_TestCase;
use Courses\Entity\Courses;
//use Courses\Entity\Photos;

class CoursesTest extends PHPUnit_Framework_TestCase
{

    public function testNewCourses()
    {
        $courses = new Courses;
        $this->assertInstanceOf('Courses\Entity\Courses', $courses);
        unset($courses);
    }

    public function testGetName()
    {
        $courses = new Courses;
        $courses->setName('Curso de lamurga');
        $this->assertEquals('Curso de lamurga', $courses->getName());
        unset($courses);
    }

}