<div class="container mx-auto p-4">
    @if (session()->has('mensaje_enviado'))
        <div class="bg-green-500 text-white p-2 rounded mb-4">
            {{ session('mensaje_enviado') }}
        </div>
    @endif

    <div class="bg-white shadow-lg rounded-lg p-6">
        <h2 class="text-xl font-semibold mb-4">Responder Comunicado</h2>
        <div class="space-y-4">
            <div>
                <label for="mensaje" class="block text-sm font-medium text-gray-700">Tu respuesta</label>
                <textarea id="mensaje" wire:model="mensaje" class="w-full h-32 border border-gray-300 rounded-md p-2 resize-none" placeholder="Escribe tu respuesta aquí..."></textarea>
                @error('mensaje') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="flex justify-end">
                <button wire:click="enviarMensaje" class="bg-blue-500 text-white px-6 py-2 rounded-lg hover:bg-blue-600">Enviar</button>
            </div>
        </div>
    </div>
</div>
