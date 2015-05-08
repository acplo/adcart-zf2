<?php
return [
    'controllers' => [
        'invokables' => [
            'Cart\Controller\Crud' => 'Cart\Controller\CrudController',
        ],
    ],
    'router' => [
        'routes' => [
            'cart' => [
                'type' => 'Literal',
                'options' => [
                    'route' => '/cart',
                    'defaults' => [
                        'controller' => 'Cart\Controller\Crud',
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
                                'controller' => 'Cart\Controller\Crud',
                                'action' => 'list',
                            ],
                        ],
                    ],
                    'destroy' => [
                        'type' => 'Literal',
                        'options' => [
                            'route' => '/destroy',
                            'defaults' => [
                                'controller' => 'Cart\Controller\Crud',
                                'action' => 'destroy',
                            ],
                        ],
                    ],
                    'add' => [
                        'type' => 'Literal',
                        'options' => [
                            'route' => '/add',
                            'defaults' => [
                                'controller' => 'Cart\Controller\Crud',
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
                                'controller' => 'Cart\Controller\Crud',
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
                                'controller' => 'Cart\Controller\Crud',
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
            'Cart' => __DIR__.'/../view',
        ],
    ],
    'doctrine' => [
        'driver' => [
            'Cart_driver' => [
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => [
                    __DIR__.'/../src/Cart/Entity',
                ],
            ],
            'orm_default' => [
                'drivers' => [
                    'Cart\Entity' => 'Cart_driver',
                ],
            ],
        ],
    ],
    'navigation' => [
        'default' => [
            'Crud' => [
                'pages' => [
                    'cart' => [
                        'label' => 'Cart',
                        'route' => 'cart/list',
                        'pages' => [
                            'list' => [
                                'label' => 'List',
                                'route' => 'cart/list',
                            ],
                            'add' => [
                                'label' => 'Add',
                                'route' => 'cart/add',
                            ],
                            'destroy'=> [
                                'label' => 'Destroy',
                                'route' => 'cart/destroy',
                            ],
                            'edit' => [
                                'label' => 'Edit',
                                'route' => 'cart/edit',
                            ],
                            'delete' => [
                                'label' => 'Delete',
                                'route' => 'cart/delete',
                            ],
                        ],
                    ],
                ],
            ],
        ],
    ]
];
