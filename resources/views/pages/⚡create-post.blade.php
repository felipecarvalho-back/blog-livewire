<?php

use Livewire\Component;
use Livewire\Attributes\Title;

new #[Title('Criar Postagem - DevBlog')] class extends Component
{
    public string $titulo = '';
    public string $conteudo = '';
    public string $imagem = '';
    public string $tagsInput = 'Laravel, PHP, Livewire';
    public string $status = 'publicado'; // 'rascunho' or 'publicado'
    public string $categoria = 'Laravel';

    public array $categoriasDisponiveis = [
        'Laravel',
        'PHP Moderno',
        'Livewire & Flux',
        'Tailwind CSS',
        'Banco de Dados & Eloquent',
        'DevOps & Deploy',
        'Dicas & Boas Práticas',
    ];

    public function getParsedTagsProperty(): array
    {
        if (empty(trim($this->tagsInput))) {
            return [];
        }

        return array_values(array_filter(array_map('trim', explode(',', $this->tagsInput))));
    }

    public function saveDraft(): void
    {
        $this->status = 'rascunho';
        $this->submit();
    }

    public function submit(): void
    {
        $this->validate([
            'titulo' => 'required|min:5|max:255',
            'conteudo' => 'required|min:20',
            'imagem' => 'nullable|url',
            'tagsInput' => 'nullable|string',
            'status' => 'required|in:rascunho,publicado',
            'categoria' => 'required|string',
        ], [
            'titulo.required' => 'O título do artigo é obrigatório.',
            'titulo.min' => 'O título deve ter pelo menos 5 caracteres.',
            'conteudo.required' => 'O conteúdo do artigo é obrigatório.',
            'conteudo.min' => 'O conteúdo deve ter pelo menos 20 caracteres.',
            'imagem.url' => 'A imagem de capa deve ser uma URL válida (ex: https://...).',
            'categoria.required' => 'Selecione uma categoria principal.',
        ]);

        $statusLabel = $this->status === 'publicado' ? 'publicado' : 'salvo como rascunho';

        session()->flash('status', "Artigo \"{$this->titulo}\" foi {$statusLabel} com sucesso! (Simulado)");

        $this->redirect(route('home'), navigate: true);
    }
};
?>

