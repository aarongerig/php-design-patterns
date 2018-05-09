<?php

namespace DependenciesAndDI\Loggr;

class EchoOut
{
    public function log($date, $body): void
    {
        echo "{$date} - {$body}\n";
    }
}