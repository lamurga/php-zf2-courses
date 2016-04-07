<?php
namespace Institutions;

return array(

    // Controllers in this module
    'controllers' => array(
        'invokables' => array(
            'instituciones' => 'Institutions\Controller\InstitutionsController',
        ),        
    ),

    // Routes for this module
    'router' => array(
        'routes' => array(
            #Rutas de ejemplo si más adelante listamos por tipo de IE y paginado (lo mismo por universidad, instituto, etc)
            /*'institutions' => array(
                'type' => 'Literal',
                'options' => array(
                    'route'    => '/instituciones',
                    'defaults' => array(
                        'controller' => 'instituciones',
                        'action'     => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'institutions_page' => array(
                        'type' => 'segment',
                        'options' => array(
                            'route'    => '/page/[:page]',
                            'defaults' => array(
                                'controller' => 'instituciones',
                                'action'     => 'index',
                            ),
                        ),
                    ),
                    'show' => array(
                        'type' => 'segment',
                        'options' => array(
                            'route'    => '/[:slug]',
                            'defaults' => array(
                                'controller' => 'instituciones',
                                'action'     => 'institutionShow',
                            ),
                        ),
                    ),
                ),
            ),*/
            
            //Mientras lo hacemos solo para la ficha (directo)
            'universidad_show' => array(
                'type' => 'segment',
                'options' => array(
                    'route'    => '/universidad/[:slug]',
                    'defaults' => array(
                        'controller' => 'instituciones',
                        'action'     => 'universitiesShow',
                    ),
                ),
            ),
            'instituto_show' => array(
                'type' => 'segment',
                'options' => array(
                    'route'    => '/instituto/[:slug]',
                    'defaults' => array(
                        'controller' => 'instituciones',
                        'action'     => 'institutesShow',
                    ),
                ),
            ),
            'colegio_profesional_show' => array(
                'type' => 'segment',
                'options' => array(
                    'route'    => '/colegio-profesional/[:slug]',
                    'defaults' => array(
                        'controller' => 'instituciones',
                        'action'     => 'professionalcollegeShow',
                    ),
                ),
            ),
            'empresa_show' => array(
                'type' => 'segment',
                'options' => array(
                    'route'    => '/empresa/[:slug]',
                    'defaults' => array(
                        'controller' => 'instituciones',
                        'action'     => 'companyShow',
                    ),
                ),
            ),
            'escuela_de_postgrado_show' => array(
                'type' => 'segment',
                'options' => array(
                    'route'    => '/escuela-de-postgrado/[:slug]',
                    'defaults' => array(
                        'controller' => 'instituciones',
                        'action'     => 'graduateschoolShow',
                    ),
                ),
            ),
            'academia_show' => array(
                'type' => 'segment',
                'options' => array(
                    'route'    => '/academia/[:slug]',
                    'defaults' => array(
                        'controller' => 'instituciones',
                        'action'     => 'academyShow',
                    ),
                ),
            ),
            'escuela_de_idiomas_show' => array(
                'type' => 'segment',
                'options' => array(
                    'route'    => '/escuela-de-idiomas/[:slug]',
                    'defaults' => array(
                        'controller' => 'instituciones',
                        'action'     => 'languageschoolShow',
                    ),
                ),
            ),
            'otra_institucion_show' => array(
                'type' => 'segment',
                'options' => array(
                    'route'    => '/otra-institucion/[:slug]',
                    'defaults' => array(
                        'controller' => 'instituciones',
                        'action'     => 'otherinstitutionShow',
                    ),
                ),
            ),
        ),
    ),    

    // View setup for this module
    'view_manager' => array(
        'template_path_stack' => array(
            'institutions_view' => __DIR__ . '/../view',
        ),
    ),
    
);
