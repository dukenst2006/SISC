<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\Auth;

class InvoiceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function userLastInvoice()
    {
        $invoice = Auth::user()->invoices->last();

        if (empty($invoice)) {
            return redirect('/user/dashboard')->with('error', 'You have not created any invoice yet.');
        }

        $products = json_decode($invoice->products, true);

        $pdf = app('dompdf.wrapper');
        $pdf->loadView('invoice.main', [
            'invoice' => $invoice,
            'products' => $products,
        ]);
//        $pdf->download('invoice.pdf');

        return view('invoice/main')->with([
            'invoice' => $invoice,
            'products' => $products,
        ]);
    }

    public function userInvoices()
    {
        $invoices = Auth::user()->invoices;

        if (empty($invoice)) {
            return redirect('/user/dashboard')->with('error', 'You have not created any invoice yet.');
        }

        return view()->with($invoices);
    }

    /**
     * SEARCH WITH https://github.com/bassjobsen/Bootstrap-3-Typeahead
     *  PDF WITH https://github.com/barryvdh/laravel-dompdf.
     *
     * TUTORIAL http://itsolutionstuff.com/post/laravel-5-autocomplete-using-bootstrap-typeahead-js-example-with-demoexample.html
     */

}
