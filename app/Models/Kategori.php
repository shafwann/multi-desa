<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class kategori extends Model
{
    use HasFactory;

    protected $table = 'kategoris';

    protected $fillable = [
        'nama',
        'website_id',
    ];

    public function postingan()
    {
        return $this->hasMany(postingan::class, 'kategori_id');
    }

    public function website()
    {
        return $this->belongsTo(Website::class);
    }
}
