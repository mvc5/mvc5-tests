<?php
/**
 *
 */

namespace Mvc5\Test\Route\Error;

use Mvc5\Arg;
use Mvc5\Route\Error\Model;
use Mvc5\Test\Test\TestCase;

class ModelTest
    extends TestCase
{
    /**
     *
     */
    public function test_code()
    {
        $model = new Model(null, [Arg::ERROR => [Arg::CODE => 'foo']]);

        $this->assertEquals('foo', $model->code());
    }

    /**
     *
     */
    public function test_errors()
    {
        $model = new Model(null, [Arg::ERROR => [Arg::ERRORS => []]]);

        $this->assertEquals([], $model->errors());
    }

    /**
     *
     */
    public function test_message()
    {
        $model = new Model(null, [Arg::ERROR => [Arg::MESSAGE => 'foo']]);

        $this->assertEquals('foo', $model->message());
    }
}
