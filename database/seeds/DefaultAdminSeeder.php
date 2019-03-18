<?php

use Illuminate\Database\Seeder;
use Backpack\PermissionManager\app\Models\Role;
//use Spatie\Permission\Models\Role;
use App\User;

class DefaultAdminSeeder extends Seeder
{
    /**
     * Run the database seeds for default Admin.
     * email = admin@dd.com
     * password = secret
     *
     * @return void
     */

    public function run()
    {
        $user = new User();
        $user->name = 'superadmin';
        $user->email = 'admin@dd.com';
        $user->password = bcrypt('secret');
        $user->save();

        $role = new Role();
        $role->name = 'superadmin';
        $role->guard_name = 'backpack';
        $role->save();

        $user->assignRole($role);

        $role = new Role();
        $role->name = 'admin';
        $role->guard_name = 'backpack';
        $role->save();
    }
}
