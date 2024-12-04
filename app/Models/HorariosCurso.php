<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HorariosCurso extends Model
{
    use HasFactory;

    protected $fillable = ['id_curso', 'hora_inicio', 'hora_fin', 'dia_semana'];

    // Relación: un horario pertenece a un curso
    public function curso()
    {
        return $this->belongsTo(Curso::class, 'id_curso');
    }
}
