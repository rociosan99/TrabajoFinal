<div>
    {{-- If you look to others for fulfillment, you will never truly be fulfilled. --}}
    <a href="{{route('users-roles-create')}}">nuevo rol</a>
    <table>
        <thead>
            <tr>
                <th>id</th>
                <th>Nombre</th>
                <th>Fecha de creacion</th>
                <th>acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse($roles as $role)
            <tr wire:key="{{$role->id}}">
                <td>{{$role->id}}</td>
                <td>{{$role->name}}</td>
                <td>{{$role->created_at}}</td>
                <td>accion</td>
            </tr>
            @empty
            <tr>
                <td colspan="4"> <span>Sin registros</span></td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
