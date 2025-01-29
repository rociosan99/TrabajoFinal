<!-- resources/views/auth/alumno/dashboard.blade.php -->
@extends('dashboard') <!-- Si tienes un layout común -->

@section('view_title', 'ClassAdmin')

@section('view_content')
  
    <!-- Aquí puedes agregar contenido específico para el Alumno -->
    @livewire('alumno.alumno-dashboard')
    
@endsection
