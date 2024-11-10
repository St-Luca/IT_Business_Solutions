<?php
namespace Tests;

use Psr\Log\LoggerInterface;
use Psr\Log\LoggerTrait;

class TestLogger implements LoggerInterface
{
    use LoggerTrait;

    public array $logs = [];

    public function log($level, $message, array $context = [])
    {
        $this->logs[] = compact('level', 'message', 'context');
    }

    public function getLogs(): array
    {
        return $this->logs;
    }

    public function clear(): void
    {
        $this->logs = [];
    }
}
