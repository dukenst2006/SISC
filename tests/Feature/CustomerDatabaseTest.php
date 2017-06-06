<?php

namespace Tests\Feature\Unit;

use App\Customer;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class CustomerDatabaseTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * Customer creation.
     *
     * @return void
     */
    public function testCreateCustomer()
    {
        $customer = factory(Customer::class)->create();
        $this->assertFalse(is_null($customer));
    }

    /**
     * Delete the new customer.
     */
    public function testRemoveCustomer()
    {
        $customer = Customer::all()->first();
        $this->assertTrue($customer->delete());
    }
}
