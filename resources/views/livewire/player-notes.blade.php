<div class="space-y-4">
    <h3 class="text-lg font-semibold">Historial de Notas</h3>

    @if ($canCreateNote)
        <form wire:submit.prevent="save" class="space-y-2">
            <label for="note" class="block text-sm font-medium text-gray-700">
                Nueva nota
            </label>

            <textarea
                id="note"
                wire:model="note"
                rows="3"
                maxlength="500"
                placeholder="Escribe una observación interna sobre este jugador..."
                class="w-full rounded border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
            ></textarea>

            @error('note')
                <p class="text-sm text-red-600">{{ $message }}</p>
            @enderror

            <button
                type="submit"
                wire:loading.attr="disabled"
                wire:target="save"
                class="inline-flex items-center rounded bg-indigo-600 px-4 py-2 text-sm font-medium text-white hover:bg-indigo-700 disabled:opacity-50"
            >
                <span wire:loading.remove wire:target="save">Agregar Nota</span>
                <span wire:loading wire:target="save">Guardando...</span>
            </button>
        </form>
    @endif

    <table class="w-full text-sm">
        <thead>
            <tr class="text-left text-gray-500">
                <th class="py-1">Fecha</th>
                <th class="py-1">Autor</th>
                <th class="py-1">Nota</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($notes as $playerNote)
                <tr wire:key="player-note-{{ $playerNote->id }}" class="border-t">
                    <td class="py-2 whitespace-nowrap">{{ $playerNote->created_at->format('d-m-Y H:i') }}</td>
                    <td class="py-2">{{ $playerNote->author->name }}</td>
                    <td class="py-2">{{ $playerNote->note }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="py-4 text-center text-gray-400">
                        Sin notas registradas para este jugador.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
