<?php

use Illuminate\Database\Seeder;
use Backpack\PermissionManager\app\Models\Role;
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
        $user->name = 'admin';
        $user->email = 'admin@dd.com';
        $user->password = bcrypt('secret');
        $user->save();

       $role = Role::create(['name' => 'admin']);
       Role::create(['name' => 'creator']);
       $user->assignRole($role);
    }
}
