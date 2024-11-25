@extends('dashboard') 

@section('view_title', 'Inicio')

@section('view_content')
    <div class="container mx-auto p-6">
        @livewire('home') <!-- El nombre del componente Livewire debe coincidir con 'home' -->
    </div>
@endsection
