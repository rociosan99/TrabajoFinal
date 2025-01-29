<!-- resources/views/auth/admin/dashboard.blade.php -->
@extends('dashboard') <!-- Si tienes un layout común -->

@section('view_title', 'ClassAdmin')

@section('view_content')

    <!-- Componente Livewire del Dashboard del Admin -->
    @livewire('admin.admin-dashboard')
@endsection
