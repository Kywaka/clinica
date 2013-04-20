<?php

return array(
    # definir controllers
    'controllers' => array(
        'invokables' => array(
            'HomeController' => 'Clinica\Controller\HomeController',
            'HelloController' => 'Clinica\Controller\HelloController'
        ),
    ),
    # definir rotas
    'router' => array(
        'routes' => array(
            'home' => array(
                'type' => 'Literal',
                'options' => array(
                    'route' => '/',
                    'defaults' => array(
                        'controller' => 'HomeController',
                        'action' => 'index',
                    ),
                ),
            ),
            'inicio' => array(
                'type' => 'Literal',
                'options' => array(
                    'route' => '/home/inicio',
                    'defaults' => array(
                        'controller' => 'HomeController',
                        'action' => 'inicio',
                    ),
                ),
            ),
            
            'hello' => array(
                'type' => 'Literal',
                'options' => array(
                    'route' => '/hello/world',
                    'defaults' => array(
                        'controller' => 'HelloController',
                        'action' => 'world',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'default' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route' => '/[:controller[/:action]]',
                            'constraints' => array(
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                            ),
                            'defaults' => array(
                            ),
                        ),
                    ),
                ),
            // ... other configuration ...
            ),
        ),
    ),
    # definir layouts, erros, exceptions, doctype base
    'view_manager' => array(
        'display_not_found_reason' => true,
        'display_exceptions' => true,
        'doctype' => 'HTML5',
        'not_found_template' => 'error/404',
        'exception_template' => 'error/index',
        'template_map' => array(
            'layout/layout' => __DIR__ . '/../view/layout/layout.phtml',
            'clinica/home/index' => __DIR__ . '/../view/clinica/home/index.phtml',
            'error/404' => __DIR__ . '/../view/error/404.phtml',
            'error/index' => __DIR__ . '/../view/error/index.phtml',
        ),
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),
);
