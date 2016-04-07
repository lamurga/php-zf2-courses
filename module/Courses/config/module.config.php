<?php
return array(
    // Constrolers que se usaran en las urls
    'controllers' => array(
        'invokables' => array(
            'cursos_extra' => 'Courses\Controller\CoursesController',
        ),        
    ),

    //Configuracion de urls
    'router' => array(
        'routes' => array(
            'publish_course' => array(
                'type' => 'Literal',
                'options' => array(
                    'route'    => '/publicar-curso',
                    'defaults' => array(
                        'controller' => 'cursos_extra',
                        'action'     => 'publishCourse',
                    ),
                ),
            ),
            'new_courses' => array(
                'type' => 'segment',
                'options' => array(
                    'route'    => '/nuevos[/:page]',
                    'defaults' => array(
                        'controller' => 'cursos_extra',
                        'action'     => 'NewCourses',
                    ),
                ),
            ),
            'publish_course_two' => array(
                'type' => 'Literal',
                'options' => array(
                    'route'    => '/publicar-curso-validar',
                    'defaults' => array(
                        'controller' => 'cursos_extra',
                        'action'     => 'validatePublication',
                    ),
                ),
            ),
            'publish_course_three' => array(
                'type' => 'Segment',
                'options' => array(
                    'route'    => '/publicar-curso/[:ieSlug]',
                    'defaults' => array(
                        'controller' => 'cursos_extra',
                        'action'     => 'publisherRegister',
                    ),
                ),
            ),
            'publish_course_register_ie' => array(
                'type' => 'Literal',
                'options' => array(
                    'route'    => '/publicar-curso-registrar-ie',
                    'defaults' => array(
                        'controller' => 'cursos_extra',
                        'action'     => 'publisherRegisterIe',
                    ),
                ),
            ),
        ),
    ),
    
    // Configuracion de las vistas del modulo
    'view_manager' => array(
        'template_path_stack' => array('courses_view' => __DIR__ . '/../view',),
    ),
    
);

