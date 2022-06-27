<?php

declare(strict_types=1);

class FuelGauge
{
    private int $amount;

    public function __construct(int $amount = 0)
    {
        $this->amount = $amount;
    }

    public function addFuel(): void
    {
        $this->amount += 1;
        if ($this->amount > 70) {
            $this->amount = 70;
        }
    }

    public function burnFuel():void
    {
        $this->amount -= 1;
        if ($this->amount < 0) {
            $this->amount = 0;
        }
    }

    public function getAmount(): int
    {
        return $this->amount;
    }

    public function report(): void
    {
        echo "Remain fuel: {$this->amount}l\n";
    }
}

class Odometer
{
    private int $distance = 0;

    public function getDistance(): int
    {
        return $this->distance;
    }

    public function increaseDistance(int $distance = 1): void
    {
        $this->distance += $distance;
        if ($this->distance > 999999) {
            $this->distance = $this->distance - 999999;
        }
    }
}

class Car
{
    public FuelGauge $fuelGauge;
    public Odometer $odometer;
    public int $distance = 0;

    public function __construct(int $odometer, int $fuel)
    {
        $this->odometer = new Odometer($odometer);
        $this->fuelGauge = new FuelGauge($fuel);
    }
    public function drive()
    {
        $this->distance++;
        $this->odometer->increaseDistance(1);
        if ($this->distance >= 10) {
            $this->distance = 0;
            $this->fuelGauge->burnFuel();
        }
    }
}

$myCar = new Car(42, 3);
$myCar->fuelGauge->addFuel();

while ($myCar->fuelGauge->getAmount()) {
    $myCar->drive();
    $myCar->fuelGauge->report();
}
