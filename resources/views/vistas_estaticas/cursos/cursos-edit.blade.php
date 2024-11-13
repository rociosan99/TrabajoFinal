@extends("dashboard")
@section("view_title", "Modulo de Usuarios")
@section("view_nav")
<ul>
    <li>Hola</li>
    
</ul>
@endsection
@section("view_content")
@livewire("cursos.edit-curso",['id'=>$id]) 
@endsection
