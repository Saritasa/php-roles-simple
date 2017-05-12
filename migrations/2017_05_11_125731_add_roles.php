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
        Role::firstOrCreate(['name' => 'User', 'slug' => 'user']);
        Role::firstOrCreate(['name' => 'Admin', 'slug' => 'admin']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Role::whereSlug('user')->delete();
        Role::whereSlug('admin')->delete();
    }
}
