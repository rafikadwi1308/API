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
        Schema::create('detail_posyandu', function (Blueprint $table) {
            $table->unsignedBigInteger('id_posyandu');
            $table->foreign('id_posyandu')->references('id_posyandu')->on('posyandu')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('id_vaksin');
            $table->foreign('id_vaksin')->references('id_vaksin')->on('imunisasi')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_posyandu');
    }
};
