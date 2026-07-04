<?php

use Livewire\Component;
use Livewire\Attributes\Title;

new #[Title('Home')] class extends Component
{
    public array $posts = [];
    public array $comments = [];

    public function mount()
    {
        $this->posts = [
            [
                'id' => 1,
                'title' => 'Dominando Tailwind CSS v4 no Laravel 13',
                'excerpt' => 'Descubra as principais novidades da nova versão do Tailwind CSS e como integrá-lo de forma otimizada com o Laravel 13 utilizando o novo compilador CSS-First.',
                'conteudo' => 'O Tailwind CSS v4.0 traz uma série de melhorias e mudanças significativas no seu motor de compilação. Com um foco enorme em performance e simplicidade, a nova versão adota uma configuração totalmente baseada em arquivos CSS (CSS-First), eliminando a necessidade do arquivo tailwind.config.js tradicional. A integração com o Vite e o Laravel 13 está mais fluida do que nunca, permitindo tempos de rebuild extremamente rápidos.',
                'image' => 'https://images.unsplash.com/photo-1507238691740-187a5b1d37b8?auto=format&fit=crop&w=800&q=80',
                'category' => 'Tailwind CSS',
                'tags' => ['Tailwind CSS', 'CSS', 'Vite', 'Laravel'],
                'author' => [
                    'name' => 'Felipe Carvalho',
                    'avatar' => 'https://unavatar.io/github/felipecarvalho-back',
                ],
                'date' => '04 Jul, 2026',
                'read_time' => '5 min'
            ],
            [
                'id' => 2,
                'title' => 'O Poder do Livewire v4 com Flux UI',
                'excerpt' => 'Construa interfaces ricas, reativas e com excelente acessibilidade sem escrever uma única linha de JavaScript, usando o poder do novo ecossistema.',
                'conteudo' => 'O Livewire v4 eleva o patamar de aplicações Laravel Full-Stack. Juntamente com o Flux UI, uma biblioteca de componentes nativos construída sob medida, o desenvolvimento de formulários, tabelas dinâmicas, modais e transições de página se torna incrivelmente ágil. O motor interno do Livewire 4 foi reestruturado para ser mais rápido e lidar com reatividade local de forma eficiente usando Alpine.js integrado.',
                'image' => 'https://images.unsplash.com/photo-1555066931-4365d14bab8c?auto=format&fit=crop&w=800&q=80',
                'category' => 'Livewire',
                'tags' => ['Livewire', 'Flux UI', 'Alpine.js', 'PHP'],
                'author' => [
                    'name' => 'Taylor Otwell',
                    'avatar' => 'https://unavatar.io/github/taylorotwell',
                ],
                'date' => '02 Jul, 2026',
                'read_time' => '8 min'
            ],
            [
                'id' => 3,
                'title' => 'Boas Práticas de Banco de Dados no Laravel',
                'excerpt' => 'N+1, subqueries complexas e indexação. Dicas essenciais para manter o banco de dados do seu projeto rápido e escalável com Eloquent.',
                'conteudo' => 'Conforme a sua aplicação Laravel cresce, a forma como você interage com o banco de dados se torna o principal gargalo de performance. Evitar problemas clássicos como consultas N+1 através do Eager Loading é apenas o primeiro passo. Neste artigo, abordamos o uso de subqueries complexas integradas no Eloquent através de addSelect, criação de relacionamentos dinâmicos e a importância de criar índices compostos alinhados com suas ordenações mais frequentes.',
                'image' => 'https://images.unsplash.com/photo-1544383835-bda2bc66a55d?auto=format&fit=crop&w=800&q=80',
                'category' => 'Banco de Dados',
                'tags' => ['Banco de Dados', 'Eloquent', 'SQL', 'Performance'],
                'author' => [
                    'name' => 'Caleb Porzio',
                    'avatar' => 'https://unavatar.io/github/calebporzio',
                ],
                'date' => '28 Jun, 2026',
                'read_time' => '12 min'
            ]
        ];

        // Seed some initial comments
        $this->comments = [
            1 => [
                [
                    'id' => 1,
                    'author' => [
                        'name' => 'Caleb Porzio',
                        'avatar' => 'https://unavatar.io/github/calebporzio',
                    ],
                    'texto' => 'A compilação do Tailwind v4 com o Vite está realmente voando! Excelente artigo.',
                    'date' => 'Há 2 horas',
                ],
                [
                    'id' => 2,
                    'author' => [
                        'name' => 'Taylor Otwell',
                        'avatar' => 'https://unavatar.io/github/taylorotwell',
                    ],
                    'texto' => 'Excelente explicação sobre o novo fluxo CSS-first. O ecossistema Laravel 13 está muito bem alinhado com essa versão.',
                    'date' => 'Há 1 hora',
                ]
            ],
            2 => [
                [
                    'id' => 3,
                    'author' => [
                        'name' => 'Jess Archer',
                        'avatar' => 'https://unavatar.io/github/jessarcher',
                    ],
                    'texto' => 'Amei a facilidade de usar o Flux UI. Facilitou muito a criação de modais reativos!',
                    'date' => 'Há 3 dias',
                ]
            ]
        ];
    }
};
?>

