<?php

declare(strict_types=1);

class BankAccount
{
    private float $balance;
    private string $name;
    private string $currency = '$';

    public function __construct(string $name, float $balance)
    {
        $this->balance = $balance;
        $this->name = $name;
    }

    public function getBalance(): float
    {
        return $this->balance;
    }

    public function getCurrency(): string{
        return $this->currency;
    }

    public function setCurrency(string $currency): void
    {
        $this->currency = $currency;
    }

    public function show_user_name_and_balance(): string
    {
        $sign = '';
        $balance = $this->balance;
        if ($balance < 0) {
            $sign = '-';
            $balance = -$balance;
        }
        return "{$this->name}, {$sign}" . $this->currency
                . number_format($balance);
    }

    public static function fixNumber(float $number): float
    {
        return (float)(number_format($number, 2, '.', ''));
    }
}

$newAccount = new BankAccount('Benson', 17.25);
echo $newAccount->show_user_name_and_balance() . PHP_EOL;

$newAccount = new BankAccount('Benson', -17.25);
echo $newAccount->show_user_name_and_balance() . PHP_EOL;
