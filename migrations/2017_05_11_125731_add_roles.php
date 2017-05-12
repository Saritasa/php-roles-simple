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
        Role::firstOrCreate(['name' => 'Admin']);
        Role::firstOrCreate(['name' => 'User']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Role::whereName('Admin')->delete();
        Role::whereName('User')->delete();
    }
}
