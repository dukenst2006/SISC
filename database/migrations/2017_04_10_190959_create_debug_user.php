<?php

use App\Role;
use App\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateDebugUser extends Migration
{
    // TODO: delete this migration

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $email = 'debug@example.com';
        if (User::where('email', $email)->exists()) {
            return;
        }

        $debug1 = [
            'role_id'     => Role::getAdminId(),
            'first_name'  => 'DebugF',
            'middle_name' => 'DebugM',
            'last_name'   => 'DebugL',
            'email'       => 'debug@example.com',
            'password'    => bcrypt('stefano'),
            'active'      => true,
        ];

        $debug2 = [
            'role_id'     => Role::getSalespersonId(),
            'first_name'  => 'Sales',
            'middle_name' => null,
            'last_name'   => 'Salesperson',
            'email'       => 'sales@example.com',
            'password'    => bcrypt('asdasd'),
            'active'      => true,
        ];

        DB::table('users')->insert($debug1);
        DB::table('users')->insert($debug2);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
