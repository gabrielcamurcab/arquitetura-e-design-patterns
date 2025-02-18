<?php

interface Chair {
    public function hasLegs(): bool;
    public function sitOn(): bool;
}

interface CoffeeTable {
    public function getMaterial(): string;
    public function getDimensions(): array;
}

interface Sofa {
    public function getMaterial(): string;
    public function getSeatNumbers(): int;
}

interface FurnitureFactory {
    public function createChair(): Chair;
    public function createCoffeeTable(): CoffeeTable;
    public function createSofa(): Sofa;
}

class VictorianChair implements Chair {
    public function hasLegs(): bool
    {
        return true;
    }

    public function sitOn(): bool
    {
        return false;
    }
}

class ModernChair implements Chair {
    public function hasLegs(): bool
    {
        return true;
    }

    public function sitOn(): bool
    {
        return true;
    }
}

class ArtDecoChair implements Chair {
    public function hasLegs(): bool
    {
        return false;
    }

    public function sitOn(): bool
    {
        return false;
    }
}

class VictorianCoffeeTable implements CoffeeTable {
    public function getMaterial(): string
    {
        return "Madeira";
    }

    public function getDimensions(): array
    {
        return [1,1,1];
    }
}

class ModernCoffeeTable implements CoffeeTable {
    public function getMaterial(): string
    {
        return "Ferro";
    }

    public function getDimensions(): array
    {
        return [1.5,1.2,2];
    }
}

class ArtDecoCoffeeTable implements CoffeeTable {
    public function getMaterial(): string
    {
        return "Bambu";
    }

    public function getDimensions(): array
    {
        return [0.9,0.5,0.5];
    }
}

class VictorianSofa implements Sofa {
    public function getMaterial(): string
    {
        return "Pedra";
    }

    public function getSeatNumbers(): int
    {
        return 1;
    }
}

class ModernSofa implements Sofa {
    public function getMaterial(): string
    {
        return "Tecido";
    }

    public function getSeatNumbers(): int
    {
        return 4;
    }
}

class ArtDecoSofa implements Sofa {
    public function getMaterial(): string
    {
        return "Seda";
    }

    public function getSeatNumbers(): int
    {
        return 6;
    }
}

class VictorianFurnitureFactory implements FurnitureFactory {
    public function createChair(): Chair
    {
        return new VictorianChair;
    }

    public function createCoffeeTable(): CoffeeTable
    {
        return new VictorianCoffeeTable;
    }

    public function createSofa(): Sofa
    {
        return new VictorianSofa;
    }
}

class ModernFurnitureFactory implements FurnitureFactory {
    public function createChair(): Chair
    {
        return new ModernChair;
    }

    public function createCoffeeTable(): CoffeeTable
    {
        return new ModernCoffeeTable;
    }

    public function createSofa(): Sofa
    {
        return new ModernSofa;
    }
}

class ArtDecoFurnitureFactory implements FurnitureFactory {
    public function createChair(): Chair
    {
        return new ArtDecoChair;
    }

    public function createCoffeeTable(): CoffeeTable
    {
        return new ArtDecoCoffeeTable;
    }

    public function createSofa(): Sofa
    {
        return new ArtDecoSofa;
    }
}

function showFurniture(FurnitureFactory $furnitureFactory) {
    $chair = $furnitureFactory->createChair();
    $table = $furnitureFactory->createCoffeeTable();
    $sofa = $furnitureFactory->createSofa();

    echo "Cadeira tem pernas? " . ($chair->hasLegs() ? "Sim" : "Não") . PHP_EOL;
    echo "Cadeira pode sentar? " . ($chair->sitOn() ? "Sim" : "Não") . PHP_EOL;

    echo "Mesa de café feita de " . $table->getMaterial() . PHP_EOL;
    echo "Dimensões da mesa: " . implode(" x ", $table->getDimensions()) . PHP_EOL;

    echo "Sofá feito de " . $sofa->getMaterial() . PHP_EOL;
    echo "Número de assentos: " . $sofa->getSeatNumbers() . PHP_EOL;
}

showFurniture(new VictorianFurnitureFactory);
echo PHP_EOL;
showFurniture(new ModernFurnitureFactory);
echo PHP_EOL;
showFurniture(new ArtDecoFurnitureFactory);
