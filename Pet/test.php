<?php
require_once 'cat.php';

require_once 'dog.php';
$cat = new Cat("Tom", 20);
$cat->sound();
$cat->sayAge();
$cat->sayName();
$dog = new Dog("Rex", 12);
$dog->sound();
$dog->sayAge();
$dog->sayName();