<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $now = now();
        DB::table('users')->insert([
            [
                'name' => 'Admin Principal',
                'email' => 'admin@eatdrink.com',
                'password' => Hash::make('password'),
                'tel' => '0101010101',
                'role' => 'admin',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Jean Dupont',
                'email' => 'jean@boulangerie.com',
                'password' => Hash::make('password'),
                'tel' => '0601020304',
                'role' => 'entrepreneur_approuve',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Maria Rossi',
                'email' => 'maria@pizzabella.com',
                'password' => Hash::make('password'),
                'tel' => '0602030405',
                'role' => 'entrepreneur_approuve',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Karim Ben',
                'email' => 'karim@traiteur.com',
                'password' => Hash::make('password'),
                'tel' => '0603040506',
                'role' => 'entrepreneur_approuve',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Sophie Martin',
                'email' => 'sophie@choco.com',
                'password' => Hash::make('password'),
                'tel' => '0604050607',
                'role' => 'entrepreneur_approuve',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Li Wang',
                'email' => 'li@saveursasie.com',
                'password' => Hash::make('password'),
                'tel' => '0605060708',
                'role' => 'entrepreneur_en_attente',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Emma Green',
                'email' => 'emma@veganfresh.com',
                'password' => Hash::make('password'),
                'tel' => '0606070809',
                'role' => 'entrepreneur_en_attente',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Paul Fromage',
                'email' => 'paul@fromager.com',
                'password' => Hash::make('password'),
                'tel' => '0607080910',
                'role' => 'entrepreneur_en_attente',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Luc Boucher',
                'email' => 'luc@boucherie.com',
                'password' => Hash::make('password'),
                'tel' => '0608091011',
                'role' => 'entrepreneur_approuve',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Julie Sucre',
                'email' => 'julie@patisserie.com',
                'password' => Hash::make('password'),
                'tel' => '0609101112',
                'role' => 'entrepreneur_approuve',
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);
    }
}
