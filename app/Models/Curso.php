<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
    use HasFactory;
    protected $fillable = [
        'nombre',
        'dia',
        'horario',
        'nivel',
        'fecha_inicio',
        'fecha_fin',
        'descripcion'


    ];
}
