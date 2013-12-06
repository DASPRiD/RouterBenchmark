<?php
namespace RouterBenchmark;

use Athletic\AthleticEvent;
use Zend\Http\Request as HttpRequest;
use Zend\Mvc\Router\Http\TreeRouteStack;

class Zf2Event extends AthleticEvent
{
    protected static $config = [
        'routes' => [
            'home' => [
                'type' => 'literal',
                'options' => [
                    'route' => '/',
                    'defaults' => [
                        'controller' => 'bar',
                        'action' => 'foo',
                    ],
                ],
            ],
            'user' => [
                'type' => 'literal',
                'options' => [
                    'route' => '/user',
                    'defaults' => [
                        'controller' => 'bar',
                        'action' => 'foo',
                    ],
                ],
                'may_terminate' => true,
                'child_routes' => [
                    'create' => [
                        'type' => 'literal',
                        'options' => [
                            'route' => '/create',
                            'defaults' => [
                                'controller' => 'bar',
                                'action' => 'foo',
                            ],
                        ],
                    ],
                    'edit' => [
                        'type' => 'segment',
                        'options' => [
                            'route' => '/edit/:id',
                            'defaults' => [
                                'controller' => 'bar',
                                'action' => 'foo',
                            ],
                            'constraints' => [
                                'id' => '\d+'
                            ],
                        ],
                    ],
                    'delete' => [
                        'type' => 'segment',
                        'options' => [
                            'route' => '/delete/:id',
                            'defaults' => [
                                'controller' => 'bar',
                                'action' => 'foo',
                            ],
                            'constraints' => [
                                'id' => '\d+'
                            ],
                        ],
                    ],
                ],
            ],
            'blog' => [
                'type' => 'literal',
                'options' => [
                    'route' => '/blog',
                    'defaults' => [
                        'controller' => 'bar',
                        'action' => 'foo',
                    ],
                ],
                'may_terminate' => true,
                'child_routes' => [
                    'article' => [
                        'type' => 'segment',
                        'options' => [
                            'route' => '/:slug',
                            'defaults' => [
                                'controller' => 'bar',
                                'action' => 'foo',
                            ],
                        ],
                    ],
                    'create' => [
                        'type' => 'literal',
                        'options' => [
                            'route' => '/create',
                            'defaults' => [
                                'controller' => 'bar',
                                'action' => 'foo',
                            ],
                        ],
                    ],
                    'edit' => [
                        'type' => 'segment',
                        'options' => [
                            'route' => '/edit/:id',
                            'defaults' => [
                                'controller' => 'bar',
                                'action' => 'foo',
                            ],
                            'constraints' => [
                                'id' => '\d+'
                            ],
                        ],
                    ],
                    'delete' => [
                        'type' => 'segment',
                        'options' => [
                            'route' => '/delete/:id',
                            'defaults' => [
                                'controller' => 'bar',
                                'action' => 'foo',
                            ],
                            'constraints' => [
                                'id' => '\d+'
                            ],
                        ],
                    ],
                ],
            ],
        ],
    ];

    protected $assemblyRouter;

    public function classSetUp()
    {
        // For assembling, we keep the same router around.
        $this->assemblyRouter = TreeRouteStack::factory(self::$config);
    }

    /**
     * @iterations 1000
     */
    public function firstMatch()
    {
        $request = new HttpRequest();
        $request->setUri('http://example.com/blog/delete/1');

        $router = TreeRouteStack::factory(self::$config);
        $router->match($request);
    }

    /**
     * @iterations 1000
     */
    public function lastMatch()
    {
        $request = new HttpRequest();
        $request->setUri('http://example.com/');

        $router = TreeRouteStack::factory(self::$config);
        $router->match($request);
    }

    /**
     * @iterations 1000
     */
    public function assemble()
    {
        $this->assemblyRouter->assemble(['id' => 1], ['name' => 'blog/delete']);
    }
}