<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('postagens', function (Blueprint $table) {
            $table->id();
            $table->string('titulo');
            $table->text('conteudo');
            $table->string('imagem')->nullable();
            $table->json('tags')->default(new \Illuminate\Database\Query\Expression('(JSON_ARRAY())'));
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->enum('status', ['rascunho', 'publicado'])->default('rascunho');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('postagens');
    }
};
