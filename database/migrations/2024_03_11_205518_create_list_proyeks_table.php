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
        Schema::create('list_proyek', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid_list')->unique();
            $table->uuid('proyek_uuid');
            $table->foreign('proyek_uuid')
                ->references('proyek_uuid')
                ->on('proyek')
                ->cascadeOnDelete()
                ->restrictOnUpdate();
            $table->text('deskriprsi');
            $table->uuid('customer_uuid');
            $table->foreign('customer_uuid')->references('customer_uuid')->on('customers')->cascadeOnDelete();
            $table->date('tgl_mulai');
            $table->date('tgl_selesai')->nullable();
            $table->integer('harga');
            $table->string('metode_pembayaran');
            $table->integer('status'); // 0 = open, 1 = progress, 2 = done
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('list_proyek');
    }
};
