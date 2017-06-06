<?php

namespace Tests\Browser;

use App\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class ResetPasswordTest extends DuskTestCase
{
    use DatabaseTransactions;

    private $resetPasswordURL = '/password/reset';

    /**
     * @group index
     */
    public function testIndex()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit($this->resetPasswordURL)
                ->assertSee('Employee login');
        });
    }

    /**
     * @group reset-password
     */
    public function testResetPassword1()
    {

    }

    /**
     * @group reset-password
     */
    public function testResetPassword2()
    {

    }
}
