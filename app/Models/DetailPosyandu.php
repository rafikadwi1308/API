<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPosyandu extends Model
{
    protected $table ='detail_posyandu'; 
    protected $fillable = ['id_posyandu','id_vaksin'];
}
