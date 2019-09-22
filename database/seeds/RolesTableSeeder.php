<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            ['name' => 'superadmin', 'display_name' => 'Super Admin'],
            ['name' => 'admin', 'display_name' => 'Admin'],
            ['name' => 'staff', 'display_name' => 'Staff'],
            ['name' => 'user', 'display_name' => 'User'],
            ['name' => 'user', 'display_name' => 'Sole Proprietor'],
            ['name' => 'user', 'display_name' => 'Private Limited'],
            ['name' => 'user', 'display_name' => 'Limited Liability'],
            ['name' => 'user', 'display_name' => 'Public Limited'],
        ];

        foreach ($roles as $role) {
            \App\Role::create($role);
        }
    }
}
