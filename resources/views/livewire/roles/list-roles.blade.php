<div>
    {{-- If you look to others for fulfillment, you will never truly be fulfilled. --}}
    <div class="w-full flex justify-end items-center gap-4 p-4">
    <a href="{{route('users-roles-create')}}" class="bg-green-700 text-white font-bold py-2 px-4 rounded hover:bg-green-800 transition-colors">
        Nuevo Rol
    </a>
    </div>
    <table class="w-full border-collapse border border-gray-300 bg-white">
    <thead>
        <tr class="bg-blue-500 text-white">
            <th class="border border-gray-300 p-2 text-md">id</th>
            <th class="border border-gray-300 p-2 text-md">Nombre</th>
            <th class="border border-gray-300 p-2 text-md">Fecha de creación</th>
            <th class="border border-gray-300 p-2 text-md">Acciones</th>
        </tr>
    </thead>
    <tbody>
        @forelse($roles as $role)
        <tr wire:key="{{$role->id}}">
            <td class="border border-gray-300 p-2">{{$role->id}}</td>
            <td class="border border-gray-300 p-2">{{$role->name}}</td>
            <td class="border border-gray-300 p-2">{{Date::parse($role->created_at)->format("d-m-Y")}}</td>
            <td class="border border-gray-300 p-2 text-center">
                <div>
                    <a class="text-blue-600 hover:text-blue-900 text-center">Editar</a>
                    <button class="text-red-600 hover:text-red-900 ml-4" >Eliminar</button>
                </div>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="4" class="border border-gray-300 p-2 text-center"> 
                <span>Sin registros</span>
            </td>
        </tr>
        @endforelse
    </tbody>
</table>

</div>
