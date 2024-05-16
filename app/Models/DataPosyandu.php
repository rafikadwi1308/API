<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataPosyandu extends Model
{
    protected $table = 'posyandu';
    protected $primaryKey = 'id_posyandu';
    protected $fillable = [
        'tb_anak',
        'bb_anak',
        'umur_anak',
        'tanggal_posyandu',
        'umur_anak',
        'nik_anak'
    ];
    public function vaksin()
    {
        return $this->belongsToMany(DataImunisasi::class, 'detail_posyandu', 'id_posyandu', 'id_vaksin');
    }
}
