<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Clase extends Model
{
    use HasFactory;

    protected $fillable = [
        'fecha_clase',
        'hora_inicio',
        'hora_fin',
        'curso_id',
    ];

    /**Relación con el modelo Curso Una clase pertenece a un curso.*/

    public function curso(): BelongsTo
    {
        return $this->belongsTo(Curso::class, 'curso_id', 'id');
    }

    public function asistencias()
    {
        return $this->hasMany(Asistencia::class, 'clase_id');
    }

}

