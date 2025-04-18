<?php
// seeders/DetailPeriksaSeeder.php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DetailPeriksaSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('detail_periksas')->insert([
            [
                'id_periksa' => 1,
                'id_obat' => 2,
            ],
            [
                'id_periksa' => 1,
                'id_obat' => 3,
            ],
            [
                'id_periksa' => 2,
                'id_obat' => 1,
            ],
            [
                'id_periksa' => 3,
                'id_obat' => 2,
            ],
        ]);
    }
}
