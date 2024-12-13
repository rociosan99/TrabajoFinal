<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Carbon\Carbon;

class Clase extends Model
{
    use HasFactory;

    protected $fillable = [
        'fecha_clase',
        'hora_inicio',
        'hora_fin',
        'curso_id',
    ];
    // Asegura que los campos de fecha sean tratados como instancias de Carbon
    protected $casts = [
        'fecha_clase' => 'datetime',
        'hora_inicio' => 'datetime',
        'hora_fin' => 'datetime',
    ];
    /** Relación con el modelo Curso */
    public function curso(): BelongsTo
    {
        return $this->belongsTo(Curso::class, 'curso_id', 'id');
    }

    public function asistencias()
    {
        return $this->hasMany(Asistencia::class, 'clase_id');
    }

    
}
