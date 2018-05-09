<?php
declare(strict_types=1);

namespace IsolatingGlobalState;

final class Input
{
    private $inputs = [
        'get' => [],
        'post' => []
    ];

    public static function createFromGlobals(): Input
    {
        return new static(['get' => $_GET, 'post' => $_POST]);
    }

    public function __construct(array $inputs = [])
    {
        $this->replace($inputs);
    }

    public function replace(array $inputs = []): void
    {
        foreach ($this->inputs as $key => $input) {
            if (isset($inputs[$key])) {
                $this->inputs[$key] = $inputs[$key];
            }
        }
    }

    public function get($key)
    {
        return $this->fetch('get', $key);
    }

    public function post($key)
    {
        return $this->fetch('post', $key);
    }

    private function fetch($input, $key)
    {
        $result = null;

        if (isset($this->inputs[$input][$key])) {
            $result = $this->inputs[$input][$key];
        }

        return $result;
    }
}