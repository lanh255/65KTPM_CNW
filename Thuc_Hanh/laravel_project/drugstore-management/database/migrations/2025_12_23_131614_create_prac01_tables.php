<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Tạo bảng medicines
        Schema::create('medicines', function (Blueprint $table) {
            $table->id('medicine_id'); //
            $table->string('name', 255); //
            $table->string('brand', 100)->nullable(); //
            $table->string('dosage', 50); //
            $table->string('form', 50); //
            $table->decimal('price', 10, 2); //
            $table->integer('stock'); //
            $table->timestamps();
        });

        // Tạo bảng sales
        Schema::create('sales', function (Blueprint $table) {
            $table->id('sale_id'); //
            $table->unsignedBigInteger('medicine_id'); //
            $table->integer('quantity'); //
            $table->dateTime('sale_date'); //
            $table->string('customer_phone', 10)->nullable(); //
            $table->foreign('medicine_id')->references('medicine_id')->on('medicines')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sales');
        Schema::dropIfExists('medicines');
    }
};