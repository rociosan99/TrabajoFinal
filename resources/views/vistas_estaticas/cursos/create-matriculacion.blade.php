@extends("dashboard")

@section("view_title", "Modulo de Cursos")


@section("view_nav")

@endsection   


@section("view_content")
   @livewire('cursos.create-matriculacion',['cursoId'=>$cursoId])
@endsection