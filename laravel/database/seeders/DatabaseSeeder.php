<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
//        \App\Models\User::factory(10)->create();

         \App\Models\User::factory()->create([
             'firstName' => 'Дмитрий',
             'middleName' => 'Сергеевич',
             'secondName' => 'Жевлаков',
             'number' => 1,
             'username' => 'admin',
             'password' => Hash::make('123456789'),
             'group' => 1,
             'grade' => null,
             'haveAccess' => true,
         ]);
    }
}
