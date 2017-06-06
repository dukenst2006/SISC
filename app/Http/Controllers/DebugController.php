<?php

namespace App\Http\Controllers;

use App\Invoice;
use App\Product;
use App\ShippingMethod;
use App\User;
use Auth;

class DebugController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $users = User::all();
        $products = Product::all();
        $customers = Customer::all();
        $sms = ShippingMethod::all();

        // Adds the manufacturer name using Eloquent.
        foreach ($products as $key => $product) {
            $products[$key]->unit_price = $product->unit_price / 100;
            $products[$key]->customer_name = $product->customer->name;
        }

        return view('debug.general')->with(['sms' => $sms, 'users' => $users, 'products' => $products, 'customers' => $customers]);
    }

    public function invoices()
    {
        $invoices = Invoice::all();

        return view('debug/data')->with('data', $invoices);
    }

    public function userInvoices()
    {
        $invoices = Auth::user()->invoices;

        return view('debug/data')->with('data', $invoices);
    }

    public function userLastInvoice()
    {
        $invoice = Auth::user()->invoices->last();

        return view('debug/data')->with('data', $invoice);
    }
}
