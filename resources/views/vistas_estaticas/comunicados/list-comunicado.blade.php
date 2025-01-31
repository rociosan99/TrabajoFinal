@extends('dashboard')

@section('view_title', 'Lista de Comunicados')

@section('view_content')
    @livewire('comunicados.list-comunicados')
@endsection