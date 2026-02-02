<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArtikelKesehatan extends Model
{
    use HasFactory;
    protected $table = 'artikel_kesehatan';
    protected $guarded = ['id'];
    protected $casts = [
        'published_at' => 'datetime',
    ];
}
