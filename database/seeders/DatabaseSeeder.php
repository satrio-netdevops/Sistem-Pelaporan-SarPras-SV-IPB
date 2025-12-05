<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Report;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // ====================================================
        // 1. MASTER DATA (WAJIB ADA DI PRODUCTION & LOCAL)
        // ====================================================
        
        // Buat Akun Admin (Hanya jika belum ada)
        if (!User::where('email', 'admin@ipb.ac.id')->exists()) {
            User::create([
                'name' => 'Administrator',
                'email' => 'admin@ipb.ac.id',
                'password' => bcrypt('password123'),
                'role' => 'admin',
            ]);
        }

        // ====================================================
        // 2. DUMMY DATA (HANYA UNTUK LOCAL / LAPTOP KAMU)
        // ====================================================
        
        // Cek: Apakah aplikasi sedang berjalan di mode 'local'?
        // Mode ini diatur di file .env (APP_ENV=local vs APP_ENV=production)
        if (app()->environment('local')) {

            // Panggil UserSeeder untuk custom users
            $this->call([
                UserSeeder::class,
            ]);

            // Buat User Staff Palsu
            User::factory(5)->create();

            // Panggil ReportSeeder (yang isinya factory laporan palsu)
            $this->call([
                ReportSeeder::class,
            ]);

            $this->command->info('Data Dummy berhasil dibuat (Mode Local).');
        } else {
            $this->command->warn('Mode Production terdeteksi. Data Dummy tidak dibuat demi keamanan.');
        }
    }
}