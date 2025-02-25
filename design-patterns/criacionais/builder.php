<?php

// Produto final: Carro
class Car {
    public string $type;
    public int $seats;
    public string $engine;
    public bool $hasGPS;
    public bool $hasAirConditioing;

    public function showCar() {
        return "Carro $this->type, com $this->seats assentos, um motor $this->engine, "
        . ($this->hasGPS ? "Com GPS, " : "Sem GPS, ")
        . ($this->hasAirConditioing ? "e com ar condicionado." : "e sem ar condicionado.");
    }
}

// Interface do Builder
interface Builder {
    public function setType(string $type): Builder;
    public function setSeats(int $seats): Builder;
    public function setEngine(string $engine): Builder;
    public function setGPS(bool $hasGPS): Builder;
    public function setAirConditioing(bool $hasAirConditioing): Builder;
    public function getCar(): Car;
}

class CarBuilder implements Builder {
    private Car $car;

    public function __construct()
    {
        $this->reset();
    }

    public function reset() {
        $this->car = new Car;
    }

    public function setType(string $type): Builder
    {
        $this->car->type = $type;
        return $this;
    }

    public function setSeats(int $seats): Builder
    {
        $this->car->seats = $seats;
        return $this;
    }

    public function setEngine(string $engine): Builder
    {
        $this->car->engine = $engine;
        return $this;
    }

    public function setGPS(bool $hasGPS): Builder
    {
        $this->car->hasGPS = $hasGPS;
        return $this;
    }

    public function setAirConditioing(bool $hasAirConditioing): Builder
    {
        $this->car->hasAirConditioing = $hasAirConditioing;
        return $this;
    }

    public function getCar(): Car
    {
        $car = $this->car;
        $this->reset();
        return $car;
    }
}

class CarDirector {
    public function buildSportCar(CarBuilder $carBuilder): Car {
        return $carBuilder
                ->setType("Esportivo")
                ->setSeats(2)
                ->setEngine("V8 Turbo")
                ->setGPS(true)
                ->setAirConditioing(true)
                ->getCar();
    }
}

$carBuilder = new CarBuilder();
$carDirector = new CarDirector();

$sportCar = $carDirector->buildSportCar($carBuilder);

echo $sportCar->showCar() . PHP_EOL;