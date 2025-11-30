<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Report>
 */
class ReportFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // 1. Ambil User acak, atau buat baru jika kosong
        $user = User::inRandomOrder()->first() ?? User::factory()->create();

        // 2. Tentukan Tipe Aset & Laporan secara acak
        $assetType = fake()->randomElement(['Sarana', 'Prasarana']);
        $reportType = fake()->randomElement(['Kerusakan', 'Komplain', 'Saran Pembaharuan']);

        // 3. Generate Nama Objek yang relevan (Pura-pura pintar)
        $objects = [
            'AC Daikin Ruang 101', 
            'Kursi Dosen Lab TRK', 
            'Proyektor Aula', 
            'Kabel LAN Lab Jaringan', 
            'Pintu Toilet Lt. 2', 
            'Wastafel Koridor'
        ];

        return [
            'user_id' => $user->id,
            'asset_type' => $assetType,
            'report_type' => $reportType,
            'object_name' => fake()->randomElement($objects),
            'location' => 'Gedung ' . fake()->randomElement(['A', 'B', 'C']) . ' Lantai ' . fake()->numberBetween(1, 3),
            'quantity' => 1,
            'description' => fake()->paragraph(),
            'status' => fake()->randomElement(['pending', 'approved', 'rejected']),
            'photo_path' => null, // Default null dulu
        ];
    }
}