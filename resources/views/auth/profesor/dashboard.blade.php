@extends('dashboard') <!-- Si tienes un layout común -->

@section('view_title', 'ClassAdmin')

@section('view_content')
   

        <!-- Componente Livewire -->
        @livewire('profesor.profesor-dashboard')

    
@endsection
