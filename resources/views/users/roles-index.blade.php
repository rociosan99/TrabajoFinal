@extends("dashboard")
@section("view_title", "Modulo de Usuarios")
@section("view_nav")
<ul>
    <li>Hola</li>
    <li>nlokns</li>
</ul>
@endsection
@section("view_content")
    @livewire("roles.list-roles")
@endsection
