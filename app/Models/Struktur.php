<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Struktur extends Model
{
    use HasFactory;

    protected $fillable = [
        'gambar_struktur',
        'status'
    ];

    protected $casts = [
        'status' => 'boolean'
    ];

    /**
     * Get gambar struktur URL
     */
    public function getGambarStrukturUrlAttribute()
    {
        if ($this->gambar_struktur) {
            return asset('images/struktur/' . $this->gambar_struktur);
        }
        return asset('images/default-img.png');
    }

    /**
     * Scope untuk struktur aktif
     */
    public function scopeActive($query)
    {
        return $query->where('status', true);
    }

    /**
     * Scope untuk urutan
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('created_at', 'desc');
    }
}