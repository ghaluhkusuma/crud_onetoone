<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rekening extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_pegawai',
        'nomorrekening',
     ];


     public function pegawai() {
        return $this->belongsTo(Pegawai::class);
        
    }
}
