<x-layouts.app :title="$player->name">
    <h1 class="mb-6 text-2xl font-bold">{{ $player->name }}</h1>

    <livewire:player-notes :player="$player" />
</x-layouts.app>