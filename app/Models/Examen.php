<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Examen extends Model
{
    use HasFactory;

    protected $table = 'examenes';

    // Atributos asignables
    protected $fillable = [
        'tema',
        'fecha_examen',
        'curso_id',
    ];


    protected $casts=[
        'fecha_examen'=>"date",
       
    ];


    // Relación con el modelo Curso
    public function curso()
    {
        return $this->belongsTo(Curso::class,"curso_id","id");
    }
}

