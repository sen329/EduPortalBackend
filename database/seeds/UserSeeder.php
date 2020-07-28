<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\User;
use Spatie\Permission\Models\Role;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();

        $admin =  User::create([
            'name' => 'Admin User',
            'email' => 'admin@email.com',
            'address' => 'Earth',
            'phone_number' => '4628473',
            'password' => Hash::make('password')
        ]);

        $staff = User::create([
            'name' => 'Staff User',
            'email' => 'staff@email.com',
            'address' => 'Earth',
            'phone_number' => '46793138',
            'password' => Hash::make('password')
        ]);

        $math1lecturer = User::create([
            'name' => 'math1 User',
            'email' => 'math1@email.com',
            'address' => 'Earth',
            'phone_number' => '42351234',
            'password' => Hash::make('password')
        ]);

        $math2lecturer = User::create([
            'name' => 'math2 User',
            'email' => 'math2@email.com',
            'address' => 'Earth',
            'phone_number' => '46424324',
            'password' => Hash::make('password')
        ]);

        $science1lecturer = User::create([
            'name' => 'science1 User',
            'email' => 'science1@email.com',
            'address' => 'Earth',
            'phone_number' => '41232323',
            'password' => Hash::make('password')
        ]);

        $science2lecturer = User::create([
            'name' => 'science2 User',
            'email' => 'science2@email.com',
            'address' => 'Earth',
            'phone_number' => '47656203',
            'password' => Hash::make('password')
        ]);

        $business1lecturer = User::create([
            'name' => 'business1 User',
            'email' => 'business1@email.com',
            'address' => 'Earth',
            'phone_number' => '4722103',
            'password' => Hash::make('password')
        ]);

        $business2lecturer = User::create([
            'name' => 'business 2',
            'email' => 'business2@email.com',
            'address' => 'Earth',
            'phone_number' => '47345303',
            'password' => Hash::make('password')
        ]);

        $student1 = User::create([
            'name' => 'student 1',
            'email' => 'student1@email.com',
            'address' => 'Earth',
            'phone_number' => '4235142',
            'password' => Hash::make('password')
        ]);

        $student2 = User::create([
            'name' => 'student 2',
            'email' => 'student2@email.com',
            'address' => 'Earth',
            'phone_number' => '1231303',
            'password' => Hash::make('password')
        ]);

        $student3 = User::create([
            'name' => 'student 3',
            'email' => 'student3@email.com',
            'address' => 'Earth',
            'phone_number' => '4231103',
            'password' => Hash::make('password')
        ]);

        $student1->assignRole('Student');
        $student2->assignRole('Student');
        $student3->assignRole('Student');
        
        $admin->assignRole('Admin');
        $staff->assignRole('Staff');
        $math1lecturer->assignRole('Lecturer');
        $math2lecturer->assignRole('Lecturer');
        $science1lecturer->assignRole('Lecturer');
        $science2lecturer->assignRole('Lecturer');
        $business1lecturer->assignRole('Lecturer');
        $business2lecturer->assignRole('Lecturer');

        $math1lecturer->subject()->attach(1);
        $math2lecturer->subject()->attach(1);
        $science1lecturer->subject()->attach(2);
        $science2lecturer->subject()->attach(2);
        $business1lecturer->subject()->attach(3);
        $business2lecturer->subject()->attach(3);
    }
}
