<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Postingan extends Model
{
    use HasFactory;

    protected $table = 'postingans';

    protected $fillable = [
        'judul',
        'isi',
        'kategori_id',
        'website_id',
        'gambar',
        'status',
    ];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }

    public function desa()
    {
        return $this->belongsTo(Desa::class, 'desa_id');
    }

    public function website()
    {
        return $this->belongsTo(Website::class);
    }

    // Accessor untuk mendapatkan URL gambar yang benar
    public function getImageAttribute($value)
    {
        return url('images/' . $value); // Menggabungkan path dengan direktori 'images'
    }

    // Mutator untuk menyimpan hanya nama file gambar
    public function setImageAttribute($value)
    {
        $this->attributes['image'] = basename($value);
    }
}
