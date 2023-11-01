<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoriaEventos extends Model
{
    use HasFactory;
    protected $table ='categoria';
    protected $fillable = [
       
        'nombre_categoria',
     

    ];
}
