<?php
namespace Complements\Form;

use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;
use DoctrineModule\Validator\NoObjectExists;
use DoctrineModule\Validator\ObjectExists;


class UserContactsFilter implements InputFilterAwareInterface
{
    protected $inputFilter;

    public function setInputFilter(InputFilterInterface $inputFilter)
    {
        throw new \Exception("Not used");
    }

    public function getInputFilter()
    {
        
        if (!$this->inputFilter) {
            $inputFilter = new InputFilter();
            $factory     = new InputFactory();
     
            $inputFilter->add($factory->createInput(array(
                'name'     => 'txtNombres',
                'required' => true,
                'filters'  => array(array('name' => 'StripTags'), array('name' => 'StringTrim')),
                'validators' => array(
                    array('name' => 'NotEmpty', 'options' => array('messages' => array( \Zend\Validator\NotEmpty::IS_EMPTY => 'Este campo es obligatorio' ))),
                ),
            )));

            $inputFilter->add($factory->createInput(array(
                'name'     => 'txtApellidos',
                'required' => true ,
                'validators' => array(
                    array('name' => 'NotEmpty', 'options' => array('messages' => array(\Zend\Validator\NotEmpty::IS_EMPTY => 'Este campo es obligatorio' ))),
                ),
            )));
            
            $inputFilter->add($factory->createInput(array(
                'name'     => 'txtEmail',
                'required' => true,
                'validators' => array(
                    array('name' => 'NotEmpty', 'options' => array('messages' => array(\Zend\Validator\NotEmpty::IS_EMPTY => 'Este campo es obligatorio' ))),
                    //array('name' => 'EmailAddress', 'options' => array('allow'=>false, 'messages' => array(\Zend\Validator\EmailAddress::INVALID_FORMAT => 'El formato de email es incorrecto' ))),
                    //array('name' => 'EmailAddress', 'options' => array('allow'=>false, 'messages' => array(\Zend\Validator\EmailAddress::INVALID_HOSTNAME => 'El nombre del host es incorrecto' ))),
                ),
            )));
                 
            $inputFilter->add($factory->createInput(array(
                'name'     => 'cboPais',
                'required' => true,
                'validators' => array(
                    array('name' => 'NotEmpty', 'options' => array('messages' => array(\Zend\Validator\NotEmpty::IS_EMPTY => 'Este campo es obligatorio' ))),
                ),
            )));

            $inputFilter->add($factory->createInput(array(
                'name'     => 'txtCiudad',
                'required' => true,
                'validators' => array(
                    array('name' => 'NotEmpty', 'options' => array('messages' => array(\Zend\Validator\NotEmpty::IS_EMPTY => 'Este campo es obligatorio' ))),
                ),
            )));
            
            $inputFilter->add($factory->createInput(array(
                'name'     => 'txtTemas',
                'required' => true,
                'validators' => array(
                    array('name' => 'NotEmpty', 'options' => array('messages' => array(\Zend\Validator\NotEmpty::IS_EMPTY => 'Este campo es obligatorio' ))),
                ),
            )));

            $inputFilter->add($factory->createInput(array(
                'name'     => 'chkTipos',
                'required' => true,
                'validators' => array(
                    array('name' => 'NotEmpty', 'options' => array('messages' => array(\Zend\Validator\NotEmpty::IS_EMPTY => 'Este campo es obligatorio' ))),
                ),
            )));
            
            $inputFilter->add($factory->createInput(array(
                'name'     => 'txtTelefono',
                'required' => false,
            )));
            
            $inputFilter->add($factory->createInput(array(
                'name'     => 'txtCelular',
                'required' => false,
            )));
                 
            $this->inputFilter = $inputFilter;
        }

        return $this->inputFilter;
    }

}