<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivityLog extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'action', 'details'];

    // Relationship: Ang log ay pagmamay-ari ng isang User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}