<?php
namespace Institutions\Form;

use Zend\Form\Form;
use Zend\Form\Element;
use Application\Module;

class InstitutionsRegisterForm extends Form
{
    private $_em;
    
    public function __construct($em, $memcache = null)
    {
        $this->_em = $em;
        parent::__construct('frmInstitucion');
        $this->setUseInputFilterDefaults(false);

        // set attributes
        //$this->setAttribute('method', 'post');
        $this->setAttribute('class', 'frmValidar');
        
        
        // add id
        $this->add(array(
            'name' => 'id',
            'type' => 'Zend\Form\Element\Hidden',
        ));
        
        $this->add(array(
            'name'       => 'txtInstitucion',
            //'type' => 'Zend\Form\Element\Email',
            'attributes' => array('maxlength' => '80', 'size' => '32', 'type' => 'text', 'class'=>"txtNombre"),
            
        ));
        
        $this->add(array(
            'name'       => 'txtRazonSocial',
            //'type' => 'Zend\Form\Element\Email',
            'attributes' => array('maxlength' => '50', 'size' => '32', 'type' => 'text', 'class'=>"txtCadena"),
            
        ));

        # tipo de IEs
        $choices_i = array('0'=>'Todas las instituciones');
        $typeInstitutions = $this->_em->getRepository('Institutions\Entity\TypeInstitutions')->getTypesInCache($memcache);
        foreach($typeInstitutions as $i) $choices_i[$i->getId()] = utf8_encode($i->getName());

        $this->add(array(
            'type' => 'Zend\Form\Element\Select',
            'name' => 'tipo-institucion',
            'attributes' =>  array('id' => 'tipo-institucion', 'options' => $choices_i),
        ));
        

        $this->add(array(
            'name'       => 'txtRUC',
            //'type' => 'Zend\Form\Element\Email',
            'attributes' => array('maxlength' => '20', 'size' => '32', 'type' => 'text', 'class'=>"txtRuc"),
        ));
        
        
        $this->add(array(
            'name'       => 'txtDireccion',
            //'type' => 'Zend\Form\Element\Email',
            'attributes' => array('maxlength' => '120', 'size' => '32', 'type' => 'text', 'class'=>"txtDireccion"),
        ));


        //Ubigeo
        $config = Module::getCustomConfig();
        $mem_time_out = $config['cacheTimeExpire'];
        $city_choices = array(''=>'Elige una ciudad');
        $dist_choices = array(''=>'Elige un Distrito');

        if(!$memcache->get('mem_city')){ //La data no está en memcache, lo recuperamos de la bd y lo colocamos en memcache
            $cities = $this->_em->getRepository('Complements\Entity\Ubigeo')->getUbigeo();
            foreach($cities as $p) $city_choices[$p->getId()] = utf8_encode($p->getName());
            $memcache->add("mem_city", $city_choices, MEMCACHE_COMPRESSED, $mem_time_out);
            //echo 'La data aún no está en Memcache';
        }else{
            //echo 'La data ya está en Memcache';
            $city_choices = $memcache->get("mem_city");
        }

        # ciudad
        //$cities = $this->_em->getRepository('Complements\Entity\Ubigeo')->getUbigeo();
        //foreach($cities as $p) $city_choices[$p->getId()] = utf8_encode($p->getName());
        $this->add(array(
            'type' => 'Zend\Form\Element\Select',   
            'name' => 'city',
            'attributes' =>  array('id' => 'city', 'options' => $city_choices, 'class'=>"required"),
        ));

        # distrito
        $this->add(array(
            'type' => 'Zend\Form\Element\Select',   
            'name' => 'district',
            'attributes' =>  array('id' => 'district', 'options' => $dist_choices, 'class'=>"required"),
            
        ));        

        $this->add(array(
            'name'       => 'txtNomContacto',
            //'type' => 'Zend\Form\Element\Email',
            'attributes' => array('maxlength' => '80', 'size' => '32', 'type' => 'text', 'class'=>'txtNombre'),
        ));
        
         $this->add(array(
            'name' => 'txtMailContacto',
            'type' => 'Zend\Form\Element\Email',
            'attributes' => array('maxlength' => '100', 'size' => '32', 'type' => 'text', 'class'=>'txtEmail'),
            'options' => array('appendText' => '@'),
        ));

        $this->add(array(
            'name'       => 'txtTelefono',
            //'type' => 'Zend\Form\Element\Email',
            'attributes' => array('maxlength' => '4', 'size' => '4', 'type' => 'text', 'class'=>'width40', 'value'=>'+51'),
        ));

        $this->add(array(
            'name'       => 'txtTelefono2',
            //'type' => 'Zend\Form\Element\Email',
            'attributes' => array('maxlength' => '12', 'size' => '9', 'type' => 'text', 'class'=>'width200 required txtTelefono'),
        ));
        
        $this->add(array(
            'name'       => 'txtURL',
            //'type' => 'Zend\Form\Element\Email',
            'attributes' => array('maxlength' => '80', 'size' => '80', 'type' => 'text', 'placeholder'=>"www.mi-institucion.com"),
        ));
        
        $this->add(array(
            'name'       => 'txtComentarios',
            //'type'       => 'Zend\Form\Element\TextArea',
            'attributes' => array('maxlength' => '500', 'type' => 'textarea', 'size' => '500'),
        ));
        
        $this->add(array(
            'type' => 'Zend\Form\Element\Csrf',
            'name' => 'csrf'
        ));

       
        // Submit button
        $this->add(array(
            'name' => 'register_save',
            'type' => 'Zend\Form\Element\Submit',
            'attributes' => array('value' => 'Registrar Institución', 'class'=>'boton'),
            'options' => array(),
        ));
    }

}
