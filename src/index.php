<?php
require_once '../vendor/autoload.php';

use wayne\Car;

$faker = Faker\Factory::create('zh_TW');
echo $faker->name(); //msg_name
echo "<br>";
echo $faker->realtext($maxNbChars = 20); //msg_content
echo "<br>";
$timetamp = ($faker->date('Y/m/d'))." ".($faker->time());

echo "<br>";

$car = Car::add();
echo $car;
echo "<br>";

?>