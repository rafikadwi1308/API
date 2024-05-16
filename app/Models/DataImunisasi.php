<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataImunisasi extends Model
{
    protected $table ='imunisasi';
    protected $primaryKey = 'id_vaksin'; 
    protected $fillable = ['nama_vaksin'];
}
