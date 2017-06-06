<?php

namespace Tests\Browser;

use App\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class LoginTest extends DuskTestCase
{
    use DatabaseTransactions;

    private $dashboardURL = '/user/dashboard';

    /**
     * @group index
     */
    public function testIndex()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/login')
                ->assertSee('Employee login');
        });
    }

    /**
     * @group bad-login
     */
    public function testInvalidLogin()
    {
        $user = factory(User::class)->make();

        $this->browse(function ($browser) use ($user) {
            $browser->visit('/login')
                ->type('email', $user->email)
                ->type('password', 'randomWrongPassword')
                ->press('Login')
                ->assertPathIs('/login')
                ->assertSee('do not match our records');
        });
    }

    /**
     * @group valid-login
     */
    public function testValidLogin()
    {
        $user = User::find(1);

        $this->browse(function ($browser) use ($user) {
            $browser->loginAs($user)
                ->visit($this->dashboardURL)
                ->assertPathIs($this->dashboardURL);
        });
    }
}
