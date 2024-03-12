<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Filipe',
            'username' =>'admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('banana'),
            'is_admin' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('users')->insert([
            'name' => 'Carlos',
            'username' =>'senior',
            'email' => 'carlos@gmail.com',
            'password' => Hash::make('password'),
            'is_admin' => 0,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('users')->insert([
            'name' => 'Pedro',
            'username' =>'senior2',
            'email' => 'pedro@gmail.com',
            'password' => Hash::make('password'),
            'is_admin' => 0,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('users')->insert([
            'name' => 'Bruno',
            'username' =>'senior3',
            'email' => 'bruno@gmail.com',
            'password' => Hash::make('password'),
            'is_admin' => 0,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('users')->insert([
            'name' => 'Diogo',
            'username' =>'estagiario1',
            'email' => 'diogo@gmail.com',
            'password' => Hash::make('password'),
            'is_admin' => 0,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('users')->insert([
            'name' => 'Ana',
            'username' =>'estagiaria2',
            'email' => 'ana@gmail.com',
            'password' => Hash::make('password'),
            'is_admin' => 0,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('users')->insert([
            'name' => 'Joana',
            'username' =>'estagiaria3',
            'email' => 'joana@gmail.com',
            'password' => Hash::make('password'),
            'is_admin' => 0,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
