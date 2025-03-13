<?php

use App\Enums\ExcursionStatus;
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
        Schema::create('excursions', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->string('title');
            $table->longText('description');

            $table->decimal('price')->nullable();

            $table->longText('header_img');
            $table->longText('gallery');

            $table->string('google_maps_url')->nullable();

            $table->integer('boat_capacity');

            $table->longText('included_in_price')->nullable();

            $table->string('skipper');

            $table->string('status')->default(ExcursionStatus::Published);

            $table->foreignId('category_id')
                ->nullable()
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('user_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('excursions');
    }
};
