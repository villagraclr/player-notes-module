<?php

declare(strict_types=1);

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

use App\Livewire\PlayerNotes;
use App\Models\Player;
use App\Models\User;
use Spatie\Permission\Models\Permission;

class PlayerNoteTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        Permission::firstOrCreate(['name' => 'player-notes.create']);
    }

    public function test_authorized_user_can_save_a_note_for_a_player(): void
    {
        $author = User::factory()->create();
        $author->givePermissionTo('player-notes.create');
        $player = Player::factory()->create();

        Livewire::actingAs($author)
            ->test(PlayerNotes::class, ['player' => $player])
            ->set('note', 'El jugador reportó un problema con un retiro de fondos.')
            ->call('save')
            ->assertHasNoErrors();

        $this->assertDatabaseHas('player_notes', [
            'player_id' => $player->id,
            'user_id' => $author->id,
            'note' => 'El jugador reportó un problema con un retiro de fondos.',
        ]);
    }

    public function test_note_cannot_be_empty(): void
    {
        $author = User::factory()->create();
        $author->givePermissionTo('player-notes.create');
        $player = Player::factory()->create();

        Livewire::actingAs($author)
            ->test(PlayerNotes::class, ['player' => $player])
            ->set('note', '')
            ->call('save')
            ->assertHasErrors(['note' => 'required']);

        $this->assertDatabaseCount('player_notes', 0);
    }

    public function test_note_cannot_exceed_max_length(): void
    {
        $author = User::factory()->create();
        $author->givePermissionTo('player-notes.create');
        $player = Player::factory()->create();

        Livewire::actingAs($author)
            ->test(PlayerNotes::class, ['player' => $player])
            ->set('note', str_repeat('a', 501))
            ->call('save')
            ->assertHasErrors(['note' => 'max']);
    }

    public function test_user_without_permission_cannot_save_a_note(): void
    {
        $userWithoutPermission = User::factory()->create();
        $player = Player::factory()->create();

        Livewire::actingAs($userWithoutPermission)
            ->test(PlayerNotes::class, ['player' => $player])
            ->set('note', 'Intento no autorizado.')
            ->call('save')
            ->assertForbidden();

        $this->assertDatabaseCount('player_notes', 0);
    }

    public function test_user_without_permission_does_not_see_the_form(): void
    {
        $userWithoutPermission = User::factory()->create();
        $player = Player::factory()->create();

        Livewire::actingAs($userWithoutPermission)
            ->test(PlayerNotes::class, ['player' => $player])
            ->assertDontSee('Agregar Nota');
    }
}
