<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('products', function (Blueprint $t) {
            $t->id();
            $t->string('name');
            $t->string('slug')->unique();
            $t->text('description')->nullable();
            $t->unsignedInteger('price_twd');
            $t->unsignedInteger('stock')->default(0);
            $t->string('status')->default('ACTIVE'); // ACTIVE/DRAFT/ARCHIVED
            $t->string('cover_image_url')->nullable();
            $t->timestamp('published_at')->nullable();
            $t->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
