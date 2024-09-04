<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Entities\User;
use App\Entities\Instituition;
use App\Entities\Group;
use App\Entities\Product;
use App\Entities\Moviment;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Criar instituições
        $instituition1 = Instituition::create([
            'name' => 'Instituição A'
        ]);

        $instituition2 = Instituition::create([
            'name' => 'Instituição B'
        ]);

        $instituition3 = Instituition::create([
            'name' => 'Instituição C'
        ]);

        // Criar usuários
        $user1 = User::create([
            'cpf'           => '11122233345',
            'name'          => 'Admin',
            'phone'         => '34999897922',
            'birth'         => '2024-09-03',
            'gender'        => 'M',
            'email'         => 'admin@gmail.com',
            'password'      => bcrypt('admin123'),
            'status'        => 'active',
            'permission'    => 'app.user'
        ]);

        $user2 = User::create([
            'cpf'           => '22233344456',
            'name'          => 'Jane Doe',
            'phone'         => '34999898877',
            'birth'         => '1990-01-01',
            'gender'        => 'F',
            'email'         => 'jane.doe@example.com',
            'password'      => bcrypt('jane123'),
            'status'        => 'active',
            'permission'    => 'app.user'
        ]);

        $user3 = User::create([
            'cpf'           => '33344455567',
            'name'          => 'John Smith',
            'phone'         => '34999897766',
            'birth'         => '1985-05-15',
            'gender'        => 'M',
            'email'         => 'john.smith@example.com',
            'password'      => bcrypt('john123'),
            'status'        => 'active',
            'permission'    => 'app.user'
        ]);

        // Criar grupos
        $group1 = Group::create([
            'name'          => 'Group A',
            'user_id'       => $user1->id,
            'instituition_id' => $instituition1->id
        ]);

        $group2 = Group::create([
            'name'          => 'Group B',
            'user_id'       => $user2->id,
            'instituition_id' => $instituition2->id
        ]);

        $group3 = Group::create([
            'name'          => 'Group C',
            'user_id'       => $user3->id,
            'instituition_id' => $instituition3->id
        ]);

        // Criar produtos
        $product1 = Product::create([
            'name'          => 'Product X',
            'description'   => 'Description for Product X',
            'index'         => '001',
            'interest_rate' => 5.0,
            'instituition_id' => $instituition1->id
        ]);

        $product2 = Product::create([
            'name'          => 'Product Y',
            'description'   => 'Description for Product Y',
            'index'         => '002',
            'interest_rate' => 3.5,
            'instituition_id' => $instituition2->id
        ]);

        $product3 = Product::create([
            'name'          => 'Product Z',
            'description'   => 'Description for Product Z',
            'index'         => '003',
            'interest_rate' => 4.2,
            'instituition_id' => $instituition3->id
        ]);

        // Criar movimentações
        Moviment::create([
            'user_id'       => $user1->id,
            'group_id'      => $group1->id,
            'product_id'    => $product1->id,
            'value'         => 1000.00,
            'type'          => 1 // application
        ]);

        Moviment::create([
            'user_id'       => $user2->id,
            'group_id'      => $group2->id,
            'product_id'    => $product2->id,
            'value'         => 500.00,
            'type'          => 2 // outflow
        ]);

        Moviment::create([
            'user_id'       => $user3->id,
            'group_id'      => $group3->id,
            'product_id'    => $product3->id,
            'value'         => 750.00,
            'type'          => 1 // application
        ]);

        Moviment::create([
            'user_id'       => $user1->id,
            'group_id'      => $group1->id,
            'product_id'    => $product2->id,
            'value'         => 1200.00,
            'type'          => 2 // outflow
        ]);

        Moviment::create([
            'user_id'       => $user2->id,
            'group_id'      => $group2->id,
            'product_id'    => $product3->id,
            'value'         => 300.00,
            'type'          => 1 // application
        ]);
    }
}
