<?php
namespace RouterBenchmark;

use Athletic\AthleticEvent;
use Dash\Module;
use Zend\Http\Request as HttpRequest;
use Zend\ServiceManager\Config;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceManager;
use Zend\ServiceManager\ServiceManagerAwareInterface;

class DashEvent extends AthleticEvent
{
    protected $serviceManager;
    protected $reflectionClass;
    protected $reflectionProperty;

    public function classSetUp()
    {
        $module = new Module();
        $config = $module->getConfig();

        $serviceManager = new ServiceManager(new Config($config['service_manager']));
        $serviceManager->addInitializer(function ($instance) use ($serviceManager) {
            if ($instance instanceof ServiceManagerAwareInterface) {
                $instance->setServiceManager($serviceManager);
            }
        });
        $serviceManager->addInitializer(function ($instance) use ($serviceManager) {
            if ($instance instanceof ServiceLocatorAwareInterface) {
                $instance->setServiceLocator($serviceManager);
            }
        });
        $serviceManager->setService(
            'Config',
            [
                'dash_router' => [
                    'routes' => [
                        'home' => ['/', 'foo', 'bar'],
                        'user' => ['/user', 'foo', 'bar', 'children' => [
                            'create' => ['/create', 'foo', 'bar'],
                            'edit' => ['/edit/:id', 'foo', 'bar', 'constraints' => ['id' => '\d+']],
                            'delete' => ['/delete/:id', 'foo', 'bar', 'constraints' => ['id' => '\d+']],
                        ]],
                        'blog' => ['/blog', 'foo', 'bar', 'children' => [
                            'article' => ['/:slug', 'foo', 'bar'],
                            'create' => ['/create', 'foo', 'bar'],
                            'edit' => ['/edit/:id', 'foo', 'bar', 'constraints' => ['id' => '\d+']],
                            'delete' => ['/delete/:id', 'foo', 'bar', 'constraints' => ['id' => '\d+']],
                        ]],
                    ],
                ],
            ]
        );

        $this->serviceManager = $serviceManager;
    }

    /**
     * @iterations 1000
     */
    public function firstMatch()
    {
        $request = new HttpRequest();
        $request->setUri('http://example.com/blog/delete/1');

        $router = $this->serviceManager->get('Dash\Router\Http\Router');
        $router->match($request);
    }

    /**
     * @iterations 1000
     */
    public function lastMatch()
    {
        $request = new HttpRequest();
        $request->setUri('http://example.com/');

        $router = $this->serviceManager->get('Dash\Router\Http\Router');
        $router->match($request);
    }
}
