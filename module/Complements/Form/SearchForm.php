<?php
namespace Complements\Form;

use Zend\Form\Form;
use Zend\Form\Element;

class SearchForm extends Form
{
    /**
     * Create the form
     * 
     * @param string $name Optional name for the form
     */
    private $_em;
    public function __construct($em, $memcache, $type=null) 
    {
        $this->_em = $em;
        // call constructor
        parent::__construct('search');
        
        // set attributes
        $this->setAttribute('method', 'post');
        
        // add id
        $this->add(array(
            'name' => 't',
            'type' => 'Zend\Form\Element\Hidden',
            'attributes'=> array('value' => $type),
        ));
        
        $this->add(array(
            'name'       => 'q',
            'type'       => 'Zend\Form\Element\Text',
            'attributes' => array('maxlength' => '60', 'size' => '32', 'placeholder'=> 'Palabras clave', 'class'=>'txt-letter-small txtPClave'),
        ));
        
        # tipo de curso
        $choices_c = array('todo'=>'Todos los cursos');
        $typeCourses = $em->getRepository('Courses\Entity\TypeCourses')->getTypesInCache($memcache);
        foreach($typeCourses as $c) $choices_c[$c->getSlug()] = utf8_encode($c->getName());

        $this->add(array(
            'type' => 'Zend\Form\Element\Select',
            'name' => 'course_type',
            'attributes' =>  array('id' => 'course_type', 'options' => $choices_c),
        ));
        
        # tipo de IEs
        $choices_i = array('instituciones'=>'Todas las instituciones');
        $typeInstitutions = $this->_em->getRepository('Institutions\Entity\TypeInstitutions')->getTypesInCache($memcache);
        foreach($typeInstitutions as $i) $choices_i[$i->getSlug()] = utf8_encode($i->getName());

        $this->add(array(
            'type' => 'Zend\Form\Element\Select',
            'name' => 'ie_type',
            'attributes' =>  array('id' => 'ie_type', 'options' => $choices_i),
        ));
        
        // Submit button
        $this->add(array(
            'name' => 'submit',
            'type' => 'Zend\Form\Element\Submit',
            'attributes' => array('value' => 'Buscar', 'class'=>'btSearch'),
            'options' => array(),
        ));
    }

}