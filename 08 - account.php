<?php

declare(strict_types=1);

class SavingsAccount
{
    private float $balance;
    private float $interestRate = 0.05;

    public function __construct(float $balance)
    {
        $this->balance = $balance;
    }

    public function getBalance(): float
    {
        return $this->balance;
    }

    public function getInterestRate(): float
    {
        return $this->interestRate;
    }

    public function setInterestRate(float $rate):void
    {
        $this->interestRate = $rate;
    }

    public function withdraw(float $amount): float
    {
        if ($this->balance < $amount) {
            $amount = $this->balance;
            $this->balance = 0;
        } else {
            $balance = $this->balance - $amount;
            $this->balance = SavingsAccount::fixNumber($balance);
        }

        return $amount;
    }

    public function add(float $amount): void
    {
        $balance = $this->balance + $amount;
        $this->balance = SavingsAccount::fixNumber($balance);
    }

    public function addMonthlyInterest(): float
    {
        $interest = $this->balance * $this->interestRate/1200;
        $balance = $this->balance + $interest;
        $this->balance = SavingsAccount::fixNumber($balance);
        return SavingsAccount::fixNumber($interest);
    }

    public static function fixNumber(float $number): float
    {
        return (float)(number_format($number, 2, '.', ''));
    }
}
/*
$amount = (int)readline("How much money is in the account?: ");
$myAccount = new SavingsAccount($amount);
echo $myAccount->getBalance();
echo PHP_EOL;
$myAccount->setInterestRate((int)readline("Enter the annual interest rate: "));
$period = (int)readline("How long has the account been opened? ");
*/

$withdrawn = 0;
$interest = 0;
$deposits = 0;

// Testing...
$myAccount = new SavingsAccount(10000);
$myAccount->setInterestRate(5);


// Month 1
$myAccount->add(100);
$deposits += 100;
$interest += $myAccount->addMonthlyInterest();
$withdrawn += $myAccount->withdraw(1000);
// Month 2
$myAccount->add(230);
$deposits += 230;
$interest += $myAccount->addMonthlyInterest();
$withdrawn += $myAccount->withdraw(103);
// Month 3
$myAccount->add(4050);
$deposits += 4050;
$interest += $myAccount->addMonthlyInterest();
$withdrawn += $myAccount->withdraw(2334);
// Month 4
$myAccount->add(3450);
$deposits += 3450;
$interest += $myAccount->addMonthlyInterest();
$withdrawn += $myAccount->withdraw(2340);


/*
for ($month = 1; $month <= $period; $month++) {
    $deposit = (int)readline("Enter amount deposited for month: {$month}: ");
    $myAccount->add($deposit);
    $deposits += $deposit;
    $interest += $myAccount->addMonthlyInterest();
    $amount = (float)readline("Enter amount withdrawn for {$month}: ");
    $withdrawn += $myAccount->withdraw($amount);
}
*/

echo "Total deposited: \$" . number_format($deposits, 2) . PHP_EOL;
echo "Total withdrawn: \$" . number_format($withdrawn, 2) . PHP_EOL;
echo "Interest earned: \$" . number_format($interest, 2) . PHP_EOL;
echo "Ending balance: \$" . number_format($myAccount->getBalance(), 2) . PHP_EOL;
