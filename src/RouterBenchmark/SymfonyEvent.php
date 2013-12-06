<?php
namespace RouterBenchmark;

use Athletic\AthleticEvent;
use Symfony\Component\HttpFoundation\Request as HttpRequest;
use Symfony\Component\Routing\Loader\ClosureLoader;
use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\Router;

class SymfonyEvent extends AthleticEvent
{
    /**
     * @iterations 1000
     */
    public function firstMatch()
    {
        $request = HttpRequest::create('http://example.com/blog/delete/1');

        $router = new Router(
            new ClosureLoader(),
            function () {
                $collection = new RouteCollection();
                $collection->add('home', new Route('/', array('controller' => 'bar', 'action' => 'foo')));
                $collection->add('user', new Route('/user', array('controller' => 'bar', 'action' => 'foo')));
                $collection->add('user/create', new Route('/user/create', array('controller' => 'bar', 'action' => 'foo')));
                $collection->add('user/edit', new Route('/user/edit/{id}', array('controller' => 'bar', 'action' => 'foo', 'requirements' => ['id' => '\d+'])));
                $collection->add('user/delete', new Route('/user/delete/{id}', array('controller' => 'bar', 'action' => 'foo', 'requirements' => ['id' => '\d+'])));
                $collection->add('blog', new Route('/user', array('controller' => 'bar', 'action' => 'foo')));
                $collection->add('blog/article', new Route('/blog/{slug}', array('controller' => 'bar', 'action' => 'foo')));
                $collection->add('blog/create', new Route('/blog/create', array('controller' => 'bar', 'action' => 'foo')));
                $collection->add('blog/edit', new Route('/blog/edit/{id}', array('controller' => 'bar', 'action' => 'foo', 'requirements' => ['id' => '\d+'])));
                $collection->add('blog/delete', new Route('/blog/delete/{id}', array('controller' => 'bar', 'action' => 'foo', 'requirements' => ['id' => '\d+'])));

                return $collection;
            }
        );
        $router->matchRequest($request);
    }

    /**
     * @iterations 1000
     */
    public function lastMatch()
    {
        $request = HttpRequest::create('http://example.com/');

        $router = new Router(
            new ClosureLoader(),
            function () {
                $collection = new RouteCollection();
                $collection->add('home', new Route('/', array('controller' => 'bar', 'action' => 'foo')));
                $collection->add('user', new Route('/user', array('controller' => 'bar', 'action' => 'foo')));
                $collection->add('user/create', new Route('/user/create', array('controller' => 'bar', 'action' => 'foo')));
                $collection->add('user/edit', new Route('/user/edit/{id}', array('controller' => 'bar', 'action' => 'foo', 'requirements' => ['id' => '\d+'])));
                $collection->add('user/delete', new Route('/user/delete/{id}', array('controller' => 'bar', 'action' => 'foo', 'requirements' => ['id' => '\d+'])));
                $collection->add('blog', new Route('/user', array('controller' => 'bar', 'action' => 'foo')));
                $collection->add('blog/article', new Route('/blog/{slug}', array('controller' => 'bar', 'action' => 'foo')));
                $collection->add('blog/create', new Route('/blog/create', array('controller' => 'bar', 'action' => 'foo')));
                $collection->add('blog/edit', new Route('/blog/edit/{id}', array('controller' => 'bar', 'action' => 'foo', 'requirements' => ['id' => '\d+'])));
                $collection->add('blog/delete', new Route('/blog/delete/{id}', array('controller' => 'bar', 'action' => 'foo', 'requirements' => ['id' => '\d+'])));

                return $collection;
            }
        );
        $router->matchRequest($request);
    }
}