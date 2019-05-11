<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;


class PermissionRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::create(["name"=>'create country']);
        Permission::create(["name"=>'edit country']);
        Permission::create(["name"=>'view country']);
        Permission::create(["name"=>'delete country']);

        Permission::create(["name"=>'create state']);
        Permission::create(["name"=>'edit state']);
        Permission::create(["name"=>'view state']);
        Permission::create(["name"=>'delete state']);

        Permission::create(["name"=>'create district']);
        Permission::create(["name"=>'edit district']);
        Permission::create(["name"=>'view district']);
        Permission::create(["name"=>'delete district']);

        Permission::create(["name"=>'create post']);
        Permission::create(["name"=>'edit post']);
        Permission::create(["name"=>'view post']);
        Permission::create(["name"=>'delete post']);

        Permission::create(["name"=>'create categories']);
        Permission::create(["name"=>'edit categories']);
        Permission::create(["name"=>'view categories']);
        Permission::create(["name"=>'delete categories']);

        Permission::create(["name"=>'create gallery']);
        Permission::create(["name"=>'edit gallery']);
        Permission::create(["name"=>'view gallery']);
        Permission::create(["name"=>'delete gallery']);

        Permission::create(["name"=>'create user']);
        Permission::create(["name"=>'edit user']);
        Permission::create(["name"=>'view user']);
        Permission::create(["name"=>'delete user']);

        Permission::create(["name"=>'create role']);
        Permission::create(["name"=>'edit role']);
        Permission::create(["name"=>'view role']);

        Permission::create(["name"=>'create event']);
        Permission::create(["name"=>'edit event']);
        Permission::create(["name"=>'view event']);
        Permission::create(["name"=>'delete event']);


        $role = Role::create(["name"=>'Super Admin']);
        $role->givePermissionTo(Permission::all());

        $role = Role::create(["name"=>'Editor']);
        $role-> givePermissionTo(['edit post','edit gallery','edit categories','view post','view gallery','view categories']);

        $role = Role::create(["name"=>'Creator']);
        $role-> givePermissionTo(['edit post','edit gallery','edit categories','create post','create gallery','create categories','view post','view gallery','view categories']);
    }
}
