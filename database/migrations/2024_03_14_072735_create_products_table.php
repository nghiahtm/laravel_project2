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
            $table->string("name");
            $table->integer("manufacturer_id")->nullable();
            $table->string("image_url")->nullable();
            $table->float("selling_price")->nullable();
            $table->float("original_price")->nullable();
            $table->string("processor")->nullable();
            $table->string("ram")->nullable();
            $table->string("os")->nullable();
            $table->string("storage")->nullable();
            $table->float("display")->nullable();
            $table->integer("reviews")->nullable();
//            $table->integer("quantity")->nullable();
//            $table->text("description")->nullable();
//            $table->timestamps();
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
