@extends('dashboard') <!-- Si tienes un layout común -->

@section('view_content')
   

        <!-- Componente Livewire -->
        @livewire('profesor.profesor-dashboard')

    
@endsection
