<?php
require 'vendor/autoload.php';
require 'CustomAutoload.php';

use App\Models\User;
use Faker\Factory;

$faker = Factory::create();

$user = new User($faker->uuid(), $faker->userName, $faker->firstName, $faker->lastName);
echo "User: {$user->id} {$user->firstName} {$user->lastName}";

echo ("</br>");

$postClassName = "App\Models\Post";
$post = new $postClassName(
    $faker->uuid(),
    $faker->uuid(),
    $faker->title,
    $faker->text
);

echo "Post: {$post->id} {$post->title} {$post->text}";
