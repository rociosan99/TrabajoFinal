<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

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

    public static function crearAsistencia($userId, $classId, $status)
    {
        DB::statement('
            INSERT INTO asistencias (usuario_id, clase_id, estado) 
                VALUES (?, ?, ?)
            ON DUPLICATE KEY UPDATE estado = VALUES(estado)', 
            [$userId, $classId, $status]
        );
        /*DB::table('asistencias')->upsert(
            [
                ['usuario_id' => $userId, 'clase_id' => $classId, 'estado' => "'$status'"]
            ],
            ['clase_id', 'usuario_id'], // Aquí pones las columnas que deben ser únicas para detectar duplicados
            ['estado']
        );*/
    }
}
