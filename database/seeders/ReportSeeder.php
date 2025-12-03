<?php

namespace Database\Seeders;

use App\Models\Report;
use Illuminate\Database\Seeder;

class ReportSeeder extends Seeder
{
    /**
     * Seed the reports table with sample data.
     */
    public function run(): void
    {
        // Kita langsung perintahkan Factory untuk mencetak 15 laporan dummy
        // Factory akan otomatis mencari User yang ada.
        
        Report::factory()->count(15)->create();
        
        $this->command->info('ReportSeeder: Berhasil membuat 15 laporan dummy versi Sarpras.');
    }
}