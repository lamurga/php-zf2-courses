<?php
return array(
    'modules' => array(        
        'Application',
        'DoctrineModule',
        'DoctrineORMModule',
        'ZendDeveloperTools',
        'ZfcBase',
        'ZfcUser',
        'Users',
        'Institutions',
        'Courses',
        'Complements'
    ),
    'module_listener_options' => array(
        'config_glob_paths'    => array(
            //'config/autoload/{,*.}{global,local,development}.php',
            'config/autoload/{,*.}{global,local,'.APPLICATION_ENV.'}.php',
        ),
        //'config_cache_enabled' => false,
        //'cache_dir' => 'data/cache',
        'module_paths' => array(
            './module',
            './vendor', // Configuración para usar el core de ZF2 centralizado
        ),
    ),
    'service_manager' => array(
        'use_defaults' => true,
        'factories' => array(
        ),
    ),
    
);


