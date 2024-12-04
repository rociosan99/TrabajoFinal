@extends("dashboard")

@section("view_title", "Listado de Alumnos")

{{--
@section("view_nav")
    <ul class="flex justify-start align-center gap-4">
        <li>
            <x-nav-link href="{{ route('cursos-cursos-index') }}" :active="request()->routeIs('cursos-*')">
                        Cursos
            </x-nav-link> 
        </li>
    </ul>
@endsection   
--}}

@section("view_content")
    @livewire('cursos.list-alumnos', ['cursoId' => $cursoId])
@endsection