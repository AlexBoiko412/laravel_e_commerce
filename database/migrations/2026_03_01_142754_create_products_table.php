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
        Schema::create('products', function (Blueprint $table) {
            $table->unsignedMediumInteger('id', true);
            $table->unsignedSmallInteger('brand_id')->nullable()->index();
            $table->string('name', 150);
            $table->string('slug', 170)->unique();
            $table->text('description');
            $table->boolean('is_active')->default(true)->index();
            $table->softDeletes(); // Integrity: Keeps product record for old orders
            $table->timestamps();

            $table->foreign('brand_id')
                ->references('id')
                ->on('brands')
                ->onUpdate('cascade')
                ->nullOnDelete();
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
