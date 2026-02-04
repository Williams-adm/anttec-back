<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::create([
            'name' => 'Jhonny Stevens',
            'last_name' => 'Romero Linares',
            'email' => 'prueba@gmail.com',
            'password' => Hash::make('12345678'),
        ]);

        $employee = $user->employee()->create([
            'salary' => '1500.00',
            'position' => 'admin',
            'branch_id' => 1,
        ]);

        $employee->documentNumber()->create([
            'number' => '12345678',
            'document_type_id' => 1
        ]);
    }
}
