@extends("dashboard")

@section("view_title", "Modulo de Cursos")

@section("view_nav")
    <ul class="flex justify-start align-center gap-4">
        <li>
            <x-nav-link href="{{ route('cursos-cursos-index') }}" :active="request()->routeIs('cursos-*')">
                Cursos
            </x-nav-link>
        </li>
    </ul>
@endsection

@section("view_content")
    <div class="max-w-7xl mx-auto bg-white p-6 rounded-lg shadow-md">
        <!-- Titulo del Formulario -->
        <h2 class="text-2xl font-bold text-gray-800 mb-6">Crear Curso</h2>

        <!-- Formulario Livewire -->
        @livewire('cursos.create-curso')
    </div>
@endsection
