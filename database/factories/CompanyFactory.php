<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Company::class, function (Faker\Generator $faker) {
    return [
        'name'     => $faker->company,
        'address'  => $faker->streetAddress,
        'city'     => $faker->city,
        'postcode' => $faker->postcode,
        'country'  => $faker->country,
        'vat'      => 'AA123456789',

        'email'     => $faker->companyEmail,
        'telephone' => $faker->phoneNumber,
    ];
});
