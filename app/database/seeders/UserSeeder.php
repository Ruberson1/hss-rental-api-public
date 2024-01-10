<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'Admin',
                'email' => 'admin@britvic.com',
                'cpf' => '08765543033',
                'password' => app('hash')->make('britvic@teste')
            ],
        ];

        User::insert($users);
    }
}
