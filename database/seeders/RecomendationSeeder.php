<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RecomendationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $recomendations = [
            [
                'title' => 'Luangkan waktu 10 menit setiap hari untuk meditasi',
                'source' => 'system',
                'related_journal_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Konsultasikan masalahmu kepada psikolog jika sudah mengganggu aktivitas harian',
                'source' => 'professional',
                'related_journal_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Berolahraga ringan setidaknya 3x seminggu',
                'source' => 'ai',
                'related_journal_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        foreach ($recomendations as $recomendation) {
            DB::table('recomendations')->insert($recomendation);
        }
    }
}
