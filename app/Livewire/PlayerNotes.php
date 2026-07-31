<?php

declare(strict_types=1);

namespace App\Livewire;

use App\Models\Player;
use App\Models\PlayerNote;
use App\Repositories\Contracts\PlayerNoteRepositoryInterface;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class PlayerNotes extends Component
{
    public Player $player;

    public string $note;

    protected function rules(): array
    {
        return [
            'note' => ['required', 'string', 'max:500']
        ];
    }

    protected function messages(): array
    {
        return [
            'note.required' => 'La nota no puede estar vacía',
            'note.max' => 'La nota no puede superar los 255 caracteres'
        ];
    }

    public function mount(Player $player): void
    {
        $this->player = $player;
    }
    
    public function save(PlayerNoteRepositoryInterface $repository): void
    {
        $this->authorize('create', PlayerNote::class);

        $this->validate();

        $repository->create(
            player: $this->player,
            author: Auth::user(),
            note: $this->note
        );

        $this->reset('note');

        $this->dispatch('player-note-added', playerId: $this->player->id);
    }

    public function render(PlayerNoteRepositoryInterface $repository): View
    {
        return view('livewire.player-notes',
        [
            'notes' => $repository->getForPlayer($this->player),
            'canCreateNote' => Auth::user()?->can('create', PlayerNote::class) ?? false
        ]);
    }
}
