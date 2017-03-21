<?php

namespace Modules\Users\Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Modules\Users\Entities\User;
use Spatie\Permission\Models\Role;



class UserDemoSeederTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Usuario Administrador',
            'username' => 'Demo',
            'email' => 'demo@myadminpanel.com',
            'password' => bcrypt('secret'),
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);


        $user = User::find(1);
        $user->assignRole('Admin');

        DB::table('permissions')->insert([
            'name' => 'view-users',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('permissions')->insert([
            'name' => 'view-roles',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('permissions')->insert([
            'name' => 'view-permissions',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        $role = Role::findByName('Admin');

        $permissions = ['view-users', 'view-roles', 'view-permissions'];

        $role->givePermissionTo($permissions);

        // $this->call("OthersTableSeeder");
    }
}
