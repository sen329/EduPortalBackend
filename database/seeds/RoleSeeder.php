<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
        
        $admin = Role::create(['name' => 'Admin']);
        $staff = Role::create(['name' => 'Staff']);
        $lecturer = Role::create(['name' => 'Lecturer']);
        $student = Role::create(['name' => 'Student']);

    }
}
