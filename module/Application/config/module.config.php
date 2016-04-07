<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */
namespace Application;

return array(
    'controllers' => array(
        'invokables' => array(
            'aplicacion' => 'Application\Controller\IndexController',
            'cursos' => 'Courses\Controller\CoursesController',
        ),
    ),
    'router' => array(
        'routes' => array(
            'courses' => array(
                'type' => 'segment',
                'options' => array(
                    'route'    => '[/:typeSlug]',
                    'defaults' => array(
                        'controller' => 'cursos',
                        'action'     => 'coursesByType',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'courses_page' => array(
                        'type' => 'segment',
                        'options' => array(
                            'route'    => '/page/[:page]',
                            'defaults' => array(
                                'controller' => 'cursos',
                                'action'     => 'coursesByType',
                            ),
                        ),
                    ),
                    'show' => array(
                        'type' => 'segment',
                        'options' => array(
                            'route'    => '/[:courseSlug]',
                            'defaults' => array(
                                'controller' => 'cursos',
                                'action'     => 'coursesByTypeShow',
                            ),
                        ),
                    ),
                ),
            ),
            'auto_html' => array(
                'type' => 'Literal',
                'options' => array(
                    'route'    => '/generate-home-v120130917',
                    'defaults' => array(
                        'controller' => 'aplicacion',
                        'action'     => 'generatehome',
                    ),
                ),
            ),
            
            'home' => array(
                'type' => 'Literal',
                'options' => array(
                    'route'    => '/',
                    'defaults' => array(
                        'controller' => 'aplicacion',
                        'action'     => 'index',
                    ),
                ),
            ),
            
            'user_login' => array(
                'type' => 'Literal',
                'options' => array(
                    'route'    => '/user/login',
                    'defaults' => array(
                        'controller' => 'aplicacion',
                        'action'     => 'login',
                    ),
                ),
            ),
            
        ),
    ),
    'service_manager' => array(
        'factories' => array(
            'translator' => 'Zend\I18n\Translator\TranslatorServiceFactory',
        ),
    ),

    'translator' => array(
        'locale' => 'en_US',
        'translation_file_patterns' => array(
            array(
                'type'     => 'gettext',
                'base_dir' => __DIR__ . '/language',
                'pattern'  => '%s.mo',
            ),
        ),
    ),
    'view_manager' => array(        
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_map' => array(
            'layout/layout'           => __DIR__ . '/../view/layout/layout.phtml',
            'application/index/index' => __DIR__ . '/../view/application/index/index.phtml',
            'error/404'               => __DIR__ . '/../view/error/404.phtml',
            'error/index'             => __DIR__ . '/../view/error/index.phtml',
            'menu'                    => __DIR__ . '/../view/layout/categories-menu.phtml', 
        ),
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),
);
