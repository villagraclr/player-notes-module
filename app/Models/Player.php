<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Player extends Model
{
    /** @use HasFactory<\Database\Factories\PlayerFactory> */
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    /**
     * Notas registradas por los agentes de soporte sobre este jugador.
     */
    public function playerNotes(): HasMany
    {
        return $this->hasMany(PlayerNote::class);
    }
}
