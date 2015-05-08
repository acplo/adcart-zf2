<?php
return [
    'controllers' => [
        'invokables' => [
            'Produto\Controller\Crud' => 'Produto\Controller\CrudController',
        ],
    ],
    'router' => [
        'routes' => [
            'produto' => [
                'type' => 'Literal',
                'options' => [
                    'route' => '/produto',
                    'defaults' => [
                        'controller' => 'Produto\Controller\Crud',
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
                                'controller' => 'Produto\Controller\Crud',
                                'action' => 'list',
                            ],
                        ],
                    ],
                    'add' => [
                        'type' => 'Literal',
                        'options' => [
                            'route' => '/add',
                            'defaults' => [
                                'controller' => 'Produto\Controller\Crud',
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
                                'controller' => 'Produto\Controller\Crud',
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
                                'controller' => 'Produto\Controller\Crud',
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
            'Produto' => __DIR__.'/../view',
        ],
    ],
    'doctrine' => [
        'driver' => [
            'Produto_driver' => [
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => [
                    __DIR__.'/../src/Produto/Entity',
                ],
            ],
            'orm_default' => [
                'drivers' => [
                    'Produto\Entity' => 'Produto_driver',
                ],
            ],
        ],
    ],
    'navigation' => [
        'default' => [
            'Crud' => [
                'pages' => [
                    'produto' => [
                        'label' => 'Produto',
                        'route' => 'produto/list',
                        'pages' => [
                            'list' => [
                                'label' => 'List',
                                'route' => 'produto/list',
                            ],
                            'add' => [
                                'label' => 'Add',
                                'route' => 'produto/add',
                            ],
                            'edit' => [
                                'label' => 'Edit',
                                'route' => 'produto/edit',
                            ],
                            'delete' => [
                                'label' => 'Delete',
                                'route' => 'produto/delete',
                            ],
                        ],
                    ],
                ],
            ],
        ],
    ]
];
