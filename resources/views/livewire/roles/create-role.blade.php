<div>
    {{-- To attain knowledge, add things every day; To attain wisdom, subtract things every day. --}}
    <form wire:submit="save" wire:confirm="crear rol?">
        <label for="name">Nombre de Rol</label>
        <input wire:model="name" type="text" name="name">
        <a href="">Cancelar</a>
        <button type="submit">Guardar</button>
    </form>
</div>
