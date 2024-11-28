@extends("dashboard")
@section("view_title", "Modulo de Clases")
@section("view_nav")
@endsection
@section("view_content")
    @livewire("clases.edit-clase",['id'=>$id])
@endsection
