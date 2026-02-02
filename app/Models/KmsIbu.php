<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KmsIbu extends Model
{
    use HasFactory;
    protected $table = 'kms_ibu';
    protected $guarded = ['id'];
      public function warga()
    {
        return $this->belongsTo(Warga::class);
    }
    
}
