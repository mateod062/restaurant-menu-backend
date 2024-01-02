<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {

            User::factory()->create([
                'name' => 'Test User 2',
                'email' => 'email@test.com',
                'password' => bcrypt('password'),
            ]);
    }
}
