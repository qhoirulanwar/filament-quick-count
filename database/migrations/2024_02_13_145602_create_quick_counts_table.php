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
        Schema::create('quick_counts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('province_id');
            $table->unsignedBigInteger('regency_id');
            $table->unsignedBigInteger('district_id');
            $table->unsignedBigInteger('village_id');
            $table->unsignedBigInteger('caleg_id');
            $table->string('tps');
            $table->unsignedInteger('vote');
            $table->timestamps();

            $table->foreign('province_id')->references('id')->on('provinces')->onDelete('restrict');
            $table->foreign('regency_id')->references('id')->on('regencies')->onDelete('restrict');
            $table->foreign('district_id')->references('id')->on('districts')->onDelete('restrict');
            $table->foreign('village_id')->references('id')->on('villages')->onDelete('restrict');
            $table->foreign('caleg_id')->references('id')->on('calegs')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quick_counts');
    }
};
