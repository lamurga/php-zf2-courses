<?php
namespace Complements\Form;

use Zend\Form\Form;
use Zend\Form\Element;
use Application\Module;


class AlertsForm extends Form
{
    private $_em;
    
    public function __construct($em, $memcache = null, $cookie = null)
    {
        $this->_em = $em;
        parent::__construct('frmAlerta');

        // Importante: Para mostrar los mensajes personalizados en la valicación de formularios (selects, emails, etc)
        $this->setUseInputFilterDefaults(false);

        // set attributes
        //$this->setAttribute('method', 'post');
        $this->setAttribute('class', 'form-full frmValidar');
        
        // add lastName
        $this->add(array(
            'name'       => 'txtTag1',
            'attributes' => array('maxlength' => '60', 'size' => '25', 'type' => 'text', 'class'=>"required txtTema", 'placeholder'=> 'Tema 1'),
            
        ));
        
        $this->add(array(
            'name'       => 'txtTag2',
            'attributes' => array('maxlength' => '60', 'size' => '25', 'type' => 'text', 'class'=>"txtTema", 'placeholder'=> 'Tema 2'),
            
        ));
        
        $this->add(array(
            'name'       => 'txtTag3',
            'attributes' => array('maxlength' => '60', 'size' => '25', 'type' => 'text', 'class'=>"txtTema", 'placeholder'=> 'Tema 3'),            
        ));

        $this->add(array(
            'name'       => 'txtName',
            'attributes' => array('maxlength' => '80', 'size' => '25', 'type' => 'text', 'class'=>"txtCadena"),            
        ));

        //checkbox de Ciudades
        //$config = Module::getCustomConfig();

        //$cookieTimeExpire = $this->getServiceLocator()->get('cookieTimeExpire');
        //var_dump($cookie);

        $module = new Module(); 
        $config = $module->getCustomConfig();
        $mem_time_out = $config['cacheTimeExpire'];
        $principal_cities = $config['principal_cities'];

        //var_dump($config['cookieTimeExpire']);

        $city_choices = array();
        $name_cache = 'mem_city_'.COUNTRY_ABBREV;
        if(!$memcache->get($name_cache)){ //La data no está en memcache, lo recuperamos de la bd y lo colocamos en memcache
            $cities = $this->_em->getRepository('Complements\Entity\Ubigeo')->getUbigeo();
            foreach($cities as $p) $city_choices[$p->getId()] = trim(utf8_encode($p->getName()));
            $memcache->add($name_cache, $city_choices, MEMCACHE_COMPRESSED, $mem_time_out);
            //echo 'La data aún no está en Memcache';
        }else{
            //echo 'La data ya está en Memcache';
            $city_choices = $memcache->get($name_cache);
            //$memcache->delete($name_cache);
        }
        $match_cities = array_diff($city_choices, $principal_cities);
        
        $this->add(array(
            'type' => 'Zend\Form\Element\MultiCheckbox',
            'name' => 'ciudades',
            'attributes' => array('width' => "150", 'class' => "required"),
            'options' => array(
                'value_options' => $match_cities
            )
        ));
        
        // Tipo de resultado
        $results_type = array(1=>'Postgrado', 2=>'Carreras Pregrado', 3=>'Cursos Cortos', 4=>'Cursos In-House');
        
        $this->add(array(
            'type' => 'Zend\Form\Element\MultiCheckbox',
            'name' => 'tipo_curso',
            'attributes' => array('width' => "150", 'class' => 'required'),
            'options' => array(
                'value_options' => $results_type
            )
        ));

        $this->add(array(
            'type' => 'Zend\Form\Element\Select',   
            'name' => 'frecuencia',
            'attributes' =>  array('options' => array('1'=>'Una vez al día', '2'=>'Una vez a la semana'), 'class'=>'opt_selected valid'),
        ));

        $this->add(array(
            'name' => 'txtEmail',
            //'type' => 'Zend\Form\Element\Email',
            'attributes' => array('maxlength' => '100', 'type' => 'text', 'size' => '32', 'class'=>"txtEmail"),
            'options' => array('appendText' => '@'),
        ));

        $this->add(array(
            'name'       => 'txtDescripcion',
            'attributes' => array('maxlength' => '500', 'type' => 'textarea', 'size' => '500'),
        ));
        

        // Submit button
        $this->add(array(
            'name' => 'bt-crear-alerta',
            'type' => 'Zend\Form\Element\Submit',
            'attributes' => array('value' => 'Crear Alerta', 'class'=>'boton'),
            'options' => array(),
        ));
    }

}
