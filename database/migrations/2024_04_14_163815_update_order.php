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
        Schema::table('orders', function (Blueprint $table) {
            $table->string("full_name");
            $table->string("address");
            $table->string("phone_number",12);
            $table->integer("id_user")->nullable();
            $table->json("products_cart")->nullable();
            $table->enum("status_order",["0","1","2","3","4","5"])->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
