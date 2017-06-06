<?php

namespace Tests\Browser;

use App\Product;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class ProductTest extends DuskTestCase
{
    const PRODUCTS_URL = '/products';

    public function setUp()
    {
        parent::setUp();
        $this->browse(function ($browser) {
            $browser->loginAs(User::find(1));
        });
    }

    /**
     * @group product
     * @group index
     */
    public function testIndex()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/products')
                ->assertSee('Products display');
        });
    }

    /**
     * @group product
     */
    public function testAddProduct1()
    {
        $product = Product::find(1);
        $product->update(['quantity', 50]);
        $product->save();

        $this->browse(function (Browser $browser) use ($product) {
            $browser->visit(self::PRODUCTS_URL)
                ->visit("/cart/add/$product->id/1")
                ->assertSee('The product has been added to your invoice')
                ->assertPathIs(self::PRODUCTS_URL);
        });
    }

    /**
     * @group product
     */
    public function testAddProduct2()
    {
        $product = Product::find(1);
        $product->update(['quantity', 50]);
        $product->save();

        $this->browse(function (Browser $browser) use ($product) {
            $browser->visit(self::PRODUCTS_URL)
                ->visit("/cart/add/$product->id/49")
                ->assertSee('The product has been added to your invoice')
                ->assertPathIs(self::PRODUCTS_URL);
        });
    }

    /**
     * @group product
     */
    public function testAddProduct3()
    {
        $product = Product::find(1);
        $product->update(['quantity', 50]);
        $product->save();

        $this->browse(function (Browser $browser) use ($product) {
            $browser->visit(self::PRODUCTS_URL)
                ->visit("/cart/add/$product->id/50")
                ->assertSee('The product has been added to your invoice')
                ->assertPathIs(self::PRODUCTS_URL);
        });
    }

    /**
     * @group product
     */
    public function testAddProduct4()
    {
        $product = factory(Product::class)->create([
           'quantity' => 0,
        ]);

        $this->browse(function (Browser $browser) use ($product) {
            $browser->visit(self::PRODUCTS_URL)
                ->visit("/cart/add/$product->id/50")
                ->assertSee('not available')
                ->assertPathIs(self::PRODUCTS_URL);
        });
    }

    /**
     * @group product
     */
    public function testAddProduct5()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit(self::PRODUCTS_URL)
                ->visit('/cart/add/55555555555/50')
                ->assertSee('not exist')
                ->assertPathIs(self::PRODUCTS_URL);
        });
    }
}
