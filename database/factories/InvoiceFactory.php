<?php

use App\Customer;
use App\Product;
use App\ShippingMethod;
use App\System;
use App\User;

/* @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Invoice::class, function (Faker\Generator $faker) {
    $products = Product::all()->random($faker->numberBetween(1, 5));

    $user = User::all()->random(1);
    $customer = Customer::all()->random(1);
    $sm = ShippingMethod::all()->random(1);

    $total = $faker->numberBetween(100, 500000) / 100;
    $tax = $total * System::getVAT() / 100;
    $subtotal = $total - $tax;

    $date = date('d-m-Y', time());

    return [
        'number'          => $faker->numberBetween(1, 2000),
        'user_id'         => 1,
        'user'            => $user->toJson(),
        'customer_id'     => 1,
        'customer'        => $customer->toJson(),
        'company_id'      => 1,
        'company'         => \App\Company::find(1)->toJson(),
        'shipping_method' => $sm->toJson(),
        'products'        => $products->toJson(),
        'date'            => $date,
        'delivery_date'   => $faker->date('d-m-Y'),
        'due_date'        => $faker->date('d-m-Y'),
        'payment_terms'   => $faker->sentence(1),
        'tax'             => $tax,
        'subtotal'        => $subtotal,
        'total'           => $total,
    ];
});
