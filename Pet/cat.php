<?php
require_once 'pet.php';

use animals\Pet as Pet;

class Cat extends Pet
{


    public function sound()
    {
        echo "Мяу<br>";
    }
}