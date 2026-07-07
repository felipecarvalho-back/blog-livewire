<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" >
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $title ?? config('app.name') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @livewireStyles
    @fluxAppearance
</head>

<body>
    {{ $slot }}

    @persist('toast')
        <flux:toast />
    @endpersist

    @if (session('status'))
        <div x-data x-init="$flux.toast({ text: '{{ session('status') }}', variant: 'success' })"></div>
    @endif

    @if (session('error'))
        <div x-data x-init="$flux.toast({ text: '{{ session('error') }}', variant: 'danger' })"></div>
    @endif

    @livewireScripts
    @fluxScripts

</body>

</html>