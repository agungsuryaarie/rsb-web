<?php

namespace Database\Seeders;

use App\Models\UserPublic;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsersPublicSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        UserPublic::create([
            'name'    => "Abii Hutabarat",
            'email'    => 'abiihutabarat@gmail.com',
            'nohp'    => '082274884828',
            'password'    => bcrypt('12345678'),
        ]);
    }
}
