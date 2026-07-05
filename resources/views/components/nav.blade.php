<flux:header container class="bg-white dark:bg-zinc-900 border-b border-zinc-200 dark:border-zinc-800">
    <flux:brand href="{{ route('home') }}" name="DevBlog" class="font-bold tracking-tight">
        <x-slot name="logo"
            class="bg-zinc-900 text-white dark:bg-white dark:text-zinc-900 rounded-lg flex items-center justify-center p-1 w-8 h-8">
            <flux:icon name="book-open" class="w-5 h-5 text-white dark:text-zinc-900" />
        </x-slot>
    </flux:brand>

    <flux:navbar class="-mb-px max-lg:hidden">
        <flux:navbar.item href="{{ route('home') }}" current icon="home">Home</flux:navbar.item>
        <flux:navbar.item href="#" icon="document-text">Artigos</flux:navbar.item>
        <flux:navbar.item href="#" icon="information-circle">Sobre</flux:navbar.item>
    </flux:navbar>

    <flux:spacer />

    <flux:navbar class="gap-2">
        @auth
            <flux:navbar.item href="#" wire:navigate>{{ Auth::user()->name }}</flux:navbar.item>
            <flux:button href="{{ route('logout') }}" variant="primary" icon="arrow-right-end-on-rectangle" wire:navigate
                class="max-sm:hidden">
                Sair
            </flux:button>
        @else
            <flux:navbar.item href="{{ route('login') }}" icon="arrow-right-end-on-rectangle" wire:navigate>Entrar
            </flux:navbar.item>
            <flux:button href="{{ route('register') }}" variant="primary" icon="user-plus" wire:navigate
                class="max-sm:hidden">
                Cadastrar
            </flux:button>
        @endauth
    </flux:navbar>
</flux:header>