<?php

use App\Enums\CouponType;
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
        Schema::create('coupons', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->string('name');
            $table->string('code');
            $table->string('type')->default(CouponType::Percentage);
            $table->integer('discount');
            $table->integer('max_uses');
            $table->integer('times_used')->default(0);
            $table->date('valid_to')->default(now()->addMonth());

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coupons');
    }
};
