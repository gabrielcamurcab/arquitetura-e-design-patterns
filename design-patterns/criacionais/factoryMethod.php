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

class DbLogger implements Logger {
    private string $dbname;

    public function __construct(string $dbname) {
        $this->dbname = __DIR__."/".$dbname;
    }

    public function log(string $message): void {
        $db = new PDO("sqlite:$this->dbname");

        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $db->exec("CREATE TABLE IF NOT EXISTS logs (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            message TEXT
        )");

        $stmt = $db->prepare("INSERT INTO logs (message) VALUES (:message)");
        $stmt->bindParam(':message', $message);
        
        if ($stmt->execute()) {
            echo "Registro armazenado no banco de dados $this->dbname";
        } else {
            echo "Erro ao inserir.";
        }
    }
}

abstract class LoggerFactory {
    abstract protected function createLogger(): Logger; // Factory Method

    public function logMessage(string $message) {
        $logger = $this->createLogger();
        $logger->log($message);
    } // Função da regra de negócios
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

class DbLoggerFactory extends LoggerFactory {
    protected function createLogger(): Logger
    {
        return new DbLogger("database.db");
    }
}

// Simulando o parâmetro em uma arquivo de variável de ambiente, definindo onde devem ser salvos os logs (em arquivo ou apenas exibidos no console).
// Comente e descomente as declarações de $env e execute novamente o código, para ver o que acontece em cada caso.
$env = "db";
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
else if ($env === "db")
{
    $loggerFactory = new DbLoggerFactory();
}
else 
{
    throw new InvalidLoggerTypeException("Arquivo de configuração inválido! A propriedade deve ser 'file' ou 'console'");
}

$loggerFactory->logMessage("Isso é um log gerado pelo Factory Method!");