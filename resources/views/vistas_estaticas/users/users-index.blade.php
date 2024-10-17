@extends("dashboard")

@section("view_title", "Modulo de Usuarios")

@section("view_nav")
    <!--<ul class="flex justify-start align-center gap-4">
        <li><a href="">a</a></li>
        <li><a href="">v</a></li>
        <li><a href="">c</a></li>
    </ul>-->
@endsection

@section("view_content")
   @livewire("users.list-users")
@endsection