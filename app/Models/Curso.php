<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

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
        'usuario_id',  // Profesor que imparte el curso
    ];

    // Casters para fechas
    protected $casts = [
        'fecha_inicio' => 'date',
        'fecha_fin' => 'date',
    ];

    /* Relación con el modelo Usuario: Un curso pertenece a un usuario (profesor) */
    public function usuario(): BelongsTo
    {
        return $this->belongsTo(User::class, 'usuario_id', 'id');
    }

    /* Relación con el modelo Examen: un curso puede tener muchos exámenes */
    public function examenes(): HasMany
    {
        return $this->hasMany(Examen::class, 'curso_id', 'id');
    }

    /* Relación con el modelo Clase: un curso puede tener muchas clases */
    public function clases(): HasMany
    {
        return $this->hasMany(Clase::class, 'curso_id', 'id');
    }

    public function alumnos()
{
    return $this->belongsToMany(User::class, 'alumnoxcurso', 'curso_id', 'user_id');
}

    /* Relación con la tabla pivote AlumnoxCurso: Un curso puede tener muchos alumnos */
    public function alumnoxCursos()
    {
        return $this->hasMany(AlumnoxCurso::class, 'curso_id', 'id');
    }

    /* Relación muchos a muchos con los usuarios (alumnos) a través de la tabla pivote */
    public function usuarios()
    {
        return $this->belongsToMany(User::class, 'alumnoxcurso', 'curso_id', 'user_id')
                    ->withTimestamps();
    }
}
