<?php

namespace animals;
abstract class Pet
{
    private $name;
    private $age;

    public function __construct($name, $age)
    {
        $this->name = $name;
        $this->age = $age;
    }

    abstract public function sound();

    public function sayName()
    {
        print_r("Меня зовут, " . $this->name . "<br>");
    }

    public function sayAge()
    {
        echo "Мой возраст " . $this->age . "<br>";
    }
}