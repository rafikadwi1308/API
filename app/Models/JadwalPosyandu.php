<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalPosyandu extends Model
{
    protected $table ='jadwal_posyandu';
    protected $primaryKey = 'id_jadwal'; 
    protected $fillable = [
        'jadwal_posyandu',
        'jadwal_buka',
        'jadwal_tutup'
    ];
}
