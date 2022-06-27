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

    public function withdrawal(float $amount): float
    {
        if ($this->balance < $amount) {
            $amount = $this->balance;
            $this->balance = 0;
        } else {
            $balance = $this->balance - $amount;
            $this->balance = BankAccount::fixNumber($balance);
        }

        return $amount;
    }

    public function deposit(float $amount): void
    {
        $balance = $this->balance + $amount;
        $this->balance = BankAccount::fixNumber($balance);
    }

    public static function fixNumber(float $number): float
    {
        return (float)(number_format($number, 2, '.', ''));
    }
}


$bartos_account = new BankAccount("Barto's account", 100.00);
$bartos_swiss_account = new BankAccount("Barto's account in Switzerland", 1000000.00);

echo "Initial state";
echo $bartos_account->show_user_name_and_balance();
echo PHP_EOL;
echo $bartos_swiss_account->show_user_name_and_balance();
echo PHP_EOL;

$bartos_account->withdrawal(20);
echo "Barto's account balance is now: " . $bartos_account->getBalance();
echo PHP_EOL;
$bartos_swiss_account->deposit(200);
echo "Barto's Swiss account balance is now: ".$bartos_swiss_account->getBalance();
echo PHP_EOL;

echo "Final state";
echo PHP_EOL;
echo $bartos_account->show_user_name_and_balance();
echo PHP_EOL;
echo $bartos_swiss_account->show_user_name_and_balance();
echo PHP_EOL;


function transfer(BankAccount $from, BankAccount $to, int $howMuch)
{
    $to->deposit($from->withdrawal($howMuch));
}

$a = new BankAccount('A', 100);
$b = new BankAccount('B', 0);
$c = new BankAccount('C', 0);
transfer($a, $b, 50);
transfer($b, $c, 25);
echo $a->show_user_name_and_balance() . PHP_EOL;
echo $b->show_user_name_and_balance() . PHP_EOL;
echo $c->show_user_name_and_balance() . PHP_EOL;
