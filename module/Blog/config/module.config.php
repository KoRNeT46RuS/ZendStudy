<?php

return array(
    'router' => array(
        'routes' => array(
            'blog' => array(//имя папки во вьюшках
                'type' => 'Segment',
                'options' => array(
                    'route'    => '/blog[/:action][/:id]',//Главная страница модуля и какие страницы возможны
                    'constraints' => array(//ограничения
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'Blog\Controller\Blog',//контроллер
                        'action'     => 'index',//метод класса контроллера (пример indexAction{})
                    ),
                ),
                'may_terminate' => true,
            ),
            // The following is a route to simplify getting started creating
            // new controllers and actions without needing to create a new
            // module. Simply drop new controllers in, and you can access them
            // using the path /application/:controller/:action
//            'application' => array(
//                'type'    => 'Literal',
//                'options' => array(
//                    'route'    => '/application',
//                    'defaults' => array(
//                        '__NAMESPACE__' => 'Application\Controller',
//                        'controller'    => 'Index',
//                        'action'        => 'index',
//                    ),
//                ),
//                'may_terminate' => true,
//                'child_routes' => array(
//                    'default' => array(
//                        'type'    => 'Segment',
//                        'options' => array(
//                            'route'    => '/[:controller[/:action]]',
//                            'constraints' => array(
//                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
//                                'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
//                            ),
//                            'defaults' => array(
//                            ),
//                        ),
//                    ),
//                ),z
//            ),
        ),
    ),
    'controllers' => array(
        'invokables' => array(
            'Blog\Controller\Blog' => 'Blog\Controller\BlogController'
        ),
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),
);
