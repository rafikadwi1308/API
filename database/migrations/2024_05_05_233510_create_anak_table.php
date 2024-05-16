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
        Schema::create('anak', function (Blueprint $table) {
            $table->string('nik_anak')->primary();
            $table->string('nama_anak');
            $table->string('tempat_lahir_anak');
            $table->date('tanggal_lahir_anak');
            $table->integer('anak_ke');
            $table->string('gol_darah_anak');
            $table->string('jenis_kelamin_anak');
            $table->string('no_kk'); 
            $table->timestamps();
            $table->foreign('no_kk')
            ->references('no_kk')
            ->on('orang_tua')
            ->onUpdate('cascade')
            ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('anak');
    }
};
