<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Route;


class FAQController extends Controller
{
    /**
     * Show the FAQ page.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {

        $faqs_array = [
            [
                'header' => 'General questions',
                [
                    'question' => 'Is account registration required?',
                    'answer' => 'Account registration is required to perform any action on the system.'
                ],
                [
                    'question' => 'How do I login?',
                    'answer' => 'You can login using the ' . self::link('login', 'login page.')
                ],
                [
                    'question' => 'How do I create a new account?',
                    'answer' => 'You can create a new account from the ' . self::link('register', 'registration page.')
                ],
            ],
            [
                'header' => 'Products',
                [
                    'question' => 'How do I add a product to the invoice cart?',
                    'answer' => 'Click on the button "Add to invoice". The product will be automatically 
                                 added to your invoice cart.'
                ],
                [
                    'question' => 'How do I edit a product information?',
                    'answer' => 'Click on the button "Edit product". You will be redirected to the page
                                 that allows you to edit the product information.'
                ],
                [
                    'question' => 'What happens when the stock quantity is low?',
                    'answer' => 'When a product stock quantity is below 25 units, the "Add to invoice" button
                                 turns ochre, otherwise it will stay green when the amount is higher than this value.'
                ],
            ],
            [
                'header' => 'Customers',
                [
                    'question' => 'How do I add a customer to the invoice cart?',
                    'answer' => 'Click on the button "Add to invoice". The customer will be automatically
                                 added to your invoice cart.'
                ],

            ],
            [
                'header' => 'Invoices',
                [
                    'question' => 'How do I generate an invoice?',
                    'answer' => 'Add a product (at least), a customer, and the additional information the form requires. 
                    Then you will be able to generate the invoice which will be downloaded to your device.'
                ],
                [
                    'question' => 'What output format is used for the invoices?',
                    'answer' => 'All invoices are downloaded as PDF files.'
                ],

            ]
        ];

        return view('pages/faq')->with('faqs_array', $faqs_array);
    }

    /**
     * Create an HTML link tag using route and text provided.
     *
     * @param string $route the route name.
     * @param string $text the text to use for the anchor tag.
     * @return string
     */
    private static function link($route, $text)
    {
        return "<a href='" . self::getRoute($route) . "'>$text</a>";
    }

    /**
     * Return the URI for the wanted route.
     *
     * @param string $name the route name.
     * @return string the URI associated with the route.
     */
    private static function getRoute($name)
    {
        return Route::get($name)->uri();
    }
}
