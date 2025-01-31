<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class User extends Authenticatable implements Auditable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use HasRoles;
    use \OwenIt\Auditing\Auditable;

    protected $fillable = [
        'name',
        'apellido',
        'dni',
        'fecha_nac',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    protected $appends = [
        'profile_photo_url',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function cursos()
    {
        return $this->belongsToMany(Curso::class, 'alumnoxcurso', 'user_id', 'curso_id')
                    ->withTimestamps();
    }

    public function asistencias()
    {
        return $this->hasMany(Asistencia::class, 'user_id');
    }

    public function alumnoxcurso()
    {
        return $this->hasMany(AlumnoxCurso::class, 'user_id', 'id');
    }

    public function profesorxcurso()
    {
        return $this->belongsToMany(Curso::class, 'ProfesorxCurso', 'user_id', 'curso_id');
    }

    public function comunicacionesRecibidas()
    {
        return $this->hasMany(Comunicacion::class, 'receptor_id');
    }

    

}
