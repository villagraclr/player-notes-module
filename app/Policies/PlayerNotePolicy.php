<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\User;

class PlayerNotePolicy
{
    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->can('player-notes.create');
    }
}
