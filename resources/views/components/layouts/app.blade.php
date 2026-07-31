<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'Panel de soporte' }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    @livewireStyles
</head>
<body class="bg-gray-50 text-gray-900">
    <main class="mx-auto max-w-3xl px-4 py-8">
        {{ $slot }}
    </main>
    @livewireScripts
</body>
</html>
