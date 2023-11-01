<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Eventos extends Model
{
    use HasFactory;
    protected $table ='eventos';
    protected $fillable = [
       
        'titulo',
        'descripcion',
        'fecha',
        'hora',
        'ubicacion',
        'imagen',
        'fk_categoria',
     

    ];
}
