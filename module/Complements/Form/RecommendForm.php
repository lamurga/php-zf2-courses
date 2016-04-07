<?php
namespace Complements\Form;

use Zend\Form\Form;
use Zend\Form\Element;
use Application\Module;

class RecommendForm extends Form
{
    public function __construct()
    {
        parent::__construct('frmRecomienda');

        // Importante: Para mostrar los mensajes personalizados en la valicación de formularios (selects, emails, etc)
        $this->setUseInputFilterDefaults(false);

        // set attributes
        $this->setAttribute('class', 'form-full frmValidar');
        
        $this->add(array(
            'name'       => 'txtNombre',
            'type'       => 'Zend\Form\Element\Text',
            'attributes' => array('maxlength' => '80', 'size' => '25', 'class'=>"txtNombre"),
        ));
        
        $this->add(array(
            'name' => 'txtEmail',
            'type' => 'Zend\Form\Element\Email',
            'attributes' => array('maxlength' => '100', 'size' => '32', 'class'=>"txtEmail"),
            'options' => array('appendText' => '@'),
        ));
        
        $this->add(array(
            'name' => 'txtPara1',
            'type' => 'Zend\Form\Element\Email',
            'attributes' => array('maxlength' => '100', 'size' => '32', 'class'=>"txtEmail"),
            'options' => array('appendText' => '@'),
        ));
        
        $this->add(array(
            'name' => 'txtPara2',
            'type' => 'Zend\Form\Element\Email',
            'attributes' => array('maxlength' => '100', 'size' => '32', 'class'=>"mtop10  txtEmail2"),
            'options' => array('appendText' => '@'),
        ));
        
        $this->add(array(
            'name' => 'txtPara3',
            'type' => 'Zend\Form\Element\Email',
            'attributes' => array('maxlength' => '100', 'size' => '32', 'class'=>"mtop10  txtEmail2"),
            'options' => array('appendText' => '@'),
        ));
        
        $this->add(array(
            'name' => 'txtPara4',
            'type' => 'Zend\Form\Element\Email',
            'attributes' => array('maxlength' => '100', 'size' => '32', 'class'=>"mtop10  txtEmail2"),
            'options' => array('appendText' => '@'),
        ));
        
        $this->add(array(
            'name' => 'txtPara5',
            'type' => 'Zend\Form\Element\Email',
            'attributes' => array('maxlength' => '100', 'size' => '32', 'class'=>"mtop10  txtEmail2"),
            'options' => array('appendText' => '@'),
        ));

        $this->add(array(
            'name'       => 'txtMensaje',
            //'type'       => 'Zend\Form\Element\TextArea',
            'attributes' => array('maxlength' => '500', 'type' => 'textarea', 'size' => '500', 'class'=>"plano"),
        ));
        
        $this->add(array(
            'type' => 'Zend\Form\Element\Csrf',
            'name' => 'csrf'
        ));

        // Submit button
        $this->add(array(
            'name' => 'bt-recomendar',
            'type' => 'Zend\Form\Element\Submit',
            'attributes' => array('value' => 'recomendar', 'class'=>'boton btStandar mtop35 mbottom30'),
            'options' => array(),
        ));
    }

}