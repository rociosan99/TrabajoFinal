@extends("dashboard")

@section("view_title", "Modulo de Roles")

@section("view_nav")
    <ul class="flex justify-start align-center gap-4">
        <li><a href="">a</a></li>
        <li><a href="">v</a></li>
        <li><a href="">c</a></li>
    </ul>
@endsection

@section("view_content")
    @livewire("roles.list-roles")
@endsection
