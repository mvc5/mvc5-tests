<?php
/**
 *
 */

namespace Mvc5\Test\Event;

use Mvc5\Event;
use Mvc5\Test\Test\TestCase;

final class EventTest
    extends TestCase
{
    /**
     *
     */
    function test_name()
    {
        $event = new Event('foo');

        $this->assertEquals('foo', $event->name());
    }

    /**
     *
     */
    function test_named_args()
    {
        $event = new Event;

        $this->assertEquals('bar', $event(fn($bar, $foo) => $foo, ['foo' => 'bar', 'bar' => 'baz']));
    }

    /**
     *
     */
    function test_numeric_args()
    {
        $event = new Event;

        $this->assertEquals('baz', $event(fn($bar, $foo) => $foo, ['bar', 'baz']));
    }

    /**
     *
     */
    function test_stopped()
    {
        $event = new Event;

        $event(fn(Event $event) => $event->stop());

        $this->assertTrue($event->stopped());
    }
}
