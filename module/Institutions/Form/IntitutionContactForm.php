<?php
namespace Institutions\Form;

use Zend\Form\Form;
use Zend\Form\Element;
use Application\Module;

class IntitutionContactForm extends Form
{
    public function __construct()
    {
        
        parent::__construct('formie');

        // set attributes
        //$this->setAttribute('method', 'post');
        $this->setAttribute('class', 'frmValidar');
        $this->setUseInputFilterDefaults(false);
        
        // add id
        $this->add(array(
            'name' => 'id',
            'type' => 'Zend\Form\Element\Hidden',
        ));
        
        $this->add(array(
            'name'       => 'contacto',
            'type'       => 'Zend\Form\Element\Text',
            'attributes' => array('maxlength' => '60', 'size' => '32', 'class'=>"txtPlano required"),
            
        ));
        
        $this->add(array(
            'name'       => 'apellido',
            'type'       => 'Zend\Form\Element\Text',
            'attributes' => array('maxlength' => '80', 'size' => '32', 'class'=>"txtPlano required"),
            
        ));
        
         $this->add(array(
            'name' => 'txtEmail',
            'type' => 'Zend\Form\Element\Email',
            'attributes' => array('maxlength' => '128', 'size' => '32', 'class'=>'required email'),
            'options' => array('appendText' => '@'),
        ));

        $this->add(array(
            'name'       => 'txtTelefono',
            'type'       => 'Zend\Form\Element\Text',
            'attributes' => array('maxlength' => '4', 'size' => '4', 'class'=>'width40', 'value'=>'+51'),
        ));

        $this->add(array(
            'name'       => 'txtTelefono2',
            'type'       => 'Zend\Form\Element\Text',
            'attributes' => array('maxlength' => '9', 'size' => '9', 'class'=>'width200 required digits'),
        ));
        
        $this->add(array(
            'name'       => 'txtComentarios',
            'type'       => 'Zend\Form\Element\TextArea',
            'attributes' => array('maxlength' => '500', 'size' => '500'),
        ));
        
        $this->add(array(
            'type' => 'Zend\Form\Element\Csrf',
            'name' => 'csrf'
        ));

       
        // Submit button
        $this->add(array(
            'name' => 'register_contact_save',
            'type' => 'Zend\Form\Element\Submit',
            'attributes' => array('value' => 'Enviar mis datos', 'class'=>'boton'),
            'options' => array(),
        ));
    }

}