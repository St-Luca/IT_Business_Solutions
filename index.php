<?php
require 'vendor/autoload.php';
require 'CustomAutoload.php';

use App\Models\User;
use Faker\Factory;

$faker = Factory::create();

$user = new User($faker->randomNumber(), $faker->firstName, $faker->lastName);
echo "User: {$user->firstName} {$user->lastName}";

echo ("</br>");

$articleClassName = "App\Models\Article";
$article = new $articleClassName(
    $faker->randomNumber(),
    $faker->randomNumber(),
    $faker->sentence,
    $faker->text
);

echo "Article: {$article->title} {$article->text}";
