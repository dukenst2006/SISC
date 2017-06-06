<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Customer::class, function (Faker\Generator $faker) {
    return [
        'name'         => $faker->firstName,
        'company_name' => $faker->company,
        'address'      => $faker->streetAddress,
        'city'         => $faker->city,
        'postcode'     => $faker->postcode,
        'country'      => $faker->country,
        'email'        => $faker->safeEmail,
        'telephone'    => $faker->phoneNumber,
        'mobile'       => $faker->phoneNumber,
    ];
});
