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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable()->index();

            $table->string('order_number', 32)->unique();
            $table->unsignedTinyInteger('status')->default(0)->index();
            $table->char('currency', 3)->default('USD');

            $table->decimal('total_price', 12, 2)->unsigned();
            $table->decimal('tax_amount', 12, 2)->unsigned();
            $table->decimal('shipping_amount', 12, 2)->unsigned();

            $table->unsignedBigInteger('shipping_address_id')->index();
            $table->unsignedBigInteger('billing_address_id')->index();

            $table->timestamps();

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onUpdate('cascade')
                ->nullOnDelete();

            $table->foreign('shipping_address_id')
                ->references('id')
                ->on('addresses')
                ->onUpdate('cascade')
                ->restrictOnDelete();

            $table->foreign('billing_address_id')
                ->references('id')
                ->on('addresses')
                ->onUpdate('cascade')
                ->restrictOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
