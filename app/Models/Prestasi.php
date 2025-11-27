<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prestasi extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_siswa',
        'jurusan',
        'nama_prestasi',
        'peringkat',
        'tahun_prestasi',
        'foto_prestasi',
        'status',
        'urutan'
    ];

    protected $casts = [
        'status' => 'boolean',
        'tahun_prestasi' => 'integer',
        'urutan' => 'integer'
    ];

    /**
     * Get foto prestasi URL
     */
    public function getFotoPrestasiUrlAttribute()
    {
        if ($this->foto_prestasi) {
            return asset('images/prestasi/' . $this->foto_prestasi);
        }
        return asset('images/prestasi/default.jpg');
    }

    /**
     * Scope untuk prestasi aktif
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