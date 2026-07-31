<?php

declare(strict_types=1);

namespace App\Repositories\Eloquent;

use App\Models\Player;
use App\Models\PlayerNote;
use App\Models\User;
use App\Repositories\Contracts\PlayerNoteRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class EloquentPlayerNoteRepository implements PlayerNoteRepositoryInterface
{
    public function getForPlayer(Player $player): Collection
    {
        return $player->playerNotes()
            ->with('author:id,name')
            ->latest()
            ->get();
    }

    public function create(Player $player, User $author, string $note): PlayerNote
    {
        return $player->playerNotes()->create(
            [
                'user_id' => $author->id,
                'note' => $note
            ]
        );
    }
}
