<?php

class InvalidLoggerTypeException extends Exception {}

interface Logger {
    public function log(string $message): void;
}

class FileLogger implements Logger {
    private string $filename;

    public function __construct(string $filename)
    {
        $this->filename = $filename;
    }

    public function log(string $message): void {
        file_put_contents($this->filename, $message . PHP_EOL, FILE_APPEND);
        echo "Log gravado no arquivo {$this->filename}\n";
    }
}

class ConsoleLogger implements Logger {
    public function log(string $message): void {
        echo "Console log: $message\n";
    }
}

abstract class LoggerFactory {
    abstract protected function createLogger(): Logger;

    public function logMessage(string $message) {
        $logger = $this->createLogger();
        $logger->log($message);
    }
}

class FileLoggerFactory extends LoggerFactory {
    protected function createLogger(): Logger
    {
        return new FileLogger("app.log");
    }
}

class ConsoleLoggerFactory extends LoggerFactory {
    protected function createLogger(): Logger
    {
        return new ConsoleLogger;
    }
}

// Simulando o parâmetro em uma arquivo de variável de ambiente, definindo onde devem ser salvos os logs (em arquivo ou apenas exibidos no console).
// Comente e descomente as declarações de $env e execute novamente o código, para ver o que acontece em cada caso.
$env = "file";
// $env = "console"
// $env = "consolee"

if ($env === "file") 
{
    $loggerFactory = new FileLoggerFactory();
} 
else if ($env === "console") 
{
    $loggerFactory = new ConsoleLoggerFactory();
}
else 
{
    throw new InvalidLoggerTypeException("Arquivo de configuração inválido! A propriedade deve ser 'file' ou 'console'");
}

$loggerFactory->logMessage("Isso é um log gerado pelo Factory Method!");