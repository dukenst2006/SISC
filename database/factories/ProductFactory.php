<?php

use App\Company;

/* @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Product::class, function (Faker\Generator $faker) {

    // Pick a random company
    $companies = Company::all()->pluck('id')->toArray();

    return [
        'name'        => ucfirst($faker->word),
        'description' => $faker->paragraphs(1, true),
        'company_id'  => $faker->randomElement($companies),
        'barcode'     => $faker->ean13,
        'unit_price'  => $faker->numberBetween(50, 10000),
        'quantity'    => $faker->numberBetween(20, 500),
    ];
});
