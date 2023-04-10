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
        Schema::create('monhocs', function (Blueprint $table) {
            $table->string('maMH');
            $table->string('tenMH');
            $table->date('time_hoc');
            $table->date('time_end');

            $table->timestamps();

            $table->primary('maMH');


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('monhocs');
    }
};
