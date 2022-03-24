<?php

namespace Tests;

use Tests\TestCase;

abstract class ControllerTestCase extends TestCase
{
    protected function testAssertView($name, $view, $keys = [])
    {
        $this->assertEquals($name, $view->getName());
        foreach ($keys as $key) {
            $this->assertArrayHasKey($key, $view->getData());
        }
    }

    protected function testReceiveManyAction($repo, $actions = [])
    {
        foreach ($actions as $action) {
            $repo->shouldReceive($action)->andReturn(true);
        }
    }

    protected function testReceiveManyActionReturnValue($repo, $actions = [], $value = [])
    {
        for ($i = 0; $i < count($actions); $i++) {
            $repo->shouldReceive($actions[$i])->andReturn($value[$i]);
        }
    }

    protected function testReceiveManyRepo($repo = [], $actions = [])
    {
        for ($i = 0; $i < count($repo); $i++) {
            $repo[$i]->shouldReceive($actions[$i])->andReturn(true);
        }
    }
}
