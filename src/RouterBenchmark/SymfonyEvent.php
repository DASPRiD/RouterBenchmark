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
    protected $assemblyRouter;

    public function classSetUp()
    {
        // For assembling, we keep the same router around.
        $this->assemblyRouter = $this->configureRouter();
    }

    /**
     * @iterations 1000
     */
    public function firstMatch()
    {
        $request = HttpRequest::create('http://example.com/blog/delete/1');

        $router = $this->configureRouter();
        $router->matchRequest($request);
    }

    /**
     * @iterations 1000
     */
    public function lastMatch()
    {
        $request = HttpRequest::create('http://example.com/');

        $router = $this->configureRouter();
        $router->matchRequest($request);
    }

    /**
     * @iterations 1000
     */
    public function assemble()
    {
        $this->assemblyRouter->generate('blog/delete', ['id' => 1]);
    }

    /**
     * @return Router
     */
    private function configureRouter()
    {
        $router = new Router(
            new ClosureLoader(),
            function () {
                $collection = new RouteCollection();
                $collection->add('home', new Route('/', ['controller' => 'bar', 'action' => 'foo']));
                $collection->add('user', new Route('/user', ['controller' => 'bar', 'action' => 'foo']));
                $collection->add('user/create', new Route('/user/create', ['controller' => 'bar', 'action' => 'foo']));
                $collection->add('user/edit', new Route('/user/edit/{id}', ['controller' => 'bar', 'action' => 'foo', 'requirements' => ['id' => '\d+']]));
                $collection->add('user/delete', new Route('/user/delete/{id}', ['controller' => 'bar', 'action' => 'foo', 'requirements' => ['id' => '\d+']]));
                $collection->add('blog', new Route('/user', ['controller' => 'bar', 'action' => 'foo']));
                $collection->add('blog/article', new Route('/blog/{slug}', ['controller' => 'bar', 'action' => 'foo']));
                $collection->add('blog/create', new Route('/blog/create', ['controller' => 'bar', 'action' => 'foo']));
                $collection->add('blog/edit', new Route('/blog/edit/{id}', ['controller' => 'bar', 'action' => 'foo', 'requirements' => ['id' => '\d+']]));
                $collection->add('blog/delete', new Route('/blog/delete/{id}', ['controller' => 'bar', 'action' => 'foo', 'requirements' => ['id' => '\d+']]));

                return $collection;
            }
        );
        return $router;
    }
}