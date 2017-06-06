<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\ShippingMethod::class, function (Faker\Generator $faker) {
    return [
        'name'        => $faker->word,
        'description' => $faker->paragraphs(1, true),
        'price'       => $faker->randomNumber(),
    ];
});
