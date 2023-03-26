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
        Schema::create('cate_books', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('cate_id');
            $table->unsignedBigInteger('book_id');
            $table->timestamps();
            $table->softDeletes();
            
            $table->foreign('cate_id')->references('id')->on('categories')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign('book_id')->references('id')->on('books')->cascadeOnDelete()->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cate_books');
    }
};