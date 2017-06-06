<?php

namespace Tests\Feature\Unit;

use App\Invoice;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class InvoiceDatabaseTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * Invoice creation.
     *
     * @return void
     */
    public function testCreateInvoice()
    {
        // Workaround because of
        // https://github.com/jenssegers/laravel-mongodb/issues/1191
        $invoice = factory(Invoice::class)->make();
        $invoice->save();

        $this->assertFalse(is_null($invoice));
    }

    /**
     * Delete the new invoice.
     */
    public function testRemoveInvoice()
    {
        $invoice = Invoice::all()->first();
        $this->assertTrue($invoice->delete());
    }
}
