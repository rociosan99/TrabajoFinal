<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class RoleRedirectController extends Controller
{
    /**
     * Redirige al usuario al dashboard correspondiente según su rol.
     */
    public function redirectToDashboard()
    {
        // Verificar el rol del usuario autenticado
        if (Auth::user()->hasRole('Administrador')) {
            return redirect()->route('admin.dashboard');
        } elseif (Auth::user()->hasRole('Profesor')) {
            return redirect()->route('profesor.dashboard');
        } else {
            return redirect()->route('alumno.dashboard');
        }
    }
}
