<?php
return array(
	'controllers' => array(
        'invokables' => array(
            'complements' => 'Complements\Controller\ComplementsController',
        ),
    ),
    'router' => array(
        'routes' => array(
            'ubigeo_filter' => array(
                'type' => 'literal',
                'options' => array(
                    'route'    => '/ajax/ubigeo-filter',
                    'defaults' => array(
                        'controller' => 'complements',
                        'action'     => 'ubigeoFilter',
                    ),
                ),
            ),
            'load_alert' => array(
                'type' => 'literal',
                'options' => array(
                    'route'    => '/ajax/alert',
                    'defaults' => array(
                        'controller' => 'complements',
                        'action'     => 'loadAlert',
                    ),
                ),
            ),
            'subscribe_ccd' => array(
                'type' => 'literal',
                'options' => array(
                    'route'    => '/ajax/subscribe-ccd',
                    'defaults' => array(
                        'controller' => 'complements',
                        'action'     => 'subscribeCcd',
                    ),
                ),
            ),
            'search' => array(
                'type' => 'literal',
                'options' => array(
                    'route'    => '/buscador',
                    'defaults' => array(
                        'controller' => 'complements',
                        'action'     => 'search',
                    ),
                ),
            ),
            'search_ie' => array(
                'type' => 'segment',
                'options' => array(
                    'route'    => '/i/[:typeSlug]/[:words][/:page]',
                    'defaults' => array(
                        'controller' => 'complements',
                        'action'     => 'ieSearch',
                    ),
                ),
            ),
            'search_course' => array(
                'type' => 'segment',
                'options' => array(
                    'route'    => '/c/[:typeSlug]/[:words][/:page]',
                    'defaults' => array(
                        'controller' => 'complements',
                        'action'     => 'courseSearch',
                    ),
                ),
            ),

            // ESTATICAS
            'contact' => array(
                'type' => 'literal',
                'options' => array(
                    'route'    => '/contactenos',
                    'defaults' => array(
                        'controller' => 'complements',
                        'action'     => 'contact',
                    ),
                ),
            ),
            'recommend' => array(
                'type' => 'literal',
                'options' => array(
                    'route'    => '/recomiendanos',
                    'defaults' => array(
                        'controller' => 'complements',
                        'action'     => 'recommend',
                    ),
                ),
            ),
            'alerts' => array(
                'type' => 'literal',
                'options' => array(
                    'route'    => '/crear-alertas',
                    'defaults' => array(
                        'controller' => 'complements',
                        'action'     => 'createAlerts',
                    ),
                ),
            ),
            'my_alerts' => array(
                'type' => 'literal',
                'options' => array(
                    'route'    => '/alertas',
                    'defaults' => array(
                        'controller' => 'complements',
                        'action'     => 'myAlerts',
                    ),
                ),
            ),
            'alerts_edit' => array(
                'type' => 'segment',
                'options' => array(
                    'route'    => '/alertas/[:id]',
                    'defaults' => array(
                        'controller' => 'complements',
                        'action'     => 'editAlerts',
                    ),
                ),
            ),
        ),
    ),
    // Configuracion de las vistas del modulo
    'view_manager' => array(
        'template_path_stack' => array('cursos_view' => __DIR__ . '/../view'),
    ),
    // Set Gedmo tree subscriber
    'orm_evm' => array(
        'parameters' => array(
            'opts' => array(
                'tags' => array('Gedmo\Tree\TreeListener')
            )
        )
    ),

    'eventmanager'=>array(
        'orm_default'=>array(
            'subscribers' =>array('Gedmo\Sluggable\SluggableListener'),
        ),
    ),
);