<div class="bg-zinc-50 dark:bg-zinc-950 text-zinc-900 dark:text-zinc-50 min-h-screen flex flex-col justify-between antialiased">
    <div>
        <x-nav />

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
            <!-- Header Breadcrumb & Actions -->
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-8 border-b border-zinc-200 dark:border-zinc-800">
                <div class="space-y-1">
                    <div class="flex items-center gap-2 text-xs font-medium text-zinc-500 dark:text-zinc-400">
                        <a href="{{ route('home') }}" wire:navigate class="hover:text-violet-600 dark:hover:text-violet-400 transition-colors flex items-center gap-1">
                            <flux:icon name="arrow-left" class="w-3.5 h-3.5" />
                            Voltar ao Blog
                        </a>
                        <span>/</span>
                        <span class="text-zinc-700 dark:text-zinc-300">Criar Artigo</span>
                    </div>
                    <h1 class="text-2xl sm:text-3xl font-black tracking-tight text-zinc-900 dark:text-white flex items-center gap-2.5">
                        <flux:icon name="pencil-square" class="w-7 h-7 text-violet-600 dark:text-violet-400" />
                        Nova Publicação
                    </h1>
                    <p class="text-sm text-zinc-600 dark:text-zinc-400">
                        Escreva e compartilhe conhecimento com a comunidade PHP & Laravel.
                    </p>
                </div>

                <div class="flex items-center gap-3">
                    <flux:modal.trigger name="post-preview-modal">
                        <flux:button variant="outline" icon="eye">
                            Pré-visualizar
                        </flux:button>
                    </flux:modal.trigger>
                    <flux:button wire:click="saveDraft" variant="filled" icon="document-duplicate">
                        Salvar Rascunho
                    </flux:button>
                    <flux:button wire:click="submit" variant="primary" icon="paper-airplane">
                        Publicar Artigo
                    </flux:button>
                </div>
            </div>

            <!-- Form Content (2 Columns) -->
            <form wire:submit="submit" class="mt-8 grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Main Column: Title & Content -->
                <div class="lg:col-span-2 space-y-6">
                    <!-- Title Card -->
                    <div class="bg-white dark:bg-zinc-900 p-6 rounded-2xl border border-zinc-200 dark:border-zinc-800 shadow-xs space-y-6">
                        <flux:field>
                            <flux:label class="text-base font-semibold">Título do Artigo</flux:label>
                            <flux:input 
                                wire:model.live.debounce.300ms="titulo" 
                                placeholder="Ex: Criando APIs Robustas com Laravel 13 e Livewire v4" 
                                class="text-lg font-medium"
                            />
                            <flux:description>Um título chamativo e descritivo ajuda mais leitores a encontrarem sua publicação.</flux:description>
                            <flux:error name="titulo" />
                        </flux:field>

                        <!-- Formatting Helper Bar Simulation -->
                        <div class="flex flex-wrap items-center justify-between gap-2 pt-2 border-t border-zinc-100 dark:border-zinc-800 text-xs text-zinc-500 dark:text-zinc-400">
                            <div class="flex items-center gap-1.5">
                                <span class="font-medium text-zinc-700 dark:text-zinc-300">Formatos suportados:</span>
                                <flux:badge size="sm" variant="subtle" color="zinc">Markdown</flux:badge>
                                <flux:badge size="sm" variant="subtle" color="zinc">Code Snippets</flux:badge>
                                <flux:badge size="sm" variant="subtle" color="zinc">Giphy / Imagens</flux:badge>
                            </div>
                            <span class="text-[11px]">{{ str_word_count($conteudo) }} palavras</span>
                        </div>

                        <!-- Content Field -->
                        <flux:field>
                            <flux:label class="text-base font-semibold">Conteúdo da Publicação</flux:label>
                            <flux:textarea 
                                wire:model.live.debounce.300ms="conteudo" 
                                rows="14" 
                                placeholder="Comece a redigir seu artigo aqui... Você pode incluir blocos de código PHP, explicações conceituais e boas práticas." 
                                class="font-mono text-sm leading-relaxed"
                            />
                            <flux:description>Escreva detalhes ricos, passos explicativos e trechos de código formatados.</flux:description>
                            <flux:error name="conteudo" />
                        </flux:field>
                    </div>

                    <!-- Author Info Callout -->
                    <div class="bg-gradient-to-r from-violet-50 to-indigo-50 dark:from-violet-950/40 dark:to-indigo-950/40 border border-violet-200/70 dark:border-violet-800/40 rounded-2xl p-5 flex items-center gap-4">
                        <img src="https://unavatar.io/github/felipecarvalho-back" alt="Autor" class="w-12 h-12 rounded-full border-2 border-white dark:border-zinc-800 shadow-xs shrink-0" />
                        <div class="grow">
                            <p class="text-sm font-bold text-zinc-900 dark:text-white">Publicando como <span class="text-violet-600 dark:text-violet-400">Felipe Carvalho</span></p>
                            <p class="text-xs text-zinc-600 dark:text-zinc-400 mt-0.5">Sua publicação será associada ao seu perfil de desenvolvedor e compartilhada no feed principal.</p>
                        </div>
                    </div>
                </div>

                <!-- Sidebar Column: Meta, Image & Tags -->
                <div class="space-y-6">
                    <!-- Status & Category Card -->
                    <div class="bg-white dark:bg-zinc-900 p-6 rounded-2xl border border-zinc-200 dark:border-zinc-800 shadow-xs space-y-5">
                        <flux:heading size="base" class="font-semibold flex items-center gap-2">
                            <flux:icon name="adjustments-horizontal" class="w-4 h-4 text-violet-600 dark:text-violet-400" />
                            Configurações de Publicação
                        </flux:heading>

                        <flux:field>
                            <flux:label>Status</flux:label>
                            <flux:select wire:model="status">
                                <flux:select.option value="publicado">Publicado (Visível no Feed)</flux:select.option>
                                <flux:select.option value="rascunho">Rascunho (Apenas Privado)</flux:select.option>
                            </flux:select>
                            <flux:error name="status" />
                        </flux:field>

                        <flux:field>
                            <flux:label>Categoria Principal</flux:label>
                            <flux:select wire:model="categoria">
                                @foreach($categoriasDisponiveis as $cat)
                                    <flux:select.option value="{{ $cat }}">{{ $cat }}</flux:select.option>
                                @endforeach
                            </flux:select>
                            <flux:error name="categoria" />
                        </flux:field>
                    </div>

                    <!-- Cover Image Card -->
                    <div class="bg-white dark:bg-zinc-900 p-6 rounded-2xl border border-zinc-200 dark:border-zinc-800 shadow-xs space-y-4">
                        <flux:heading size="base" class="font-semibold flex items-center gap-2">
                            <flux:icon name="photo" class="w-4 h-4 text-violet-600 dark:text-violet-400" />
                            Imagem de Capa
                        </flux:heading>

                        <flux:field>
                            <flux:label>URL da Imagem</flux:label>
                            <flux:input 
                                wire:model.live.debounce.400ms="imagem" 
                                placeholder="https://images.unsplash.com/..." 
                                icon="link"
                            />
                            <flux:description>Insira o link direto de uma imagem de alta qualidade (Unsplash, Pexels, etc.).</flux:description>
                            <flux:error name="imagem" />
                        </flux:field>

                        <!-- Live Image Preview Box -->
                        <div class="mt-2">
                            <p class="text-xs font-semibold text-zinc-500 dark:text-zinc-400 mb-2">Pré-visualização da Capa:</p>
                            <div class="relative h-36 rounded-xl border border-zinc-200 dark:border-zinc-800 overflow-hidden bg-zinc-100 dark:bg-zinc-800/60 flex items-center justify-center">
                                @if($imagem)
                                    <img src="{{ $imagem }}" alt="Capa" class="absolute inset-0 w-full h-full object-cover" />
                                @else
                                    <div class="flex flex-col items-center gap-1.5 text-zinc-400 dark:text-zinc-500">
                                        <flux:icon name="photo" class="w-8 h-8 opacity-60" />
                                        <span class="text-xs">Nenhuma imagem informada</span>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Tags Card -->
                    <div class="bg-white dark:bg-zinc-900 p-6 rounded-2xl border border-zinc-200 dark:border-zinc-800 shadow-xs space-y-4">
                        <flux:heading size="base" class="font-semibold flex items-center gap-2">
                            <flux:icon name="tag" class="w-4 h-4 text-violet-600 dark:text-violet-400" />
                            Tags & Assuntos
                        </flux:heading>

                        <flux:field>
                            <flux:label>Tags (separadas por vírgula)</flux:label>
                            <flux:input 
                                wire:model.live.debounce.200ms="tagsInput" 
                                placeholder="PHP, Laravel, Eloquent" 
                            />
                            <flux:error name="tagsInput" />
                        </flux:field>

                        <!-- Live Tags Badges Preview -->
                        <div>
                            <p class="text-xs font-semibold text-zinc-500 dark:text-zinc-400 mb-2">Tags ativas:</p>
                            <div class="flex flex-wrap gap-1.5 min-h-[30px] p-2 bg-zinc-50 dark:bg-zinc-950/60 rounded-lg border border-zinc-200/60 dark:border-zinc-800/60">
                                @forelse($this->parsedTags as $tag)
                                    <flux:badge size="sm" color="violet" variant="subtle">#{{ $tag }}</flux:badge>
                                @empty
                                    <span class="text-xs text-zinc-400 dark:text-zinc-600 italic">Nenhuma tag informada</span>
                                @endforelse
                            </div>
                        </div>
                    </div>

                    <!-- Guidelines Card -->
                    <div class="bg-zinc-100/60 dark:bg-zinc-900/40 p-5 rounded-2xl border border-dashed border-zinc-300 dark:border-zinc-800 space-y-2">
                        <p class="text-xs font-bold uppercase tracking-wider text-zinc-700 dark:text-zinc-300 flex items-center gap-1.5">
                            <flux:icon name="light-bulb" class="w-4 h-4 text-amber-500" />
                            Boas Práticas
                        </p>
                        <ul class="text-xs text-zinc-600 dark:text-zinc-400 space-y-1.5 list-disc list-inside">
                            <li>Escreva títulos objetivos e claros.</li>
                            <li>Inclua exemplos reais de código PHP.</li>
                            <li>Revise links e referências externas.</li>
                        </ul>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-white dark:bg-zinc-900 border-t border-zinc-200 dark:border-zinc-800 py-10 mt-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col md:flex-row items-center justify-between gap-6">
            <div class="flex items-center gap-2">
                <div class="bg-zinc-900 text-white dark:bg-white dark:text-zinc-900 rounded-lg p-1.5 w-8 h-8 flex items-center justify-center">
                    <flux:icon name="book-open" class="w-4 h-4 text-white dark:text-zinc-900" />
                </div>
                <span class="font-bold tracking-tight text-zinc-950 dark:text-white">DevBlog</span>
            </div>
            
            <p class="text-xs text-zinc-400 dark:text-zinc-500">
                &copy; {{ date('Y') }} DevBlog. Criado com Laravel, Livewire & Flux UI.
            </p>
        </div>
    </footer>

    <!-- Modal: Pré-visualização do Post -->
    <flux:modal name="post-preview-modal" class="min-w-[22rem] md:min-w-[42rem]">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">Pré-visualização do Artigo</flux:heading>
                <flux:text class="mt-1">Veja como a sua publicação será exibida para os outros leitores.</flux:text>
            </div>

            <!-- Card Preview Header -->
            <div class="relative h-48 md:h-60 rounded-xl overflow-hidden bg-zinc-900">
                @if($imagem)
                    <img src="{{ $imagem }}" class="absolute inset-0 w-full h-full object-cover" />
                @else
                    <div class="absolute inset-0 bg-gradient-to-br from-violet-600 to-indigo-800"></div>
                @endif
                <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/40 to-transparent"></div>
                <div class="absolute bottom-4 left-4 right-4 md:bottom-6 md:left-6 md:right-6">
                    <flux:badge color="violet" class="mb-2">{{ $categoria }}</flux:badge>
                    <h2 class="text-xl md:text-2xl font-black text-white leading-tight">
                        {{ $titulo ?: 'Título do seu artigo aparecerá aqui' }}
                    </h2>
                </div>
            </div>

            <!-- Author & Metadata -->
            <div class="flex items-center justify-between border-b border-zinc-150 dark:border-zinc-800 pb-4">
                <div class="flex items-center gap-3">
                    <img src="https://unavatar.io/github/felipecarvalho-back" class="w-9 h-9 rounded-full border border-zinc-200 dark:border-zinc-700" />
                    <div>
                        <p class="text-sm font-semibold text-zinc-900 dark:text-white">Felipe Carvalho</p>
                        <p class="text-xs text-zinc-500 dark:text-zinc-400">Hoje &bull; {{ $status === 'publicado' ? 'Publicado' : 'Rascunho' }}</p>
                    </div>
                </div>
                <div class="flex items-center gap-1.5 text-xs font-semibold text-zinc-500 dark:text-zinc-400">
                    <flux:icon name="clock" class="w-3.5 h-3.5" />
                    ~3 min de leitura
                </div>
            </div>

            <!-- Article Body Preview -->
            <div class="text-zinc-750 dark:text-zinc-300 leading-relaxed text-sm md:text-base space-y-4 max-h-60 overflow-y-auto pr-2">
                @if($conteudo)
                    <p class="whitespace-pre-line">{{ $conteudo }}</p>
                @else
                    <p class="text-zinc-400 italic">Nenhum conteúdo digitado ainda...</p>
                @endif
            </div>

            <!-- Tags -->
            @if(count($this->parsedTags) > 0)
                <div class="flex flex-wrap gap-1.5 pt-2 border-t border-zinc-150 dark:border-zinc-800">
                    @foreach($this->parsedTags as $tag)
                        <flux:badge color="zinc" size="sm" variant="subtle">#{{ $tag }}</flux:badge>
                    @endforeach
                </div>
            @endif

            <!-- Modal Action Buttons -->
            <div class="flex justify-end gap-2 pt-4">
                <flux:modal.close>
                    <flux:button>Fechar Preview</flux:button>
                </flux:modal.close>
            </div>
        </div>
    </flux:modal>
</div>
