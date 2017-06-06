<?php

namespace Tests\Browser;

use App\Customer;
use App\User;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class CustomerTest extends DuskTestCase
{
    const CUSTOMERS_URL = '/customers';
    const CART_URL = '/cart';

    public function setUp()
    {
        parent::setUp();
        $this->browse(function ($browser) {
            $browser->loginAs(User::find(1));
        });
    }

    /**
     * @group customer
     * @group index
     */
    public function testIndex()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/customers')
                ->assertSee('Customers display');
        });
    }

    /**
     * @group customer
     */
    public function testAddCustomer1()
    {
        $customer = Customer::find(1);

        $this->browse(function (Browser $browser) use ($customer) {
            $browser->visit(self::CUSTOMERS_URL)
                ->press('#add-customer-1')
                ->assertSee("The invoice will be issued to $customer->name")
                ->assertPathIs(self::CART_URL);
        });
    }
}
