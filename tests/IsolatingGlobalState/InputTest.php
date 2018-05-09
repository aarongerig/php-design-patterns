<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use IsolatingGlobalState\Input;

final class InputTest extends TestCase
{
    public function testCanLoadFromGlobals(): void
    {
        $_GET['foo'] = 'Hello';

        $input = Input::createFromGlobals();

        $this->assertEquals($_GET['foo'], $input->get('foo'));
        $this->assertNull($input->get('bar'));
    }

    public function testCanReplaceInputValues(): void
    {
        $newInputs = [
            'get' => ['foo' => 'Hello'],
            'post' => ['bar' => 'World']
        ];

        $input = new Input();

        $input->replace($newInputs);

        $this->assertEquals($newInputs['get']['foo'], $input->get('foo'));
        $this->assertEquals($newInputs['post']['bar'], $input->post('bar'));
    }
}