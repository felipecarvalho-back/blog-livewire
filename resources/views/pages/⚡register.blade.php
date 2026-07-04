<?php

use Livewire\Component;
use Livewire\Attributes\Title;

new #[Title('Cadastrar')] class extends Component
{
    public string $name = '';
    public string $email = '';
    public string $password = '';
    public string $password_confirmation = '';
    public bool $terms = false;

    public function register(): void
    {
        $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'password' => ['required', 'min:6', 'confirmed'],
            'terms' => ['accepted'],
        ], [
            'name.required' => 'O campo nome é obrigatório.',
            'name.max' => 'O nome não pode ter mais de 255 caracteres.',
            'email.required' => 'O campo e-mail é obrigatório.',
            'email.email' => 'O e-mail informado não é válido.',
            'email.max' => 'O e-mail não pode ter mais de 255 caracteres.',
            'password.required' => 'O campo senha é obrigatório.',
            'password.min' => 'A senha deve ter pelo menos 6 caracteres.',
            'password.confirmed' => 'A confirmação da senha não corresponde.',
            'terms.accepted' => 'Você precisa aceitar os termos e condições.',
        ]);

        session()->flash('status', 'Cadastro realizado com sucesso! (Simulado)');
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

    <!-- Centered Register Card Container -->
    <div class="w-full max-w-[480px]">
        <!-- Brand/Logo Header -->
        <div class="text-center mb-8">
            <div class="inline-flex bg-zinc-900 text-white dark:bg-white dark:text-zinc-900 rounded-2xl p-2 w-12 h-12 items-center justify-center shadow-md mb-4">
                <flux:icon name="book-open" class="w-7 h-7 text-white dark:text-zinc-900" />
            </div>
            <h2 class="text-3xl font-black tracking-tight text-zinc-900 dark:text-white">Criar uma conta</h2>
            <p class="mt-2 text-sm text-zinc-500 dark:text-zinc-400">
                Junte-se à nossa comunidade de desenvolvedores.
            </p>
        </div>

        <!-- Card wrapper with subtle border and shadow -->
        <flux:card class="p-8 border border-zinc-200 dark:border-zinc-800 bg-white dark:bg-zinc-900/50 backdrop-blur-xl shadow-xl rounded-2xl">
            <form wire:submit="register" class="space-y-5">
                <!-- Name Field -->
                <flux:field>
                    <flux:label>Nome Completo</flux:label>
                    <flux:input 
                        type="text" 
                        wire:model="name" 
                        placeholder="Seu Nome" 
                        icon="user"
                    />
                    <flux:error name="name" />
                </flux:field>

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
                    <flux:label>Senha</flux:label>
                    <flux:input 
                        type="password" 
                        wire:model="password" 
                        placeholder="••••••••" 
                        viewable
                        icon="key"
                    />
                    <flux:error name="password" />
                </flux:field>

                <!-- Password Confirmation Field -->
                <flux:field>
                    <flux:label>Confirmar Senha</flux:label>
                    <flux:input 
                        type="password" 
                        wire:model="password_confirmation" 
                        placeholder="••••••••" 
                        viewable
                        icon="key"
                    />
                    <flux:error name="password_confirmation" />
                </flux:field>

                <!-- Terms and Conditions Checkbox -->
                <flux:field variant="inline" class="items-start">
                    <flux:checkbox wire:model="terms" />
                    <label class="text-xs text-zinc-650 dark:text-zinc-400 leading-normal select-none cursor-pointer">
                        Eu concordo com os 
                        <a href="#" class="font-semibold text-violet-600 dark:text-violet-400 hover:underline">Termos de Serviço</a> 
                        e a 
                        <a href="#" class="font-semibold text-violet-600 dark:text-violet-400 hover:underline">Política de Privacidade</a>.
                    </label>
                    <flux:error name="terms" />
                </flux:field>

                <!-- Submit Button -->
                <flux:button type="submit" variant="primary" class="w-full mt-2" icon="user-plus">
                    Criar Conta
                </flux:button>
            </form>
        </flux:card>

        <p class="mt-8 text-center text-sm text-zinc-500 dark:text-zinc-400">
            Já possui uma conta?
            <a href="{{ route('login') }}" class="font-semibold text-violet-600 dark:text-violet-400 hover:underline" wire:navigate>
                Fazer Login
            </a>
        </p>
    </div>
</div>
