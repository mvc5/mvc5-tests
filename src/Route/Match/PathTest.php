<?php
/**
 *
 */

namespace Mvc5\Test\Route\Match;

use Mvc5\Arg;
use Mvc5\Request\Config as Request;
use Mvc5\Route\Config as Route;
use Mvc5\Route\Match\Path;
use Mvc5\Test\Test\TestCase;

class PathTest
    extends TestCase
{
    /**
     * @return \Closure
     */
    protected function next()
    {
        return function($route, $request) {
            return $request;
        };
    }

    /**
     *
     */
    function test_empty_route()
    {
        $route   = new Route;
        $path    = new Path;
        $request = new Request([Arg::URI => [Arg::PATH => 'foo']]);

        $this->assertNull($path($route, $request, $this->next()));
    }

    /**
     *
     */
    function test_matched()
    {
        $route   = new Route([Arg::REGEX => 'foo']);
        $path    = new Path;
        $request = new Request([Arg::URI => [Arg::PATH => 'foo']]);

        $this->assertEquals($request, $path($route, $request, $this->next()));
    }

    /**
     *
     */
    function test_match_named_params()
    {
        $config = [Arg::REGEX => '/(?P<controller>[a-zA-Z0-9]+)(?:/(?P<action>[a-zA-Z0-9]+$))?'];

        $route   = new Route($config);
        $path    = new Path;
        $request = new Request([Arg::URI => [Arg::PATH => '/home/foo']]);

        $request = $path($route, $request, $this->next());

        $this->assertEquals(['controller' => 'home', 'action' => 'foo'], $request[Arg::PARAMS]);
    }

    /**
     *
     */
    function test_not_matched()
    {
        $route   = new Route([Arg::REGEX => 'bar']);
        $path    = new Path;
        $request = new Request([Arg::URI => [Arg::PATH => 'foo']]);

        $this->assertNull($path($route, $request, $this->next()));
    }

    /**
     *
     */
    function test_partial_match_with_child_routes()
    {
        $route   = new Route([Arg::REGEX => 'foo', Arg::CHILDREN => ['bar' => []]]);
        $path    = new Path;

        $request = new Request([Arg::URI => [Arg::PATH => 'foobar']]);

        $this->assertNull($request[Arg::ROUTE]);
        $this->assertNull($request[Arg::MATCHED]);
        $this->assertEquals($request, $path($route, $request, $this->next()));
        $this->assertEquals(3, $request[Arg::MATCHED]);
        $this->assertNull($request[Arg::ROUTE]);
    }

    /**
     *
     */
    function test_partial_match_without_child_routes()
    {
        $route   = new Route([Arg::REGEX => 'foo']);
        $path    = new Path;
        $request = new Request([Arg::URI => [Arg::PATH => 'foobar']]);

        $this->assertNull($path($route, $request, $this->next()));
    }
}
