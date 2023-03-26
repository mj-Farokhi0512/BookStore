<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;


class RoleAndPermissionSeeder extends Seeder
{

    public function run(): void
    {
        $roles = [
            ['name' => 'USER', 'guard_name' => 'web'],
            ['name' => 'MANAGER', 'guard_name' => 'web'],
            ['name' => 'ADMIN', 'guard_name' => 'web']
        ];

        Role::insert($roles);

        $permissions = [
            ['name' => 'create_user', 'guard_name' => 'web'],
            ['name' => 'read_user', 'guard_name' => 'web'],
            ['name' => 'delete_user', 'guard_name' => 'web'],
            ['name' => 'edit_user', 'guard_name' => 'web'],
            ['name' => 'create_book', 'guard_name' => 'web'],
            ['name' => 'read_book', 'guard_name' => 'web'],
            ['name' => 'delete_book', 'guard_name' => 'web'],
            ['name' => 'edit_book', 'guard_name' => 'web'],
            ['name' => 'create_category', 'guard_name' => 'web'],
            ['name' => 'read_category', 'guard_name' => 'web'],
            ['name' => 'delete_category', 'guard_name' => 'web'],
            ['name' => 'edit_category', 'guard_name' => 'web'],
            ['name' => 'create_tag', 'guard_name' => 'web'],
            ['name' => 'read_tag', 'guard_name' => 'web'],
            ['name' => 'delete_tag', 'guard_name' => 'web'],
            ['name' => 'edit_tag', 'guard_name' => 'web'],
            ['name' => 'add_to_cart', 'guard_name' => 'web'],
            ['name' => 'delete_in_cart', 'guard_name' => 'web'],
            ['name' => 'edit_in_cart', 'guard_name' => 'web'],
            ['name' => 'read_cart', 'guard_name' => 'web'],
            ['name' => 'read_carts', 'guard_name' => 'web'],
        ];

        Permission::insert($permissions);

        $user = Role::find(1);
        $manager = Role::find(2);
        $admin = Role::find(3);


        $user->givePermissionTo(['create_tag', 'create_tag', 'add_to_cart', 'delete_in_cart', 'edit_in_cart', 'read_cart']);
        $manager->givePermissionTo(['create_user', 'read_user', 'delete_user', 'edit_user', 'create_book', 'read_book', 'delete_book', 'edit_book', 'create_category', 'read_category', 'delete_category', 'edit_category', 'create_tag', 'read_tag', 'delete_tag', 'edit_tag', 'read_carts']);
        $admin->givePermissionTo(['create_book', 'read_book', 'delete_book', 'edit_book', 'create_category', 'read_category', 'delete_category', 'edit_category', 'create_tag', 'read_tag', 'delete_tag', 'edit_tag', 'read_carts']);
    }
}
