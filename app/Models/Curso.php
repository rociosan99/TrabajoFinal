<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Spatie\Permission\Traits\HasRoles;

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
        'descripcion',
        'usuario_id',  // Profesor que imparte el curso
    ];

    protected $casts = [
        'fecha_inicio' => 'date',
        'fecha_fin' => 'date',
    ];

    public function usuario(): BelongsTo
    {
        return $this->belongsTo(User::class, 'usuario_id', 'id');
    }

    public function examenes(): HasMany
    {
        return $this->hasMany(Examen::class, 'curso_id', 'id');
    }

    public function clases(): HasMany
    {
        return $this->hasMany(Clase::class);
    }

    public function alumnos(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'alumnoxcurso', 'curso_id', 'user_id');
    }

    public function alumnoxCursos(): HasMany
    {
        return $this->hasMany(AlumnoxCurso::class, 'curso_id', 'id');
    }

    public function usuarios(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'alumnoxcurso', 'curso_id', 'user_id')
                    ->withTimestamps();
    }

    public function horariosCurso(): HasMany
    {
        return $this->hasMany(HorariosCurso::class, 'id_curso', 'id');
    }

    public function profesores()
    {
        return $this->belongsToMany(User::class, 'profesorxcurso', 'curso_id', 'user_id');
    }

    public function comunicaciones()
    {
        return $this->hasMany(Comunicacion::class, 'id_curso');
    }
}
