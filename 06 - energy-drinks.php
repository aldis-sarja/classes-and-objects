<?php

declare(strict_types=1);

class Survey
{
//    public int $surveyed = 12467;
    public float $purchased_energy_drinks = 0.14;
    public float $prefer_citrus_drinks = 0.64;

    public function calculate_energy_drinkers(int $numberSurveyed): float
    {
//    throw new LogicException(";(");
        return $numberSurveyed * $this->purchased_energy_drinks;
    }

    function calculate_prefer_citrus(int $numberSurveyed): float
    {
//    throw new LogicException(";(");
        return $numberSurveyed * $this->prefer_citrus_drinks;
    }
}

$survey = new Survey();

$surveyed = 12467;

echo "Total number of people surveyed " . $surveyed . PHP_EOL;
echo "Approximately " . $survey->calculate_energy_drinkers($surveyed) . " bought at least one energy drink\n";
echo $survey->calculate_prefer_citrus($surveyed) . " of those " . "prefer citrus flavored energy drinks.\n";
