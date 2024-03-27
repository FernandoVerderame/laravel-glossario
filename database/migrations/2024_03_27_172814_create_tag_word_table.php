<?php

use App\Models\Tag;
use App\Models\Word;
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
        Schema::create('tag_word', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Tag::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Word::class)->constrained()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tag_word');
    }
};
