@extends('dashboard')

@section('view_title', 'Listado de Exámenes')

@section('view_content')
    @livewire('examenes.list-examen')
@endsection
