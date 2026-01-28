<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalPosyandu extends Model
{
    use HasFactory;
    protected $table = 'jadwal_posyandu';


    protected $fillable = [
        'tanggal',
        'waktu',
        'lokasi',
        'keterangan',
        'status'
    ];
}
