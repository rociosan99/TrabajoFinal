<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfesorxCurso extends Model
{
    use HasFactory;

    protected $table = 'profesorxcurso';

    protected $fillable = [
        'curso_id',
        'user_id',
    ];

    public $timestamps = false;
}
