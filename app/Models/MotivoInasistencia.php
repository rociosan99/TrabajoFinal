<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MotivoInasistencia extends Model
{
    use HasFactory;
    
    protected $table = 'motivo_inasistencia';

    protected $fillable = [
        'descripcion',
    ];

    public function asistencias()
    {
        return $this->hasMany(Asistencia::class);
    }
}

