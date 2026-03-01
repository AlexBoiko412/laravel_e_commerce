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
        Schema::create('product_variants', function (Blueprint $table) {
            $table->id();
            $table->unsignedMediumInteger('product_id')->index();
            $table->string('sku', 50)->unique();

            $table->decimal('price', 10, 2)->unsigned();
            $table->decimal('compare_at_price', 10, 2)->unsigned()->nullable();
            $table->decimal('cost_price', 10, 2)->unsigned()->nullable();

            $table->unsignedMediumInteger('quantity_in_stock')->default(0)->index();
            $table->char('weight_unit', 2)->default('kg');
            $table->decimal('weight', 6, 2)->unsigned()->nullable();
            $table->json('metadata')->nullable();
            $table->timestamps();

            $table->foreign('product_id')
                ->references('id')
                ->on('products')
                ->onUpdate('cascade')
                ->cascadeOnDelete();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_variants');
    }
};
