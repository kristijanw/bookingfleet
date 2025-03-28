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
        Schema::table('orders', function (Blueprint $table) {
            $table->string('title')->nullable()->after('id');
            $table->string('email')->nullable()->after('title');
            $table->string('phone')->nullable()->after('email');

            $table->string('trip_day')->nullable()->after('total_price');
            $table->string('start_time')->nullable()->after('trip_day');
            $table->string('location')->nullable()->after('start_time');

            $table->string('count_adults')->nullable()->after('location');
            $table->string('count_children')->nullable()->after('count_adults');
            $table->string('count_children_under')->nullable()->after('count_children');
            $table->string('adult_eat')->nullable()->after('count_children_under');
            $table->string('children_eat')->nullable()->after('adult_eat');
            $table->string('children_price')->nullable()->after('children_eat');
            $table->string('skipper')->nullable()->after('children_price');
            $table->string('skipper_price')->nullable()->after('skipper');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            //
        });
    }
};
