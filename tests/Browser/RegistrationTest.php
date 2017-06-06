<?php

namespace Tests\Browser;

use Faker\Factory as Faker;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class RegistrationTest extends DuskTestCase
{
    /** The registration page URL */
    const REGISTER_URL = '/register';
    const DASHBOARD_URL = '/user/dashboard';
    const LOGIN_URL = '/login';

    /** @var Faker $faker faker instance */
    protected $faker;

    public function setUp()
    {
        parent::setUp();
        $this->faker = Faker::create();
    }

    /**
     * Access the registration page.
     *
     * @group index
     */
    public function testIndex()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit(self::REGISTER_URL)
                ->assertSee('Employee registration');
        });
    }

    /**
     * @group bad-registration
     */
    public function testBadRegistration1()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit(self::REGISTER_URL)
                ->type('first_name', $this->faker->firstName)
                ->type('email', $this->faker->email)
                ->press('Register')
                ->assertPathIs(self::REGISTER_URL);
        });
    }

    /**
     * @group bad-registration
     */
    public function testBadRegistration2()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit(self::REGISTER_URL)
                ->type('first_name', $this->faker->firstName)
                ->type('last_name', $this->faker->lastName)
                ->type('email', $this->faker->email)
                ->press('Register')
                ->assertPathIs(self::REGISTER_URL);
        });
    }

    /**
     * @group bad-registration
     */
    public function testBadRegistration3()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit(self::REGISTER_URL)
                ->type('first_name', $this->faker->firstName)
                ->type('last_name', $this->faker->lastName)
                ->type('email', $this->faker->email)
                ->type('password', $this->faker->password)
                ->press('Register')
                ->assertPathIs(self::REGISTER_URL);
        });
    }

    /**
     * @group bad-registration
     */
    public function testBadRegistration4()
    {
        $password = '1234';

        $this->browse(function (Browser $browser) use ($password) {
            $browser->visit(self::REGISTER_URL)
                ->type('first_name', $this->faker->firstName)
                ->type('last_name', $this->faker->lastName)
                ->type('email', $this->faker->email)
                ->type('password', $password)
                ->type('password_confirmation', $password)
                ->press('Register')
                ->assertPathIs(self::REGISTER_URL);
        });
    }

    /**
     * @group bad-registration
     */
    public function testBadRegistration5()
    {
        $password = $this->faker->password;

        $this->browse(function (Browser $browser) use ($password) {
            $browser->visit(self::REGISTER_URL)
                ->type('first_name', str_pad('', 256, '#'))
                ->type('last_name', $this->faker->lastName)
                ->type('email', $this->faker->email)
                ->type('password', $password)
                ->type('password_confirmation', $password)
                ->press('Register')
                ->assertPathIs(self::REGISTER_URL);
        });
    }

    /**
     * @group valid-registration
     */
    public function testValidRegistration1()
    {
        $password = $this->faker->password;

        $this->browse(function (Browser $browser) use ($password) {
            $browser->visit(self::REGISTER_URL)
                ->type('first_name', $this->faker->firstName)
                ->type('last_name', $this->faker->lastName)
                ->type('email', $this->faker->email)
                ->type('password', $password)
                ->type('password_confirmation', $password)
                ->press('Register')
                ->assertPathIs(self::DASHBOARD_URL)
                ->assertAuthenticated()
                ->logout()
                ->assertGuest();
        });
    }

    /**
     * @group valid-registration
     */
    public function testValidRegistration2()
    {
        $password = $this->faker->password;

        $this->browse(function (Browser $browser) use ($password) {
            $browser->visit(self::REGISTER_URL)
                ->type('first_name', $this->faker->firstName)
                ->type('middle_name', $this->faker->firstName)
                ->type('last_name', $this->faker->lastName)
                ->type('email', $this->faker->email)
                ->type('password', $password)
                ->type('password_confirmation', $password)
                ->press('Register')
                ->assertPathIs(self::DASHBOARD_URL)
                ->assertAuthenticated()
                ->logout()
                ->assertGuest();
        });
    }

    /**
     * @group valid-registration
     */
    public function testValidRegistration3()
    {
        $password = $this->faker->password;

        $this->browse(function (Browser $browser) use ($password) {
            $browser->visit(self::REGISTER_URL)
                ->type('first_name', str_pad('', 255, 'debug#'))
                ->type('middle_name', $this->faker->firstName)
                ->type('last_name', $this->faker->lastName)
                ->type('email', $this->faker->email)
                ->type('password', $password)
                ->type('password_confirmation', $password)
                ->press('Register')
                ->assertPathIs(self::DASHBOARD_URL)
                ->assertAuthenticated()
                ->logout()
                ->assertGuest();
        });
    }
}
