<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Curso extends Model
{
    use HasFactory;

    // Atributos asignables masivamente
    protected $fillable = [
        'nombre',
        'dia',
        'horario',
        'nivel',
        'fecha_inicio',
        'fecha_fin',
        'descripcion',
        'usuario_id',
    ];

    // Casters para fechas
    protected $casts = [
        'fecha_inicio' => 'date',
        'fecha_fin' => 'date',
    ];

    /**
     * Relación con el modelo Usuario.
     * Un curso pertenece a un usuario (profesor).
     */
    public function usuario(): BelongsTo
    {
        return $this->belongsTo(User::class, 'usuario_id', 'id');
    }

    /**
     * Relación con el modelo Examen.
     * Un curso puede tener muchos exámenes.
     */
    public function examenes(): HasMany
    {
        return $this->hasMany(Examen::class, 'curso_id', 'id');
    }
}
