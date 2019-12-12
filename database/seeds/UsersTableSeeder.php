<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = \App\Role::where('name', 'superadmin')->first()->id;
        $user = \App\User::create(['name' => 'Super Admin', 'email' => 'm.monim@eveneer.xyz', 'phone' => '+8801822110448', 'password' => bcrypt('bangladesh'), 'nid' => 'some value', 'dob' => '1996-09-08']);
        $user->roles()->attach($role);
    }
}
