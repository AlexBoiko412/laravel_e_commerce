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
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')->constrained()->onUpdate('cascade')->cascadeOnDelete();

            $table->unsignedTinyInteger('type')->index();
            $table->string('first_name', 50);
            $table->string('last_name', 50);
            $table->string('phone', 20);
            $table->string('line1', 150);
            $table->string('line2', 150)->nullable();
            $table->string('city', 100);
            $table->string('state', 100);
            $table->string('postal_code', 15);
            $table->char('country_code', 2)->index();
            $table->boolean('is_default')->default(false)->index();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('addresses');
    }
};
