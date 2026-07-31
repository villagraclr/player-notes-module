<?php

declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PlayerNotesPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permission = Permission::firstOrCreate(['name' => 'player-notes.create']);

        $supportRole = Role::firstOrCreate(['name' => 'support-agent']);
        $supportRole->givePermissionTo($permission);
    }
}
