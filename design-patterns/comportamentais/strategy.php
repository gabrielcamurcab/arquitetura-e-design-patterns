<?php

interface Strategy {
    public function execute(int $a, int $b): int;
}

class ConcreteStrategyAdd implements Strategy {
    public function execute(int $a, int $b): int {
        return $a + $b;
    }
}

class ConcreteStrategySubstract implements Strategy {
    public function execute(int $a, int $b): int
    {
        return $a - $b;
    }
}

class ConcreteStratategyMultiply implements Strategy {
    public function execute(int $a, int $b): int
    {
        return $a * $b;
    }
}

class Context {
    private Strategy $strategy;

    public function setStrategy(Strategy $strategy) {
        $this->strategy = $strategy;
    }

    public function executeStrategy(int $a, int $b) {
        return $this->strategy->execute($a, $b);
    }
}

$a = 10;
$b = 20;

$context = new Context();

$context->setStrategy(new ConcreteStrategyAdd());
echo "ConcreteStrategyAdd: " . $context->executeStrategy($a,$b) . PHP_EOL;

$context->setStrategy(new ConcreteStrategySubstract);
echo "ConcreteStrategySubstract: " . $context->executeStrategy($a,$b) . PHP_EOL;

$context->setStrategy(new ConcreteStratategyMultiply);
echo "ConcreteStratategyMultiply: " . $context->executeStrategy($a,$b) . PHP_EOL;