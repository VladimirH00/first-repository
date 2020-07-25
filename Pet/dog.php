<?php
require_once 'pet.php';

use animals\Pet as Pet;

class Dog extends pet
{

    public function sound()
    {
        echo "Гав<br>";
    }
}