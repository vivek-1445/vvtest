<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'name' => $faker->text(10),
        'price' => $faker->randomNumber(4),
        'quantity' => $faker->randomNumber(2),
        'category_id' => 5,
        'created_by' => 6
    ];
});
