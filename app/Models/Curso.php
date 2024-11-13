<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
        'usuario_id',

    ];

    protected $casts=[
        'fecha_inicio'=>"date",
        'fecha_fin'=>"date",
    ];

    public function usuario():BelongsTo
    {
        return $this->belongsTo(User::class,"usuario_id","id");
    }
}
