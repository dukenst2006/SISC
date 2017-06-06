<?php

namespace Tests\Feature\Unit;

use App\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class UserDatabaseTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * User creation.
     *
     * @return void
     */
    public function testCreateUser()
    {
        $user = factory(User::class)->create();
        $this->assertFalse(is_null($user));
    }

    /**
     * Delete the new user.
     */
    public function testRemoveUser()
    {
        $user = User::all()->first();
        $this->assertTrue($user->delete());
    }
}
