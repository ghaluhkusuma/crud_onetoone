<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    use HasFactory;
    protected $fillable = [
    'nama',
    'alamat',
    'tempatlahir',
    'tanggallahir',
    'jeniskelamin'
    ];
    public function rekening (){	
    return $this->hasOne(Rekening::class,'id_pegawai');
}
}
