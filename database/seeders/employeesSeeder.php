<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class employeesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('test_table')->insert([
            'fullName'=>Str::random(10),
            'address'=>Str::random(10),
            'email'=>Str::random(10)."@gmail.com",
        ]);
    }
}
