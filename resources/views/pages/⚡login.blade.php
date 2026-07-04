<?php

use Livewire\Component;
use Livewire\Attributes\Title;

new #[Title('Entrar')] class extends Component
{
    public string $email = '';
    public string $password = '';
    public bool $remember = false;

    public function login(): void
    {
        $this->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'min:6'],
        ], [
            'email.required' => 'O campo e-mail é obrigatório.',
            'email.email' => 'O e-mail informado não é válido.',
            'password.required' => 'O campo senha é obrigatório.',
            'password.min' => 'A senha deve ter pelo menos 6 caracteres.',
        ]);

        session()->flash('status', 'Login realizado com sucesso! (Simulado)');
        $this->redirectRoute('home');
    }
};
?>

<div class="min-h-screen bg-zinc-50 dark:bg-zinc-950 flex items-center justify-center p-4 sm:p-6 lg:p-8 antialiased">
    <!-- Back to home link top left -->
    <div class="absolute top-4 left-4 sm:top-8 sm:left-8">
        <flux:button href="{{ route('home') }}" icon="arrow-left" variant="subtle" size="sm">
            Voltar ao Blog
        </flux:button>
    </div>

    <!-- Centered Login Card Container -->
    <div class="w-full max-w-[480px]">
        <!-- Brand/Logo Header -->
        <div class="text-center mb-8">
            <div class="inline-flex bg-zinc-900 text-white dark:bg-white dark:text-zinc-900 rounded-2xl p-2 w-12 h-12 items-center justify-center shadow-md mb-4">
                <flux:icon name="book-open" class="w-7 h-7 text-white dark:text-zinc-900" />
            </div>
            <h2 class="text-3xl font-black tracking-tight text-zinc-900 dark:text-white">Bem-vindo de volta</h2>
            <p class="mt-2 text-sm text-zinc-500 dark:text-zinc-400">
                Acesse sua conta para interagir e criar publicações.
            </p>
        </div>

        @if (session('status'))
            <flux:callout variant="success" class="mb-6">
                {{ session('status') }}
            </flux:callout>
        @endif

        <!-- Card wrapper with subtle border and shadow -->
        <flux:card class="p-8 border border-zinc-200 dark:border-zinc-800 bg-white dark:bg-zinc-900/50 backdrop-blur-xl shadow-xl rounded-2xl">
            <form wire:submit="login" class="space-y-6">
                <!-- Email Field -->
                <flux:field>
                    <flux:label>E-mail</flux:label>
                    <flux:input 
                        type="email" 
                        wire:model="email" 
                        placeholder="seu-email@exemplo.com" 
                        icon="envelope"
                    />
                    <flux:error name="email" />
                </flux:field>

                <!-- Password Field -->
                <flux:field>
                    <div class="flex justify-between items-center mb-1">
                        <flux:label class="mb-0!">Senha</flux:label>
                        <a href="#" class="text-xs font-semibold text-violet-600 dark:text-violet-400 hover:underline">
                            Esqueceu a senha?
                        </a>
                    </div>
                    <flux:input 
                        type="password" 
                        wire:model="password" 
                        placeholder="••••••••" 
                        viewable
                        icon="key"
                    />
                    <flux:error name="password" />
                </flux:field>

                <!-- Remember Me Checkbox -->
                <flux:field variant="inline" class="items-center">
                    <flux:checkbox wire:model="remember" />
                    <flux:label>Lembrar-me neste dispositivo</flux:label>
                </flux:field>

                <!-- Submit Button -->
                <flux:button type="submit" variant="primary" class="w-full mt-2" icon="arrow-right-end-on-rectangle">
                    Entrar
                </flux:button>
            </form>

            <flux:separator text="ou" class="my-6" />

            <!-- SSO / OAuth Simulation (Estético) -->
            <div class="grid grid-cols-2 gap-4">
                <flux:button variant="outline" class="w-full">
                    <svg class="w-5 h-5 mr-2" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M12.24 10.285V13.4h6.887C18.2 15.614 15.645 18 12.24 18c-3.86 0-7-3.14-7-7s3.14-7 7-7c1.7 0 3.3.6 4.5 1.7l2.42-2.42C17.34 1.765 14.94 1 12.24 1c-5.52 0-10 4.48-10 10s4.48 10 10 10c5.73 0 10.2-4.004 10.2-9.715 0-.608-.06-1.216-.162-1.8H12.24z"/>
                    </svg>
                    Google
                </flux:button>
                <flux:button variant="outline" class="w-full">
                    <svg class="w-5 h-5 mr-2" viewBox="0 0 24 24" fill="currentColor">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M12 2C6.477 2 2 6.477 2 12c0 4.42 2.865 8.166 6.839 9.489.5.092.682-.217.682-.482 0-.237-.008-.866-.013-1.7-2.782.603-3.369-1.34-3.369-1.34-.454-1.156-1.11-1.464-1.11-1.464-.908-.62.069-.608.069-.608 1.003.07 1.531 1.03 1.531 1.03.892 1.529 2.341 1.087 2.91.831.092-.646.35-1.086.636-1.336-2.22-.253-4.555-1.11-4.555-4.943 0-1.091.39-1.984 1.029-2.683-.103-.253-.446-1.27.098-2.647 0 0 .84-.269 2.75 1.025A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.294 2.747-1.025 2.747-1.025.546 1.377.203 2.394.1 2.647.64.699 1.028 1.592 1.028 2.683 0 3.842-2.339 4.687-4.566 4.935.359.309.678.919.678 1.852 0 1.336-.012 2.415-.012 2.743 0 .267.18.579.688.481C19.137 20.162 22 16.418 22 12c0-5.523-4.477-10-10-10z" />
                    </svg>
                    GitHub
                </flux:button>
            </div>
        </flux:card>

        <p class="mt-8 text-center text-sm text-zinc-500 dark:text-zinc-400">
            Ainda não tem uma conta?
            <a href="{{ route('register') }}" class="font-semibold text-violet-600 dark:text-violet-400 hover:underline" wire:navigate>
                Cadastre-se grátis
            </a>
        </p>
    </div>
</div>
