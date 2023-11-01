<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asistentes extends Model
{
    use HasFactory;
    protected $table ='asistentes';
    protected $fillable = [
       
        'nombre',
        'apellido',
        'correo',
        'fk_evento',
    ];
    
}
