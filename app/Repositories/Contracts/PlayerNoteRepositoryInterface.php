<?php

declare(strict_types=1);

namespace App\Repositories\Contracts;

use App\Models\Player;
use App\Models\PlayerNote;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

interface PlayerNoteRepositoryInterface
{
    /**
     * Obtiene las notas de un jugador
     */
    public function getForPlayer(Player $player): Collection;

    /**
     * Crea una nueva nota
     */
    public function create(Player $player, User $author, string $note): PlayerNote;
}
