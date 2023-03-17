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
        Schema::create('phonghocs', function (Blueprint $table) {
            $table->id();
            $table->string('namePH');
            $table->string('maMH');
            $table->string('maGV');
            $table->string('maLop');
            $table->integer('tinhtrang');
            $table->timestamps();


            $table->foreign('maMH')->references('maMH')->on('monhocs');
            $table->foreign('maGV')->references('maGV')->on('giaoviens');
            $table->foreign('maLop')->references('maLop')->on('lophocs');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('phonghocs');
    }
};
