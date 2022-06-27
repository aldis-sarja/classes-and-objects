<?php

declare(strict_types=1);

class Point
{
    private int $x;
    private int $y;

    public function __construct(int $x = 0, int $y = 0)
    {
        $this->x = $x;
        $this->y = $y;
    }

    public function setX(int $newX): void
    {
        $this->x = $newX;
    }

    public function setY(int $newY): void
    {
        $this->y = $newY;
    }

    public function getX(): int
    {
        return $this->x;
    }

    public function getY(): int
    {
        return $this->y;
    }
}

function swapPoints(Point $p1, Point $p2): void
{
    $tmp = new Point($p1->getX(), $p1->getY());

    $p1->setX($p2->getX());
    $p1->setY($p2->getY());

    $p2->setX($tmp->getX());
    $p2->setY($tmp->getY());
}

$p1 = new Point(5, 2);
$p2 = new Point(-3, 6);
echo "Pirms swapošanas\n";
echo "(" . $p1->getX() . ", " . $p1->getY() . ")\n";
echo "(" . $p2->getX() . ", " . $p2->getY() . ")\n";

swapPoints($p1, $p2);
echo "Pēc swapošanas\n";
echo "(" . $p1->getX() . ", " . $p1->getY() . ")\n";
echo "(" . $p2->getX() . ", " . $p2->getY() . ")\n";
