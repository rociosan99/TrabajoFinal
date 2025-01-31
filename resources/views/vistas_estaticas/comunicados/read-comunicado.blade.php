@extends('dashboard')

@section('view_title', 'Lista de Comunicados')

@section('view_content')
    @livewire('comunicados.read-comunicados', ['id_comunicacion' => $comunicacion->id_comunicacion])
@endsection