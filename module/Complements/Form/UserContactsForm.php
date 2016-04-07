<?php
namespace Complements\Form;

use Zend\Form\Form;
use Zend\Form\Element;
use Application\Module;

class UserContactsForm extends Form
{
    public function __construct($em, $memcache = null)
    {
        parent::__construct('frmContacto');

        // Importante: Para mostrar los mensajes personalizados en la valicación de formularios (selects, emails, etc)
        $this->setUseInputFilterDefaults(false);

        // set attributes
        $this->setAttribute('class', 'form-full frmValidar');
        
        $this->add(array(
            'name'       => 'txtNombres',
            'attributes' => array('maxlength' => '80', 'size' => '25', 'type' => 'text', 'class'=>"required"),
        ));
        
        $this->add(array(
            'name'       => 'txtApellidos',
            'attributes' => array('maxlength' => '80', 'size' => '25', 'type' => 'text', 'class'=>"required"),
            
        ));
        
        $this->add(array(
            'name' => 'txtEmail',
            'attributes' => array('maxlength' => '100', 'type' => 'text', 'size' => '32', 'class'=>"required email"),
            'options' => array('appendText' => '@'),
        ));

        $this->add(array(
            'name'       => 'txtTelefono',
            'attributes' => array('maxlength' => '12', 'size' => '25', 'type' => 'text', 'class'=>"txtTelefono"),            
        ));

        $this->add(array(
            'name'       => 'txtCelular',
            'attributes' => array('maxlength' => '30', 'size' => '25', 'type' => 'text'),            
        ));

        // Tipo de resultado
        $countries = array('ar'=>'Argentina', 'cl'=>'Chile', 'co'=>'Colombia', 'ec'=>'Ecuador', 'es'=>'España', 'mx'=>'México', 'pe'=>'Peru');
        $this->add(array(
            'type' => 'Zend\Form\Element\Select',   
            'name' => 'cboPais',
            'options' => array(
                'value_options' => $countries,
                ),
            'attributes' =>  array('value' => COUNTRY_ABBREV, 'class'=>'opt_selected required'),            
        ));

        $this->add(array(
            'name'       => 'txtCiudad',
            'attributes' => array('maxlength' => '30', 'size' => '25', 'type' => 'text', 'class'=>"required"),            
        ));

        # tipo de curso
        /*$choices_c = array('todo'=>'Todos los cursos');
        $typeCourses = $em->getRepository('Courses\Entity\TypeCourses')->getTypesInCache($memcache);
        foreach($typeCourses as $c) $choices_c[$c->getSlug()] = utf8_encode($c->getName());

        $this->add(array(
            'type' => 'Zend\Form\Element\MultiCheckbox',
            'name' => 'chkTipos',
            'attributes' => array('width' => "150", 'class' => 'required'),
            'options' => array(
                'value_options' => $choices_c
            )
        ));
        */
        // Tipo de resultado
        $results_type = array('Postgrado'=>'Postgrado', 'Carreras Pregrado'=>'Carreras Pregrado', 'Cursos Cortos'=>'Cursos Cortos', 'Cursos In-House'=>'Cursos In-House');
        $this->add(array(
            'type' => 'Zend\Form\Element\MultiCheckbox',
            'name' => 'chkTipos',
            'attributes' => array('width' => "150", 'class' => 'required'),
            'options' => array(
                'value_options' => $results_type
            )
        ));


        $this->add(array(
            'name'       => 'txtTemas',
            'attributes' => array('maxlength' => '30', 'size' => '25', 'type' => 'text', 'class'=>"required"),            
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