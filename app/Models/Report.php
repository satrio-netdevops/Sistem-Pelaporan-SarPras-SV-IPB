<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids; // Pastikan ini ada karena kamu pakai UUID

class Report extends Model
{
    use HasFactory, HasUuids; // Tambahkan HasUuids agar ID otomatis terisi

    // INI YANG MENYEBABKAN ERROR TADI
    // Kita harus mendaftarkan semua kolom yang boleh diisi user
    protected $fillable = [
        'user_id',
        'asset_type',   // <-- Tadi error karena ini belum ada
        'report_type',
        'object_name',
        'location',
        'quantity',
        'description',
        'photo_path',
        'status',
    ];

    // Relasi ke User (Pelapor)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    // Hapus relasi product() dan category() jika masih ada, karena sudah tidak dipakai
}