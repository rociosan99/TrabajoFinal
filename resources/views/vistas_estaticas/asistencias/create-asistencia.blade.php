@extends('dashboard') {{-- Usando un layout base --}}

@section('view_content')
    @livewire('asistencias.create-asistencia', ['cursoId' => $cursoId])
@endsection
