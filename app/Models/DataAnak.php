<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataAnak extends Model
{
    public function posyandu()
    {
        return $this->hasMany(DataPosyandu::class, 'nik_anak', 'nik_anak');
    }
    protected $table ='anak';
    protected $primaryKey = 'nik_anak'; 
    protected $fillable = [
        'nik_anak',
        'nama_anak', 
        'tempat_lahir_anak', 
        'tanggal_lahir_anak',
        'anak_ke', 
        'gol_darah_anak', 
        'jenis_kelamin_anak', 
        'no_kk', 
    ];
}
