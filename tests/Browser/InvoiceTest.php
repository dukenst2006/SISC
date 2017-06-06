<?php

namespace Tests\Browser;

use App\User;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class InvoiceTest extends DuskTestCase
{
    const CART_URL = '/cart';
    const PRODUCTS_URL = '/products';
    const CUSTOMERS_URL = '/customers';

    public function setUp()
    {
        parent::setUp();
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(1));

            $browser->visit(self::PRODUCTS_URL)
                ->press('#add-product-1')
                ->assertSee('The product has been added to your invoice')
                ->assertPathIs(self::PRODUCTS_URL);

            $browser->visit(self::CUSTOMERS_URL)
                ->press('#add-customer-1')
                ->assertSee('The invoice will be issued to')
                ->assertPathIs(self::CART_URL);
        });
    }

    /**
     * @group index
     */
    public function testIndex()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit(self::CART_URL)
                ->assertSee('Invoice information');
        });
    }

    /**
     * @group invoice
     */
    public function testValidGenerate()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit(self::CART_URL)
                ->type('shipping_method', 'Royal Mail')
                ->type('payment_terms', 'By cash')
                ->keys('#due_date', '22042017')
                ->keys('#delivery_date', '04052017')
                ->press('Create invoice')
                ->assertSee('Your invoice has been created');
        });
    }

    public function testValidUpdate()
    {

    }

    public function testInvalidUpdate()
    {

    }

    /**
     * @group invoice
     */
    public function testInvalidCreate1()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit(self::CART_URL)
                ->type('shipping_method', 'Royal Mail')
                ->type('payment_terms', 'By cash')
                ->keys('#due_date', '22042017')
                ->press('Create invoice')
                ->assertSee('field is required');
        });
    }

    /**
     * @group invoice
     */
    public function testInvalidCreate2()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit(self::CART_URL)
                ->type('shipping_method', 'Royal Mail')
                ->keys('#due_date', '22042017')
                ->press('Create invoice')
                ->assertSee('field is required');
        });
    }
}
