<?php
define("TIME_EXPIRE_CACHE", time()+60*60*24*30);
return array(
    'php_settings'   => array(
        'display_startup_errors'        => true,
        'display_errors'                => true,
        'max_execution_time'            => 300,
        'date.timezone'                 => DATE_TIME_ZONE,
        'mbstring.internal_encoding'    => 'UTF-8',
    ),

    'view_manager' => array(
    	'display_exceptions'       		=> true,
        'display_not_found_reason'      => true,        
    ),

    'mail' => array(
        'transport' => array(
            'options' => array(
                "name" => 'gmail',
                "host" => "smtp.gmail.com",
                "port" => 587,
                "connection_class" => "plain",
                "connection_config" => array(
                    "username" => "test@company.com",
                    "password" => "passwordseguro",
                    "ssl" => "tls"
                )
            ),  
        ),
    ),

    'time_expire' => array(
        'cache' => array(
            'core' => TIME_EXPIRE_CACHE, //30 dias
            'list' => time()+60*60*24*1, // listados
            'daily' => time()+60*60*12*1, // homes, buscador
            'average' => time()+60*60*4*1, //nuevos cursos, destacados, proximos a iniciar
        ),
        'cookie' => array(
            'core' => time()+60*60*24*30, //30 dias
            'week' => time()+60*60*24*7,
        ),
    ),

    'cache' => array(
        'instance' => 'my_memcached_alias',
    ),

    'service_manager' => array(
        'factories' => array(
            //Configirando el sistema de cacheo
            'my_memcached_alias' => function() {
                $memcached = new \Memcache();
                $memcached->addServer('localhost', 11211);
                return $memcached;
            },
        ),
    ),
);