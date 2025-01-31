<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Carbon\Carbon;


class Comunicacion extends Model
{
    use HasFactory;

    protected $table = 'comunicaciones';
    protected $primaryKey = 'id_comunicacion'; // Indicar la clave primaria correcta
    public $incrementing = true; // Si es autoincremental

    protected $fillable = [ 
        'receptor_id', 
        'fecha', 
        'estado', 
        'titulo', 
        'cuerpo',
        'id_clase', 
        'id_curso',
        'observacion',
        'respuesta',
        'fecha_respuesta'
    ];

    // Relación con el modelo User para el receptor
    public function receptor()
    {
        return $this->belongsTo(User::class, 'receptor_id'); // 'receptor_id' debe coincidir con el nombre de la columna
    }


    // Relación con el modelo Clase
    public function clase()
    {
        return $this->belongsTo(Clase::class, 'id_clase');
    }

    // Relación con el modelo Curso
    public function curso()
    {
        return $this->belongsTo(Curso::class, 'id_curso');
    }

}