<?php

use Illuminate\Support\Str;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\Attributes\Title;
use App\Models\Postagem;

new #[Title('Home')] class extends Component
{
    public array $posts = [];

    public function mount(): void
    {
        $this->posts = Postagem::with('user')
            ->where('status', 'publicado')
            ->orderBy('id', 'desc')
            ->get()
            ->toArray();
    }
};
?>

<div class="bg-zinc-50 dark:bg-zinc-950 text-zinc-900 dark:text-zinc-50 min-h-screen flex flex-col justify-between antialiased">
    <div>
        
        <x-nav />


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
                    @php
                        $featured = $posts[0];
                        $featuredAuthor = $featured['user']['name'] ?? 'Autor';
                        $featuredReadTime = max(1, (int) ceil(str_word_count(strip_tags($featured['conteudo'])) / 200));
                    @endphp
                    <div class="group relative bg-white dark:bg-zinc-900 rounded-2xl border border-zinc-200 dark:border-zinc-800 overflow-hidden shadow-sm hover:shadow-md transition-shadow duration-300 grid grid-cols-1 lg:grid-cols-2 cursor-pointer">
                        <div class="h-64 lg:h-auto min-h-[300px] relative overflow-hidden">
                            <img src="{{ $featured['imagem'] ?: 'https://images.unsplash.com/photo-1555066931-4365d14bab8c?auto=format&fit=crop&w=1170&q=80' }}" alt="{{ $featured['titulo'] }}" class="absolute inset-0 w-full h-full object-cover group-hover:scale-105 transition-transform duration-500 ease-out" />
                            <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent lg:hidden"></div>
                        </div>
                        <div class="p-8 lg:p-12 flex flex-col justify-between">
                            <div>
                                @if(!empty($featured['tags']))
                                    <div class="flex flex-wrap gap-2 mb-4">
                                        @foreach(array_slice($featured['tags'], 0, 3) as $tag)
                                            <flux:badge color="violet">{{ $tag }}</flux:badge>
                                        @endforeach
                                    </div>
                                @else
                                    <flux:badge color="violet" class="mb-4">Artigo</flux:badge>
                                @endif
                                <h3 class="text-2xl sm:text-3xl font-bold text-zinc-900 dark:text-white group-hover:text-violet-600 dark:group-hover:text-violet-400 transition-colors">
                                    {{ $featured['titulo'] }}
                                </h3>
                                <p class="mt-4 text-zinc-600 dark:text-zinc-400 leading-relaxed">
                                    {{ Str::limit(strip_tags($featured['conteudo']), 220) }}
                                </p>
                            </div>
                            
                            <div class="mt-8 flex items-center justify-between">
                                <div class="flex items-center gap-3">
                                    <img src="https://ui-avatars.com/api/?name={{ urlencode($featuredAuthor) }}&background=7c3aed&color=fff" alt="{{ $featuredAuthor }}" class="w-10 h-10 rounded-full border border-zinc-200 dark:border-zinc-700" />
                                    <div>
                                        <p class="text-sm font-semibold text-zinc-900 dark:text-white">{{ $featuredAuthor }}</p>
                                        <p class="text-xs text-zinc-500 dark:text-zinc-400">{{ Carbon::parse($featured['created_at'])->format('d/m/Y') }}</p>
                                    </div>
                                </div>
                                <div class="flex items-center gap-1.5 text-xs font-medium text-zinc-500 dark:text-zinc-400 bg-zinc-100 dark:bg-zinc-800 px-2.5 py-1 rounded-full">
                                    <flux:icon name="clock" class="w-3.5 h-3.5" />
                                    {{ $featuredReadTime }} min de leitura
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="bg-white dark:bg-zinc-900 rounded-2xl border border-zinc-200 dark:border-zinc-800 p-12 text-center">
                        <p class="text-zinc-600 dark:text-zinc-400">Nenhuma publicação encontrada no momento.</p>
                    </div>
                @endif
            </div>

            <!-- Posts Grid -->
            @if(count($posts) > 1)
                <div>
                    <flux:heading size="lg" class="mb-6">Últimas Publicações</flux:heading>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                        @foreach(array_slice($posts, 1) as $post)
                            @php
                                $postAuthor = $post['user']['name'] ?? 'Autor';
                                $postReadTime = max(1, (int) ceil(str_word_count(strip_tags($post['conteudo'])) / 200));
                            @endphp
                            <flux:card class="group flex flex-col justify-between overflow-hidden !p-0 border border-zinc-200 dark:border-zinc-800 bg-white dark:bg-zinc-900 shadow-sm hover:shadow-md transition-shadow duration-300 cursor-pointer">
                                <div class="h-48 overflow-hidden relative">
                                    <img src="{{ $post['imagem'] ?: 'https://images.unsplash.com/photo-1555066931-4365d14bab8c?auto=format&fit=crop&w=1170&q=80' }}" alt="{{ $post['titulo'] }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500 ease-out" />
                                </div>
                                <div class="p-6 flex-grow flex flex-col justify-between">
                                    <div>
                                        <div class="flex items-center justify-between mb-3">
                                            <flux:badge color="zinc" variant="subtle">{{ $post['tags'][0] ?? 'Artigo' }}</flux:badge>
                                            <div class="flex items-center gap-1 text-xs text-zinc-500 dark:text-zinc-400">
                                                <flux:icon name="clock" class="w-3.5 h-3.5" />
                                                {{ $postReadTime }} min de leitura
                                            </div>
                                        </div>
                                        <h4 class="text-lg font-bold text-zinc-900 dark:text-white group-hover:text-indigo-600 dark:group-hover:text-indigo-400 transition-colors">
                                            {{ $post['titulo'] }}
                                        </h4>
                                        <p class="mt-2 text-sm text-zinc-600 dark:text-zinc-400 line-clamp-3">
                                            {{ Str::limit(strip_tags($post['conteudo']), 150) }}
                                        </p>
                                    </div>

                                    <div class="mt-6 pt-4 border-t border-zinc-100 dark:border-zinc-800/50 flex items-center gap-3">
                                        <img src="https://ui-avatars.com/api/?name={{ urlencode($postAuthor) }}&background=7c3aed&color=fff" alt="{{ $postAuthor }}" class="w-8 h-8 rounded-full border border-zinc-200 dark:border-zinc-700" />
                                        <div>
                                            <p class="text-xs font-semibold text-zinc-900 dark:text-white">{{ $postAuthor }}</p>
                                            <p class="text-[10px] text-zinc-500 dark:text-zinc-400">{{ Carbon::parse($post['created_at'])->format('d/m/Y') }}</p>
                                        </div>
                                    </div>
                                </div>
                            </flux:card>
                        @endforeach
                    </div>
                </div>
            @endif
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