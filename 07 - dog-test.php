<?php

declare(strict_types=1);

class Dog
{
    private string $name;
    private string $sex;
    private ?Dog $mother = null;
    private ?Dog $father = null;

    public function __construct(string $name, string $sex)
    {
        $this->name = $name;
        $this->sex = $sex;
    }

    public function getName(): string
    {
        return $this->name;
    }
    public function setName(string $newName): void
    {
        $this->name = $newName;
    }

    public function getSex(): string{
        return $this->sex;
    }

    public function getFaher(): ?Dog
    {
        return $this->father;
    }
    public function setFather(Dog $father): void
    {
        $this->father = $father;
    }

    public function getMother(): ?Dog
    {
        return $this->mother;
    }
    public function setMother(Dog $mother): void
    {
        $this->mother = $mother;
    }

    public function fathersName(): string
    {
        return isset($this->father) ? $this->father->name : "Unknown";
    }

    public function hasSameMotherAs(Dog $otherDog): bool
    {
        if (isset($otherDog->mother) && isset($this->mother)) {
            return $otherDog->mother === $this->mother;
        }
        return false;
    }

}

$max = new Dog('Max', 'male');
$rocky = new Dog('Rocky', 'male');
$sparky = new Dog('Sparky', 'male');
$buster = new Dog('Buster', 'male');
$sam = new Dog('Sam', 'male');
$lady = new Dog('Lady', 'female');
$molly = new Dog('Molly', 'female');
$coco = new Dog('Coco', 'female');

$max->setMother($lady);
$max->setFather($rocky);
$coco->setMother($molly);
$coco->setFather($buster);
$rocky->setMother($molly);
$rocky->setFather($sam);
$buster->setMother($lady);
$buster->setFather($sparky);

echo "{$buster->getName()} have father - {$buster->fathersName()}\n";

if ($coco->hasSameMotherAs($rocky)) {
    echo "{$coco->getName()} has same mother as {$rocky->getName()}\n";
}  else  echo "No!\n";

if ($max->hasSameMotherAs($sam)) {
    echo "{$coco->getName()} has same mother as {$rocky->getName()}\n";
} else  echo "No!\n";

var_dump($sam->getFaher());
