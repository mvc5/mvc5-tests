<?php
/**
 *
 */

namespace Mvc5\Test\Resolver\Resolver\Gem;

use Mvc5\Plugin\Call;
use Mvc5\Plugin\Invoke;
use Mvc5\Plugin\Invokable;
use Mvc5\Test\Resolver\Resolver;
use Mvc5\Test\Test\TestCase;

class InvokableTest
    extends TestCase
{
    /**
     *
     */
    function test_gem_invokable_named()
    {
        $resolver = new Resolver;

        $invokable = new Invokable(
            new Call(new Invoke(function($foo, $bar, $baz) { return $foo . $bar . $baz; })), ['baz' => 's']
        );

        $callable = $resolver->gem($invokable);

        $this->assertEquals('foobars', $resolver->call($callable, ['bar' => 'bar', 'foo' => 'foo']));
    }

    /**
     *
     */
    function test_gem_invokable_not_named()
    {
        $resolver = new Resolver;

        $invokable = new Invokable(
            new Call(new Invoke(function($foo, $bar, $baz) { return $foo . $bar . $baz; })), ['s']
        );

        $callable = $resolver->gem($invokable);

        $this->assertEquals('foobars', $callable('foo', 'bar'));
        $this->assertEquals('foobars', $resolver->call($callable, ['foo', 'bar']));
    }

    /**
     *
     */
    function test_gem_invokable_merge()
    {
        $resolver = new Resolver;

        $invokable = new Invokable(
            new Call(new Invoke(function($foo, $bar, $baz) { return $foo . $bar . $baz; })), ['s']
        );

        $callable = $resolver->gem($invokable);

        $this->assertEquals('foobars', $callable('foo', 'bar'));
        $this->assertEquals('foobars', $resolver->call($callable, ['foo', 'bar']));
    }
}
