@extends('dashboard') {{-- Usando un layout base --}}

@section('view_content')
    @livewire('asistencias.create-asistencia',['claseId'=>$claseId])
@endsection
