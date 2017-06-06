<?php

namespace Tests\Feature\Unit;

use App\Product;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class ProductDatabaseTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * Product creation.
     *
     * @return void
     */
    public function testCreateProduct()
    {
        $product = factory(Product::class)->create();
        $this->assertFalse(is_null($product));
    }

    /**
     * Delete the new product.
     */
    public function testRemoveUser()
    {
        $product = Product::all()->first();
        $this->assertTrue($product->delete());
    }

    /**
     * Check that the returned obj is an instance of Eloquent/Collection.
     */
    public function testCollectionInstance()
    {
        $products = Product::all();
        $this->assertTrue($products instanceof Collection);
    }
}
