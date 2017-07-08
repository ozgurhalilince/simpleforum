<?php

namespace Ozgurince\Simpleforum\Seeds;

use Illuminate\Database\Seeder;
use Ozgurince\Simpleforum\Models\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = new Role;
        $role->id = 10;
        $role->name = "banned";
        $role->save();

        $role = new Role;
        $role->id = 30;
        $role->name = "member";
        $role->save();
/*
        $role = new Role;
        $role->id = 50;
        $role->name = "editor";
        $role->save();
*/
        $role = new Role;
        $role->id = 90;
        $role->name = "admin";
        $role->save();
    }
}
