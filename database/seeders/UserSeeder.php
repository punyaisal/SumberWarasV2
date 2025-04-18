<?php
// seeders/UserSeeder.php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('user')->insert([
            [
                'name' => 'Admin Sumber Waras',
                'alamat' => 'Jl. Kesehatan No.1',
                'no_hp' => '08123456789',
                'email' => 'admin@sumberwaras.com',
                'role' => 'admin',
                'password' => Hash::make('password123'),
            ],
            [
                'name' => 'Dr. Andi',
                'alamat' => 'Jl. Medis No.2',
                'no_hp' => '08129876543',
                'email' => 'andi@sumberwaras.com',
                'role' => 'dokter',
                'password' => Hash::make('password123'),
            ],
            [
                'name' => 'Budi Pasien',
                'alamat' => 'Jl. Sehat No.3',
                'no_hp' => '081212341234',
                'email' => 'budi@sumberwaras.com',
                'role' => 'pasien',
                'password' => Hash::make('password123'),
            ],
        ]);
    }
}
