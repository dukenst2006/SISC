<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Invoice;
use App\Product;
use App\User;

class DashboardController extends UserController
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        // Create an array of data to display in the dashboard
        $data = [
            'users'     => User::all()->count(),
            'customers' => Customer::all()->count(),
            'products'  => Product::all()->count(),
            'invoices'  => Invoice::all()->count(),
        ];

        return view('user/dashboard')->with($data);
    }
}
