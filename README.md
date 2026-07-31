# Player Notes

Módulo para que soporte deje notas internas sobre un jugador.

## Instalación

```
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan db:seed --class=Database\Seeders\PlayerNotesPermissionSeeder
```

## Notas de implementación

- Repositorio: `PlayerNoteRepositoryInterface` + `EloquentPlayerNoteRepository`, bind en `RepositoryServiceProvider`.
- El permiso usado es `player-notes.create` (Spatie Permission). Sin ese permiso, el form de agregar nota no se muestra, y aunque se llame el método directo también lo bloquea la Policy.
- El componente Livewire quedó como clase separada (`app/Livewire/PlayerNotes.php` + vista), no como single-file component, para que sea más fácil de leer.

## Tests

```
php artisan test --filter=PlayerNoteTest
```
