<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Pengajar extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nama_pengajar',
        'nip',
        'jabatan',
        'foto_pengajar',
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
     * Get the pengajar image URL
     */
    public function getFotoPengajarUrlAttribute()
    {
        if ($this->foto_pengajar) {
            return asset('images/guru/' . $this->foto_pengajar);
        }
        return asset('images/guru/default.jpg');
    }

    /**
     * Scope a query to only include active pengajar.
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
     * Get short jabatan (limit to 50 characters)
     */
    public function getJabatanPendekAttribute()
    {
        return Str::limit($this->jabatan, 50);
    }
}