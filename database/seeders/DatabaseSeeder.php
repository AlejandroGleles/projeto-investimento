<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Entities\User;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        User::create([
            'cpf'           =>'11122233345',
            'name'          =>'Admin',
            'phone'         =>'34999897922',
            'birth'         =>'2024-09-03',
            'gender'        =>'M',
            'email'         =>'Admin@gmail.com',
            'password'      => bcrypt('admin123'),
        ]);
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
