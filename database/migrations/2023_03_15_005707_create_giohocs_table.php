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
        Schema::create('giohocs', function (Blueprint $table) {
            $table->string('maGH');
            $table->time('time_begin');
            $table->time('time_end');
            $table->timestamps();

            $table->primary('maGH');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('giohocs');
    }
};
