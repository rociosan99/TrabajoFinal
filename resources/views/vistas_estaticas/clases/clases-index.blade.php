@extends('dashboard') {{-- Layout principal --}}
 
@section('view_content')
    <h1 class="text-lg font-medium text-gray-900 mb-4">Clases del curso: {{ $curso->nombre }}</h1>
    @livewire('clases.list-clases', ['curso_id' => $curso->id])
@endsection
