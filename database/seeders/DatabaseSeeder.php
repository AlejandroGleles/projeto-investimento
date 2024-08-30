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
            'cpf'           =>'1232123123',
            'name'          =>'Alejandro',
            'phone'         =>'34234234',
            'birth'         =>'1998-05-26',
            'gender'        =>'M',
            'email'         =>'Alejandro.g.leles@gmail.com',
            'password'      => bcrypt('123456'),
        ]);
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
