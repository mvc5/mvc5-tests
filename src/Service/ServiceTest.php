<?php
/**
 *
 */

namespace Mvc5\Test\Service;

use Mvc5\App;
use Mvc5\Test\Test\TestCase;

class ServiceTest
    extends TestCase
{
    /**
     *
     */
    function test_param()
    {
        $params = ['foo' => ['bar' => 'baz'],  'bar' => 'baz'];

        $app = new App($params);

        $this->assertEquals('baz', $app->param('foo.bar'));
        $this->assertEquals(['bar' => 'baz'], $app->param('foo'));
        $this->assertEquals($params + ['foobar' => null], $app->param(['foo', 'bar', 'foobar']));
    }
}
