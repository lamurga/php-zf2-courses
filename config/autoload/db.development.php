<?php

return array(
    'doctrine' => array(
        'connection' => array(
            'orm_default' => array(
                'driverClass' => 'Doctrine\DBAL\Driver\PDOMySql\Driver',
                'params' => array(
                    'host'     => $_SERVER['RDS_HOSTNAME_USERS'],
                    'port'     => $_SERVER['RDS_PORT'],
                    'user'     => $_SERVER['RDS_USERNAME_USERS'],
                    'password' => $_SERVER['RDS_PASSWORD_USERS'],
                    'dbname'   => $_SERVER['RDS_DB_NAME_USERS'],
                )
            ),
           // BD alternativas, que se ejecutarán al ser invocados 
            'orm_alternative_com'=> array(
                'driverClass' => 'Doctrine\DBAL\Driver\PDOMySql\Driver',
                'params' => array(
                    'host'     => $_SERVER['RDS_HOSTNAME'],
                    'port'     => $_SERVER['RDS_PORT'],
                    'user'     => $_SERVER['RDS_USERNAME'],
                    'password' => $_SERVER['RDS_PASSWORD'],
                    'dbname'   => $_SERVER['RDS_DB_NAME'],
                )
            ),
            // BD alternativas: CCD
            'orm_alternative_ccd'=> array(
                'driverClass' => 'Doctrine\DBAL\Driver\PDOMySql\Driver',
                'params' => array(
                    'host'     => 'localhost',
                    'port'     => '3306',
                    'user'     => 'root',
                    'password' => '',
                    'dbname'   => 'dbcourses',
                )
            ),
        ),
        // Definir la configuracion de las entidades
        'entitymanager' => array(
            'orm_default' => array(
                'connection'    => 'orm_default',
                'configuration' => 'orm_default'
            ),
            'orm_alternative_com' => array(
                'connection'    => 'orm_alternative_com',
                'configuration' => 'orm_default'
            ),
            'orm_alternative_ccd' => array(
                'connection'    => 'orm_alternative_ccd',
                'configuration' => 'orm_default'
            ),
        ),
    ),
    
);