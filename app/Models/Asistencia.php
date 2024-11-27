<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asistencia extends Model
{
    use HasFactory;

    protected $fillable = [
        'estado',
        'clase_id',
        'usuario_id',
        'motivo_inasistencia_id',
    ];

    //Relación con la tabla clases.
     
    public function clase()
    {
        return $this->belongsTo(Clase::class, 'clase_id');
    }

    //Relación con la tabla usuarios. 
    public function usuario()
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }

    // Relación con la tabla motivo_inasistencia.
     
    public function motivoInasistencia()
    {
        return $this->belongsTo(MotivoInasistencia::class, 'motivo_inasistencia_id');
    }
}

