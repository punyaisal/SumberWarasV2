<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PeriksaSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('periksa')->insert([
            [
                'id_pasien' => 1,
                'id_dokter' => 2,
                'tgl_periksa' => Carbon::now(),
                'catatan' => 'Pasien mengalami demam ringan',
                'biaya_periksa' => 50000,
            ],
            [
                'id_pasien' => 2,
                'id_dokter' => 3,
                'tgl_periksa' => Carbon::now()->subDays(2),
                'catatan' => 'Keluhan sakit kepala dan pusing',
                'biaya_periksa' => 60000,
            ],
            [
                'id_pasien' => 3,
                'id_dokter' => 1,
                'tgl_periksa' => Carbon::now()->subDays(5),
                'catatan' => 'Pasien mengalami batuk dan pilek',
                'biaya_periksa' => 55000,
            ],
        ]);
    }
}
