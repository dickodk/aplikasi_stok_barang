<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   public function up(): void
    {
        Schema::create('barang_keluars', function (Blueprint $table) {
            $table->id();
            // $table->integer('id_customer')->nullable();
            $table->date('tgl_pengiriman');
            $table->string('no_surat_jalan', 50);
            $table->integer('diskon');
            $table->timestamps();
            $table->foreignId('customers_id')->constrained()->onDelete('restrict')->onUpdate('restrict');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barang_keluars');
    }
};
