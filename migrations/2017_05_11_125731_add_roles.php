<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Saritasa\Roles\Models\Role;

class AddRoles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Role::firstOrCreate(['name' => 'User']);
        Role::firstOrCreate(['name' => 'Admin']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Role::whereName('User')->delete();
        Role::whereName('Admin')->delete();
    }
}
