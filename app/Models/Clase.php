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
        'cantidad',
        'dictado', // Campo nuevo
        'observacion', // Campo nuevo
    ];

    protected $casts = [
        'fecha_clase' => 'datetime',
        'hora_inicio' => 'datetime',
        'hora_fin' => 'datetime',
        'dictado' => 'boolean', // Cast de dictado
    ];

    public function curso(): BelongsTo
    {
        return $this->belongsTo(Curso::class, 'curso_id', 'id');
    }

    public function asistencias()
    {
        return $this->hasMany(Asistencia::class, 'clase_id');
    }

    public function comunicaciones()
    {
        return $this->hasMany(Comunicacion::class, 'id_clase');
    }
}
