<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Player;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class PlayerController extends Controller
{
    public function show(Player $player): View
    {
        return view('players.show', ['player' => $player]);
    }
}
