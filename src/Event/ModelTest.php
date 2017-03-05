<?php
/**
 *
 */

namespace Mvc5\Test\Event;

use Mvc5\Arg;
use Mvc5\Event;
use Mvc5\Resolver\Dispatch as ResolverDispatch;
use Mvc5\Test\Test\TestCase;

class ModelTest
    extends TestCase
{
    /**
     *
     */
    function test_event()
    {
        $event = new Event('foo');

        $this->assertEquals('foo', $event->event());
    }

    /**
     *
     */
    function test_event_class_name()
    {
        $event = new Event;

        $this->assertEquals(get_class($event), $event->event());
    }

    /**
     *
     */
    function test_event_const()
    {
        $event = new ResolverDispatch;

        $this->assertEquals(Arg::SERVICE_RESOLVER, $event->event());
    }

    /**
     *
     */
    function test_stop()
    {
        $event = new Event;

        $this->assertFalse($event->stopped());

        $event->stop();

        $this->assertTrue($event->stopped());
    }

    /**
     *
     */
    function test_stopped()
    {
        $event = new Event;

        $this->assertFalse($event->stopped());
    }
}
