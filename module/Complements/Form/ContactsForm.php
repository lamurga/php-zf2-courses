<?php
namespace Complements\Form;

use Zend\Form\Form;
use Zend\Form\Element;
use Application\Module;

class ContactsForm extends Form
{
    public function __construct()
    {
        parent::__construct('frmContacto');

        // Importante: Para mostrar los mensajes personalizados en la valicación de formularios (selects, emails, etc)
        $this->setUseInputFilterDefaults(false);

        // set attributes
        $this->setAttribute('class', 'form-full frmValidar');
        
        $this->add(array(
            'name'       => 'txtNombres',
            //'type'       => 'Zend\Form\Element\Text',
            'attributes' => array('maxlength' => '80', 'size' => '25', 'type' => 'text', 'class'=>"txtNombre"),
        ));
        
        $this->add(array(
            'name'       => 'txtApellidos',
            //'type'       => 'Zend\Form\Element\Text',
            'attributes' => array('maxlength' => '80', 'size' => '25', 'type' => 'text', 'class'=>"txtApellido"),
            
        ));
        
        $this->add(array(
            'name' => 'txtEmail',
            #'type' => 'Zend\Form\Element\Email',
            //'type' => 'Zend\Form\Element\Email',
            'attributes' => array('maxlength' => '100', 'type' => 'text', 'size' => '32', 'class'=>"txtEmail"),
            'options' => array('appendText' => '@'),
        ));

        $this->add(array(
            'name'       => 'txtTelefono',
            //'type'       => 'Zend\Form\Element\Text',
            'attributes' => array('maxlength' => '12', 'size' => '25', 'type' => 'text', 'class'=>"txtTelefono"),            
        ));

        $this->add(array(
            'name'       => 'txtAsunto',
            //'type'       => 'Zend\Form\Element\Text',
            'attributes' => array('maxlength' => '50', 'size' => '25', 'type' => 'text', 'class'=>"txtAsunto"),            
        ));

        $this->add(array(
            'name'       => 'txtMensaje',
            //'type'       => 'Zend\Form\Element\TextArea',
            'attributes' => array('maxlength' => '500', 'size' => '500', 'type' => 'textarea', 'class'=>"plano required"),
        ));
        
        $this->add(array(
            'type' => 'Zend\Form\Element\Csrf',
            'name' => 'csrf'
        ));

        // Submit button
        $this->add(array(
            'name' => 'bt-contacto',
            'type' => 'Zend\Form\Element\Submit',
            'attributes' => array('value' => 'Enviar Consulta', 'class'=>'boton'),
            'options' => array(),
        ));
    }

}