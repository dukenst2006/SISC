<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Http\Requests\StoreCustomerInfo;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;

class CustomerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /** @var string $ID_SALT the salt used to check the form integrity */
    const ID_SALT = 'YVmrMN5Q9RdIcwP977TuEiT6t0rkVb3pEwiGErsS';

    /**
     * Show a customer information.
     *
     * @param int $id the customer id
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id = 1)
    {
        $customer = Customer::find($id);

        if ($customer == null) {
            abort(404);
        }

        $customer_hash = $this->generateHash($id);

        return view('customer/details')->with([
            'customer'      => $customer,
            'customer_hash' => $customer_hash,
        ]);
    }

    /**
     * Generate an hash from an id.
     *
     * @param mixed $id the id used to create the hash.
     *
     * @return string the final hash.
     */
    private function generateHash($id)
    {
        return sha1(self::ID_SALT.$id);
    }

    /**
     * Show all companies.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showAll()
    {
        $customers = Customer::paginate(15);

        return view('customer/list')->with('customers', $customers);
    }

    /**
     * Update the customer information.
     *
     * @param StorecustomerInfo $request
     *
     * @return Response
     */
    public function update(StoreCustomerInfo $request)
    {
        $info = $request->all();
        $customer_id = (int) $info['id'];
        $customer_hash = $info['customer_hash'];

        // Check if the hash from the form is valid
        if (!$this->checkHash($customer_hash, $customer_id)) {
            return back()->with('error', 'Error: wrong customer id in the submitted form.');
        }

        // Check if the user can update companies
        if (!Gate::allows('update-customer')) {
            return back()->with('error', 'Error: you do not have the permissions to edit the customer information.');
        }

        $customer = Customer::find($customer_id);
        // Update the customer info
        $customer->fill($request->all());

        if (!$customer->isDirty() || $customer->save()) {
            $message['success'] = 'The customer information was updated!';
        } else {
            $message['error'] = 'An error occurred while saving the customer information. Please try again.';
        }

        return back()->with($message);
    }

    /**
     * Check the integrity of an hash.
     *
     * @param string $hash the customer hash
     * @param int    $id   the customer id
     *
     * @return bool true if the hash matches the id, false otherwise.
     */
    private function checkHash($hash, $id)
    {
        return $this->generateHash($id) === $hash;
    }
}
