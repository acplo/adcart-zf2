<?php
return [
    'controllers' => [
        'invokables' => [
            'Sobre\Controller\Crud' => 'Sobre\Controller\CrudController',
            'Sobre\Controller\Sobre' => 'Sobre\Controller\SobreController',
        ],
    ],
    'router' => [
        'routes' => [
            'sobre' => [
                'type' => 'Literal',
                'options' => [
                    'route' => '/sobre',
                    'defaults' => [
                        'controller' => 'Sobre\Controller\Sobre',
                        'action' => 'list',
                    ],
                ],
                'may_terminate' => true,
                'child_routes' => [
                    'list' => [
                        'type' => 'Literal',
                        'options' => [
                            'route' => '/list',
                            'defaults' => [
                                'controller' => 'Sobre\Controller\Crud',
                                'action' => 'list',
                            ],
                        ],
                    ],
                    'add' => [
                        'type' => 'Literal',
                        'options' => [
                            'route' => '/add',
                            'defaults' => [
                                'controller' => 'Sobre\Controller\Sobre',
                                'action' => 'add',
                            ],
                        ],
                    ],
                    'edit' => [
                        'type' => 'Segment',
                        'options' => [
                            'route' => '/edit[/:id]',
                            'constraints' => [
                                'id' => '[0-9]+',
                            ],
                            'defaults' => [
                                'controller' => 'Sobre\Controller\Sobre',
                                'action' => 'edit',
                                'id' => 0,
                            ],
                        ],
                    ],
                    'delete' => [
                        'type' => 'Segment',
                        'options' => [
                            'route' => '/delete[/:id]',
                            'constraints' => [
                                'id' => '[0-9]+',
                            ],
                            'defaults' => [
                                'controller' => 'Sobre\Controller\Sobre',
                                'action' => 'delete',
                                'id' => 0,
                            ],
                        ],
                    ],
                ],
            ],
        ],
    ],
    'view_manager' => [
        'template_path_stack' => [
            'Sobre' => __DIR__.'/../view',
        ],
    ],
    'doctrine' => [
        'driver' => [
            'Sobre_driver' => [
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => [
                    __DIR__.'/../src/Sobre/Entity',
                ],
            ],
            'orm_default' => [
                'drivers' => [
                    'Sobre\Entity' => 'Sobre_driver',
                ],
            ],
        ],
    ],
    'navigation' => [
        'default' => [
            'Crud' => [
                'pages' => [
                    'sobre' => [
                        'label' => 'Sobre',
                        'route' => 'sobre/list',
                        'pages' => [
                            'list' => [
                                'label' => 'List',
                                'route' => 'sobre/list',
                            ],
                            'add' => [
                                'label' => 'Add',
                                'route' => 'sobre/add',
                            ],
                            'edit' => [
                                'label' => 'Edit',
                                'route' => 'sobre/edit',
                            ],
                            'delete' => [
                                'label' => 'Delete',
                                'route' => 'sobre/delete',
                            ],
                        ],
                    ],
                ],
            ],
        ],
    ]
];
