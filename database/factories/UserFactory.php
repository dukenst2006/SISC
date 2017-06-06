<?php

use App\Role;

/* @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    // Pick a random role ID from the Roles table.
    $roles = Role::all()->pluck('id')->toArray();
    $random_role_id = array_rand($roles, 1);

    return [
        'role_id'        => $roles[$random_role_id],
        'first_name'     => $faker->firstName,
        'middle_name'    => $faker->firstName,
        'last_name'      => $faker->lastName,
        'email'          => $faker->unique()->safeEmail,
        'password'       => $password ?: $password = bcrypt('secret'),
        'active'         => false,
        'remember_token' => str_random(10),
    ];
});
