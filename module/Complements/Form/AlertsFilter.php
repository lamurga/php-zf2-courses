<?php
namespace Complements\Form;

use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;
use DoctrineModule\Validator\NoObjectExists;
use DoctrineModule\Validator\ObjectExists;


class AlertsFilter implements InputFilterAwareInterface
{
    protected $inputFilter;

    public function setInputFilter(InputFilterInterface $inputFilter)
    {
        throw new \Exception("Not used");
    }

    public function getInputFilter($userId=null, $em=null, $data=array())
    {   if($data)
            $email = ($data['txtEmail'] == '') ? null : $data['txtEmail'];
        
        if (!$this->inputFilter) {
            $inputFilter = new InputFilter();
            $factory     = new InputFactory();
            
            $emailFilter = array('name' => 'StringLength', 'options' => array('min' => 3));
            if(is_null($userId) and !is_null($em)){ //La validación de usuario existente solo se realizará cuando no está logueado
                $emailExist = $em->getRepository('Users\Entity\User')->findOneBy(array('email'=>$email));
                if($emailExist){
                    $emailFilter = new NoObjectExists(array(
                        'object_repository' => $em->getRepository('Users\Entity\User'),
                        'fields' => array('email')
                    ));
                    $emailFilter->setMessage('El email ingresado, ya existe.');
                }    
            }
        
            $inputFilter->add($factory->createInput(array(
                'name'     => 'txtEmail',
                'required' => true,
                'validators' => array(
                    $emailFilter,
                    array('name' => 'EmailAddress', 'options' => array('messages' => array(\Zend\Validator\EmailAddress::INVALID_FORMAT => 'El formato de email es incorrecto' ))),
                    array('name' => 'NotEmpty', 'options' => array('messages' => array(\Zend\Validator\NotEmpty::IS_EMPTY => 'Este campo es obligatorio' ))),
                ),
            )));
    
            $inputFilter->add($factory->createInput(array(
                'name'     => 'txtTag1',
                'required' => true,
                'filters'  => array(array('name' => 'StripTags'), array('name' => 'StringTrim')),
                'validators' => array(
                    array('name' => 'NotEmpty', 'options' => array('messages' => array( \Zend\Validator\NotEmpty::IS_EMPTY => 'Este campo es obligatorio' ))),
                ),
            )));

            $inputFilter->add($factory->createInput(array(
                'name'     => 'txtTag2',
                'required' => false ,
                'validators' => array(
                    array('name' => 'NotEmpty', 'options' => array('messages' => array(\Zend\Validator\NotEmpty::IS_EMPTY => 'Este campo es obligatorio' ))),
                ),
            )));
            
            $inputFilter->add($factory->createInput(array(
                'name'     => 'txtTag3',
                'required' => false,
                'validators' => array(
                    array('name' => 'NotEmpty', 'options' => array('messages' => array(\Zend\Validator\NotEmpty::IS_EMPTY => 'Este campo es obligatorio' ))),
                ),
            )));
                 
            $inputFilter->add($factory->createInput(array(
                'name'     => 'txtName',
                'required' => true,
                'validators' => array(
                    array('name' => 'NotEmpty', 'options' => array('messages' => array(\Zend\Validator\NotEmpty::IS_EMPTY => 'Este campo es obligatorio' ))),
                ),
            )));
                        
            $inputFilter->add($factory->createInput(array(
                'name'     => 'tipo_curso',
                'required' => false,
            )));
                 
            $inputFilter->add($factory->createInput(array(
                'name'     => 'ciudades',
                'required' => false,
            )));
                 
                 
            $this->inputFilter = $inputFilter;
        }

        return $this->inputFilter;
    }

}