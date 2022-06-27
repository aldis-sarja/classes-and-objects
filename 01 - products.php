<?php

declare(strict_types=1);

class Product
{
    private string $name;
    private float $price;
    private int $amount;

    public function __construct(string $name, float $startPrice, int $amount)
    {
        $this->name = $name;
        $this->price = $startPrice;
        $this->amount = $amount;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function getAmount(): int
    {
        return $this->amount;
    }

    public function printProduct(): void
    {
        echo "{$this->name}, price {$this->price}, amount {$this->amount}\n";
    }

    public function setPrice(float $newPrice): void
    {
        $this->price = $newPrice;
    }

    public function setAmount(int $newAmount):void
    {
        $this->amount = $newAmount;
    }
}

$products = [
    new Product("Logitech mouse", 70.00, 14),
    new Product("iPhone 5s", 999.99, 3),
    new Product("Epson EB-U05", 440.46,1),
];

foreach ($products as $product) {
    $product->printProduct();
}
