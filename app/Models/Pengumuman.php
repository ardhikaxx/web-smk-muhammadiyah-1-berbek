<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Pengumuman extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_pengumuman',
        'deskripsi_pengumuman',
        'foto_pengumuman',
        'status',
        'urutan'
    ];

    protected $casts = [
        'status' => 'boolean',
        'urutan' => 'integer'
    ];

    /**
     * Get foto pengumuman URL
     */
    public function getFotoPengumumanUrlAttribute()
    {
        if ($this->foto_pengumuman) {
            return asset('images/pengumuman/' . $this->foto_pengumuman);
        }
        return asset('images/default-img.png');
    }

    /**
     * Get deskripsi pendek
     */
    public function getDeskripsiPendekAttribute()
    {
        return Str::limit($this->deskripsi_pengumuman, 100);
    }

    /**
     * Scope untuk pengumuman aktif
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
        return $query->orderBy('urutan', 'desc')->orderBy('created_at', 'desc');
    }
}