<?php

namespace App\Http\Controllers;

use App\Company;
use App\Customer;
use App\Invoice;
use App\Product;
use App\ShippingMethod;
use Barryvdh\DomPDF\Facade as PDF;
use Gloudemans\Shoppingcart\Exceptions\InvalidRowIDException;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InvoiceCartController extends Controller
{
    const ERROR_ITEM_NOT_EXISTS = 'Error. The product does not exist.';
    const ERROR_CUSTOMER_NOT_EXISTS = 'Error. The customer does not exist.';
    const ERROR_SHIPPING_METHOD_NOT_EXISTS = 'Error. The shipping method does not exist.';
    const ERROR_ITEM_NOT_IN_INVOICE = 'Error. This product is not in the invoice.';
    const ERROR_NOT_ENOUGH_IN_STOCK = 'Error. The selected quantity is not available for product ';

    /**
     * InvoiceCartController constructor set the cart instance
     * to invoices.
     */
    public function __construct()
    {
        $this->middleware('auth');
        Cart::instance('invoices');
    }

    /**
     * Show the user's invoice cart.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $output = $this->generateOutputData();

        return view('invoice.cart')->with($output);
    }

    /**
     * Generate the array containing the invoice data.
     *
     * @return array|bool the array containing the invoice data or
     *                    false if one or more products are not available.
     */
    private function generateOutputData()
    {
        $output = [];
        $products = Cart::content();
        // Loop over the products to add the unit price and total in the right format.
        foreach ($products as $product) {
            $unit_price = $product->price / 100;
            $product->unit_price = number_format($unit_price, 2);
            // TODO Fix this hack
            $product->quantity = $product->qty;
            $product->total_price = number_format($unit_price * $product->qty, 2);

            $product->available = $product->model->isQuantityAvailable((int) $product->quantity);
        }

        $output['products'] = $products;
        $output['disable_creation'] = $products->isEmpty() && $this->getCustomerId() === null;
        $output['company'] = Company::find(1);
        $output['customer'] = Customer::find($this->getCustomerId());

        $elements = ['subtotal', 'tax', 'total'];
        // Use PHP magic to dynamically get the elements from the array
        // calling their respective functions from Cart.
        foreach ($elements as $element) {
            $output[$element] = (float) Cart::$element(2, '.', '') / 100;
            $output[$element] = number_format($output[$element], 2);
        }

        return $output;
    }

    /**
     * Return the company id from the session.
     *
     * @return int
     */
    private function getCustomerId()
    {
        $customer_id = session('customer_id');

        return (int) $customer_id;
    }

    /**
     * Add a product into the current instance of the cart.
     *
     * @param int $product_id the product id
     * @param int $quantity   the product quantity
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function add($product_id, $quantity)
    {
        $product = Product::find((int) $product_id);
        if (!$product) {
            return back()->with('error', self::ERROR_ITEM_NOT_EXISTS);
        }

        $quantity = (int) $quantity;
        // Check availability
        if (!$product->isQuantityAvailable($quantity)) {
            return back()->with('error', 'The product is not available in the specified quantity.');
        }

        $cart_item = Cart::add($product->id, $product->name, $quantity, $product->unit_price);
        $cart_item->associate(Product::class);

        return back()->with('success', 'The product has been added to your invoice.');
    }

    /**
     * Update the quantity of a product in the invoice.
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request)
    {
        $request_products = $request->input('products');
        if (is_null($request_products)) {
            return back()->with('error', 'There are not items to update.');
        }

        foreach ($request_products as $request_product) {
            $product = Product::find((int) $request_product['id']);
            if (!$product) {
                return back()->with('error', self::ERROR_ITEM_NOT_EXISTS);
            }

            try {
                $rowId = $this->getRowId($product);
                $quantity = (int) $request_product['quantity'];
                if ($product->isQuantityAvailable($quantity)) {
                    Cart::update($rowId, $quantity);
                } else {
                    return redirect('cart')->with('error', self::ERROR_NOT_ENOUGH_IN_STOCK.$product->id);
                }
            } catch (InvalidRowIDException $e) {
                return redirect('cart')->with('error', self::ERROR_ITEM_NOT_IN_INVOICE);
            }
        }

        return redirect('cart')->with('success', 'The product quantity has been updated.');
    }

    /**
     * Get the rowId for the product in the invoice.
     *
     * @param Product $product the product in the invoice
     *
     * @return string|null the rowId of the product if in the invoice,
     *                     null otherwise.
     */
    private function getRowId(Product $product)
    {
        $res = Cart::search(function ($cart_product, $rowId) use ($product) {
            return $cart_product->id === $product->id;
        });

        return !$res->isEmpty() ? $res->first()->rowId : null;
    }

    /**
     * Remove a product from the invoice.
     *
     * @param int $product_id the id of the product to remove
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function remove(int $product_id)
    {
        $product = Product::find($product_id);
        if (!$product) {
            return redirect('cart')->with('error', self::ERROR_ITEM_NOT_EXISTS);
        }

        try {
            $rowId = $this->getRowId($product);
            Cart::remove($rowId);
        } catch (InvalidRowIDException $e) {
            return redirect('cart')->with('error', self::ERROR_ITEM_NOT_IN_INVOICE);
        }

        return redirect('cart')->with('success', 'The product has been removed from the invoice.');
    }

        /**
         * Add the shipping method to the invoice.
         *
         * @param int $shipping_method_id the id for the chosen shipping method
         *
         * @return \Illuminate\Http\RedirectResponse
         */
        public function addShippingMethod(int $shipping_method_id)
        {
            $shipping_method = ShippingMethod::find($shipping_method_id);
            if (!$shipping_method) {
                return redirect('cart')->with('error', self::ERROR_SHIPPING_METHOD_NOT_EXISTS);
            }
        }

    /**
     * Set the company to which the invoice is issued to.
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function setCartCustomer(Request $request)
    {
        $customer_id = $request->input('customer_id');
        $customer = Customer::find($customer_id);
        if (!$customer) {
            return redirect('cart')->with('error', self::ERROR_CUSTOMER_NOT_EXISTS);
        }

        $this->setCustomer($customer_id);

        return redirect('cart')->with('success', "The invoice will be issued to $customer->name.");
    }

    /**
     * Set the customer id into the session.
     *
     * @param int $customer_id the company id
     */
    private function setCustomer($customer_id)
    {
        session(['customer_id' => $customer_id]);
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function createInvoice(Request $request)
    {
        // If the buyer company is not set, send the user back
        if ($this->getCustomerId() === null) {
            return back()->with('error', 'Error. The customer information cannot be empty.');
        }

        $output = $this->generateOutputData();
        // If the buyer company is not set, send the user back
        if ($output['products']->isEmpty()) {
            return back()->with('error', 'Error. The invoice must contain at least one item.');
        }

        $this->validate($request, [
            'payment_terms'   => 'bail|required|max:255',
            'shipping_method' => 'required|max:255',
            'due_date'        => 'required|date',
            'delivery_date'   => 'required|date',
        ]);

        // Get the request input
        $payment_terms = $request->input('payment_terms');
        $shipping_method = $request->input('shipping_method');
        $due_date = $request->input('due_date');
        $delivery_date = $request->input('delivery_date');

        // Get the customer information
        $customer = Customer::find($this->getCustomerId())->toJson();

        $date = date('d-m-Y', time());

        $invoice = new Invoice([
            'number'  => 0,
            'user_id' => Auth::user()->id,
            'user'    => Auth::user()->toArray(),
            // TODO: remove hard-coded value
            'company_id'      => 1,
            'company'         => Company::find(1)->toJson(),
            'customer_id'     => (int) $this->getCustomerId(),
            'customer'        => $customer,
            'shipping_method' => $shipping_method,
            'products'        => $output['products']->toJson(),
            'delivery_date'   => $delivery_date,
            'date'            => $date,
            'due_date'        => $due_date,
            'payment_terms'   => $payment_terms,
            'subtotal'        => $output['subtotal'],
            'tax'             => $output['tax'],
            'total'           => $output['total'],
        ]);

        // If the invoice is saved
        if ($invoice->save()) {
            // Destroy the cart and go back with success message
            $this->destroy();

            return redirect('/user/invoice');
        } else {
            return back()->with('error', 'Error. It was not possible to create the invoice.');
        }
    }

    /**
     * Destroy the current cart instance.
     */
    public function destroy()
    {
        $this->setCustomer(null);
        Cart::destroy();

        return redirect('cart');
    }

}
