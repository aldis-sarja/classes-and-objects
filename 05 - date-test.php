<?php

declare(strict_types=1);

class Date
{
    private int $year;
    private int $month;
    private int $day;
    private $months = [
        1 => 'January',
        2 => 'February',
        3 => 'March',
        4 => 'April',
        5 => 'May',
        6 => 'June',
        7 => 'July',
        8 => 'August',
        9 => 'September',
        10 => 'October',
        11 => 'November',
        12 => 'December',
    ];

    public function __construct(int $year, int $month, int $day)
    {
        $this->year = $year;
        $this->month = $month;
        $this->checkCorrectDay($day);
        $this->day = $day;
    }

    public function getYear(): int
    {
        return $this->year;
    }

    public function setYear(int $year): void
    {
        $this->year = $year;
    }

    public function getMonth(): int
    {
        return $this->month;
    }

    public function setMonth(int $month): void
    {
        if ($month < 1 || $month > 12) {
            throw new Exception("Error! Incorrect month!");
        }
        $this->month = $month;
    }

    public function getDay(): int
    {
        return $this->day;
    }

    public function setDay(int $day): void
    {
        $this->checkCorrectDay($day);
        $this->day = $day;
    }

    public function displayDate(): void
    {
        echo "$this->month/$this->day/$this->year\n";
    }

    private function checkCorrectDay(int $day): void
    {
        if ($day < 1 || $day > 31) {
            throw new Exception("Error! Incorrect day!");
        }
        if ($this->month === 2) {
            if ($day === 29) {
                if (!$this->isLeapYear($this->year)) {
                    throw new Exception("Error! Short year doesn't have 29 days in February!");
                }
            }
        }
        if ($this->month % 2 === 0 && $day === 31) {
            throw new Exception("Error! " . $this->months[$this->month] . " doesn't have 31 days!");
        }
    }

    private function isLeapYear(int $year): bool
    {
        if (($year % 400 === 0) || (($year % 4 === 0) && ($year % 100 !== 0))) {
            return true;
        }
        return false;
    }
}

class DateTest
{
    public function run(): void
    {
        try {
            $date1 = new Date(2022, 06, 26);
            $date1->displayDate();
            $date1->setMonth(02);
            $date1->setDay(28);
            $date1->displayDate();
            $date1->setDay(29);
            $date1->displayDate();
        } catch (Exception $exp) {
            echo $exp->getMessage();
        }
    }
}

(new DateTest())->run();
