<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Jurusan extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nama_jurusan',
        'deskripsi_jurusan',
        'kode_jurusan',
        'status',
        'urutan',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'status' => 'boolean',
        'urutan' => 'integer',
    ];

    /**
     * Scope a query to only include active jurusan.
     */
    public function scopeActive($query)
    {
        return $query->where('status', true);
    }

    /**
     * Scope a query to order by urutan.
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('urutan')->orderBy('created_at', 'desc');
    }

    /**
     * Get short description (limit to 150 characters)
     */
    public function getDeskripsiPendekAttribute()
    {
        return Str::limit($this->deskripsi_jurusan, 150);
    }

    /**
     * Get formatted kode jurusan
     */
    public function getKodeFormattedAttribute()
    {
        return strtoupper($this->kode_jurusan);
    }
}