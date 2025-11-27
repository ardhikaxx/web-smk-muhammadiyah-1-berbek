<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Gallery extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nama_gallery',
        'deskripsi_gallery',
        'foto_gallery',
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
     * Get the gallery image URL
     */
    public function getFotoGalleryUrlAttribute()
    {
        return asset('images/gallery/' . $this->foto_gallery);
    }

    /**
     * Scope a query to only include active galleries.
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
        return Str::limit($this->deskripsi_gallery, 150);
    }
}