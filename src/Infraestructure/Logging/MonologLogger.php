<?php 
namespace App\Infraestructure\Logging;

use Monolog\Handler\StreamHandler;
use Monolog\Logger;

class MonologLogger implements Logging
{
    private readonly Logger $monolog;

    public function __construct()
    {
        $logDir = __DIR__ . '/../../../storage/logs';
        $logFile = __DIR__ . '/../../../storage/logs/log.log';

        if(!is_dir($logDir)) mkdir($logDir, 777, true);
        if(!file_exists($logFile)) touch($logFile);

        $this->monolog = new Logger($_ENV["APP_NAME"]);
        $this->monolog->pushHandler(new StreamHandler($logFile));
    }

    public function info(string $message, array $context = []): void
    {
        $this->monolog->info($message, $context);
    }

    public function warning(string $message, array $context = []): void
    {
        $this->monolog->warning($message, $context);
    }

    public function error(string $message, array $context = []): void
    {
        $this->monolog->error($message, $context);
    }
}