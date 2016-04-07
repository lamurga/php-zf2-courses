<?php
namespace Institutions\Form;

use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;
use DoctrineModule\Validator\NoObjectExists;
use DoctrineModule\Validator\ObjectExists;


class IntitutionContactFilter implements InputFilterAwareInterface
{
    protected $inputFilter;

    public function setInputFilter(InputFilterInterface $inputFilter)
    {
        throw new \Exception("Not used");
    }

    public function getInputFilter($em=null, $data=array())
    {
        $userId = ($data['id'] == '') ? null : $data['id'];
        $email = ($data['txtEmail'] == '') ? null : $data['txtEmail'];

        if (!$this->inputFilter) {
            $inputFilter = new InputFilter();
            $factory     = new InputFactory();
            
            $emailFilter = array('name' => 'StringLength', 'options' => array('min' => 3));
            $emailExist = $em->getRepository('Users\Entity\User')->emailExists($userId, $email);
            
            if(count($emailExist) == 0){
                $emailFilter = new NoObjectExists(array(
                    'object_repository' => $em->getRepository('Users\Entity\User'),
                    'fields' => array('email')
                ));
                $emailFilter->setMessage('El email ingresado, ya existe.');
            }
        
            $inputFilter->add($factory->createInput(array(
                'name'     => 'txtEmail',
                'required' => true,
                'validators' => array(
                    array('name' => 'NotEmpty', 'options' => array('messages' => array(\Zend\Validator\NotEmpty::IS_EMPTY => 'Este campo es obligatorio' ))),
                    array('name' => 'EmailAddress', 'options' => array('messages' => array(\Zend\Validator\EmailAddress::INVALID_FORMAT => 'El formato de email es incorrecto' ))),
                    $emailFilter,
                ),
            )));
    
            $inputFilter->add($factory->createInput(array(
                'name'     => 'contacto',
                'required' => true,
                'filters'  => array(array('name' => 'StripTags'), array('name' => 'StringTrim')),
                'validators' => array(
                    array('name' => 'NotEmpty', 'options' => array('messages' => array( \Zend\Validator\NotEmpty::IS_EMPTY => 'Este campo es obligatorio' ))),
                ),
            )));

            $inputFilter->add($factory->createInput(array(
                'name'     => 'apellido',
                'required' => true ,
                'validators' => array(
                    array('name' => 'NotEmpty', 'options' => array('messages' => array(\Zend\Validator\NotEmpty::IS_EMPTY => 'Este campo es obligatorio' ))),
                ),
            )));
            
            $inputFilter->add($factory->createInput(array(
                'name'     => 'txtTelefono',
                'required' => true,
                'validators' => array(
                    array('name' => 'NotEmpty', 'options' => array('messages' => array(\Zend\Validator\NotEmpty::IS_EMPTY => 'Este campo es obligatorio' ))),
                ),
            )));

            $inputFilter->add($factory->createInput(array(
                'name'     => 'txtTelefono2',
                'required' => true,
                'validators' => array(
                    array('name' => 'NotEmpty', 'options' => array('messages' => array(\Zend\Validator\NotEmpty::IS_EMPTY => 'Este campo es obligatorio' ))),
                ),
            )));
            

            $this->inputFilter = $inputFilter;
        }

        return $this->inputFilter;
    }

}