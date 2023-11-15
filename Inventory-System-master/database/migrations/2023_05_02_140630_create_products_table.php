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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('sloc_code');
            $table->string('material_code');
            $table->string('sloc_name');
            $table->string('description')->nullable();
            $table->string('uom');
            $table->integer('sap_qty')->nullable();
            $table->integer('ac_qty')->nullable();
            $table->integer('rec_qty')->nullable();
            $table->integer('variance_qty')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
