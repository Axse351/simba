<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KmsAnak extends Model
{
    use HasFactory;
    protected $table = 'kms_anak';
    protected $guarded = ['id'];
    public function anak()
    {
        return $this->belongsTo(Anak::class);
    }
}
