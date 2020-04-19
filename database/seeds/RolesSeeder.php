<?php

use Illuminate\Database\Seeder;
use Modules\Auth\Models\Role;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            ['name' => 'user', 'slug' => 'user'],
            ['name' => 'redactor', 'slug' => 'redactor'],
            ['name' => 'admin', 'slug' => 'admin'],
        ];

        foreach ($roles as $role) {
            Role::create([
                'name' => $role['name'],
                'slug' => $role['slug'],
            ]);
        }
    }
}
