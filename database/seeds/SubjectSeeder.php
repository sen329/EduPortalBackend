<?php

use Illuminate\Database\Seeder;
use App\Subjects;

class SubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $math = Subjects::create([
            'name' => 'Math',
            'description' => 'Math Iorem Ipsum',
            'price' => '200000',
        ]);

        $science = Subjects::create([
            'name' => 'Science',
            'description' => 'Science Iorem Ipsum',
            'price' => '200000',
        ]);

        $business = Subjects::create([
            'name' => 'Business',
            'description' => 'Business Iorem Ipsum',
            'price' => '200000',
        ]);
    }
}
