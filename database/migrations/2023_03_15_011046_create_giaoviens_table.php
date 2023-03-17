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
        Schema::create('giaoviens', function (Blueprint $table) {
            $table->string('maGV');
            $table->string('tenGV');
            $table->string('maMH');
            $table->timestamps();

            $table->primary('maGV');
            $table->foreign('maMH')->references('maMH')->on('monhocs');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('giaoviens');
    }
};
