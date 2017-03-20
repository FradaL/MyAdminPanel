<?php

namespace Modules\Users\Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
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

        DB::table('user_has_roles')->insert([
            'role_id' => 1,
            'user_id' => 1,
        ]);

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

        $role = Role::find(1);
        $role->givePermissionTo(['view-users', 'view-roles', 'view-permissions']);
        // $this->call("OthersTableSeeder");
    }
}
