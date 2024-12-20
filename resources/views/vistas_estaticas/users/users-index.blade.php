@extends("dashboard")

@section("view_title", "Modulo de Usuarios")

@section("view_nav")
    <ul class="flex justify-start align-center gap-4">
        <li>
            <x-nav-link href="{{ route('users-roles-index') }}" :active="request()->routeIs('users-*')">
                        Roles
            </x-nav-link> 
        </li>
    </ul>
@endsection

@section("view_content")
   @livewire("users.list-users")
@endsection