<div class="bg-zinc-50 dark:bg-zinc-950 text-zinc-900 dark:text-zinc-50 min-h-screen flex flex-col justify-between antialiased">
    <div>
        <flux:header container class="bg-white dark:bg-zinc-900 border-b border-zinc-200 dark:border-zinc-800">
            <flux:brand href="{{ route('home') }}" name="DevBlog" class="font-bold tracking-tight">
                <x-slot name="logo" class="bg-zinc-900 text-white dark:bg-white dark:text-zinc-900 rounded-lg flex items-center justify-center p-1 w-8 h-8">
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
                <flux:navbar.item href="{{ route('login') }}" icon="arrow-right-end-on-rectangle" wire:navigate>Entrar</flux:navbar.item>
                <flux:button href="{{ route('register') }}" variant="primary" icon="user-plus" wire:navigate class="max-sm:hidden">
                    Cadastrar
                </flux:button>
            </flux:navbar>
        </flux:header>

        @if (session('status'))
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-6">
                <flux:callout variant="success">
                    {{ session('status') }}
                </flux:callout>
            </div>
        @endif

        <!-- Hero Section -->
        <div class="relative overflow-hidden bg-gradient-to-b from-zinc-50 to-white dark:from-zinc-950 dark:to-zinc-900 py-16 sm:py-24 border-b border-zinc-200 dark:border-zinc-800">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10">
                <flux:badge variant="solid" color="zinc" class="mb-4">COMUNIDADE PHP</flux:badge>
                <h1 class="text-4xl sm:text-6xl font-black tracking-tight text-zinc-900 dark:text-white max-w-3xl mx-auto leading-none">
                    Ideias que inspiram a comunidade <span class="bg-gradient-to-r from-violet-600 to-indigo-600 dark:from-violet-400 dark:to-indigo-400 bg-clip-text text-transparent">Laravel & PHP</span>
                </h1>
                <p class="mt-6 text-lg sm:text-xl text-zinc-600 dark:text-zinc-400 max-w-2xl mx-auto">
                    Artigos sobre desenvolvimento, tutoriais de Laravel, dicas de PHP e boas práticas do ecossistema. Participe criando publicações e comentando!
                </p>
                <div class="mt-8 flex justify-center gap-4">
                    <flux:button variant="primary" icon="sparkles" href="#posts">Explorar Artigos</flux:button>
                </div>
            </div>
            
            <!-- Background Decorative Elements -->
            <div class="absolute inset-0 z-0 flex items-center justify-center opacity-30 dark:opacity-20 pointer-events-none">
                <div class="w-[500px] h-[500px] bg-violet-400 dark:bg-violet-600 rounded-full filter blur-3xl mix-blend-multiply animate-pulse"></div>
                <div class="w-[500px] h-[500px] bg-indigo-400 dark:bg-indigo-600 rounded-full filter blur-3xl mix-blend-multiply animate-pulse delay-1000 -ml-40"></div>
            </div>
        </div>

        <!-- Featured Post and Cards Section -->
        <main id="posts" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 scroll-mt-20">
            <!-- Featured Post -->
            <div class="mb-16">
                <flux:heading size="lg" class="mb-6 flex items-center gap-2">
                    <flux:icon name="sparkles" class="text-violet-600 dark:text-violet-400 w-5 h-5" />
                    Destaque da Semana
                </flux:heading>
                
                @if(count($posts) > 0)
                    @php $featured = $posts[0]; @endphp
                    <div class="group relative bg-white dark:bg-zinc-900 rounded-2xl border border-zinc-200 dark:border-zinc-800 overflow-hidden shadow-sm hover:shadow-md transition-shadow duration-300 grid grid-cols-1 lg:grid-cols-2 cursor-pointer">
                        <div class="h-64 lg:h-auto min-h-[300px] relative overflow-hidden">
                            <img src="{{ $featured['image'] }}" alt="{{ $featured['title'] }}" class="absolute inset-0 w-full h-full object-cover group-hover:scale-105 transition-transform duration-500 ease-out" />
                            <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent lg:hidden"></div>
                        </div>
                        <div class="p-8 lg:p-12 flex flex-col justify-between">
                            <div>
                                <flux:badge color="violet" class="mb-4">{{ $featured['category'] }}</flux:badge>
                                <h3 class="text-2xl sm:text-3xl font-bold text-zinc-900 dark:text-white group-hover:text-violet-600 dark:group-hover:text-violet-400 transition-colors">
                                    {{ $featured['title'] }}
                                </h3>
                                <p class="mt-4 text-zinc-600 dark:text-zinc-400 leading-relaxed">
                                    {{ $featured['excerpt'] }}
                                </p>
                            </div>
                            
                            <div class="mt-8 flex items-center justify-between">
                                <div class="flex items-center gap-3">
                                    <img src="{{ $featured['author']['avatar'] }}" alt="{{ $featured['author']['name'] }}" class="w-10 h-10 rounded-full border border-zinc-200 dark:border-zinc-700" />
                                    <div>
                                        <p class="text-sm font-semibold text-zinc-900 dark:text-white">{{ $featured['author']['name'] }}</p>
                                        <p class="text-xs text-zinc-500 dark:text-zinc-400">{{ $featured['date'] }}</p>
                                    </div>
                                </div>
                                <div class="flex items-center gap-1.5 text-xs font-medium text-zinc-500 dark:text-zinc-400 bg-zinc-100 dark:bg-zinc-800 px-2.5 py-1 rounded-full">
                                    <flux:icon name="clock" class="w-3.5 h-3.5" />
                                    {{ $featured['read_time'] }}
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>

            <!-- Posts Grid -->
            <div>
                <flux:heading size="lg" class="mb-6">Últimas Publicações</flux:heading>
                
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach(array_slice($posts, 1) as $post)
                        <flux:card class="group flex flex-col justify-between overflow-hidden !p-0 border border-zinc-200 dark:border-zinc-800 bg-white dark:bg-zinc-900 shadow-sm hover:shadow-md transition-shadow duration-300 cursor-pointer">
                            <div class="h-48 overflow-hidden relative">
                                <img src="{{ $post['image'] }}" alt="{{ $post['title'] }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500 ease-out" />
                            </div>
                            <div class="p-6 flex-grow flex flex-col justify-between">
                                <div>
                                    <div class="flex items-center justify-between mb-3">
                                        <flux:badge color="zinc" variant="subtle">{{ $post['category'] }}</flux:badge>
                                        <div class="flex items-center gap-1 text-xs text-zinc-500 dark:text-zinc-400">
                                            <flux:icon name="clock" class="w-3.5 h-3.5" />
                                            {{ $post['read_time'] }}
                                        </div>
                                    </div>
                                    <h4 class="text-lg font-bold text-zinc-900 dark:text-white group-hover:text-indigo-600 dark:group-hover:text-indigo-400 transition-colors">
                                        {{ $post['title'] }}
                                    </h4>
                                    <p class="mt-2 text-sm text-zinc-600 dark:text-zinc-400 line-clamp-3">
                                        {{ $post['excerpt'] }}
                                    </p>
                                </div>

                                <div class="mt-6 pt-4 border-t border-zinc-100 dark:border-zinc-800/50 flex items-center gap-3">
                                    <img src="{{ $post['author']['avatar'] }}" alt="{{ $post['author']['name'] }}" class="w-8 h-8 rounded-full border border-zinc-200 dark:border-zinc-700" />
                                    <div>
                                        <p class="text-xs font-semibold text-zinc-900 dark:text-white">{{ $post['author']['name'] }}</p>
                                        <p class="text-[10px] text-zinc-500 dark:text-zinc-400">{{ $post['date'] }}</p>
                                    </div>
                                </div>
                            </div>
                        </flux:card>
                    @endforeach
                </div>
            </div>
        </main>
    </div>

    <!-- Footer -->
    <footer class="bg-white dark:bg-zinc-900 border-t border-zinc-200 dark:border-zinc-800 py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col md:flex-row items-center justify-between gap-6">
            <div class="flex items-center gap-2">
                <div class="bg-zinc-900 text-white dark:bg-white dark:text-zinc-900 rounded-lg p-1.5 w-8 h-8 flex items-center justify-center">
                    <flux:icon name="book-open" class="w-4 h-4 text-white dark:text-zinc-900" />
                </div>
                <span class="font-bold tracking-tight text-zinc-950 dark:text-white">DevBlog</span>
            </div>
            
            <div class="flex flex-wrap justify-center gap-x-8 gap-y-2 text-sm text-zinc-500 dark:text-zinc-400">
                <a href="#" class="hover:text-zinc-900 dark:hover:text-white transition-colors">Termos</a>
                <a href="#" class="hover:text-zinc-900 dark:hover:text-white transition-colors">Privacidade</a>
                <a href="#" class="hover:text-zinc-900 dark:hover:text-white transition-colors">Contato</a>
            </div>
            
            <p class="text-xs text-zinc-400 dark:text-zinc-500">
                &copy; {{ date('Y') }} DevBlog. Criado com Laravel & Flux UI.
            </p>
        </div>
    </footer>
</div>