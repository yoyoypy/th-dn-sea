<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('biddings', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('product_id')
            ->reference('id')
            ->on('products')
            ->onDelete('cascade');

            $table->bigInteger('user_id')
            ->reference('id')
            ->on('users')
            ->onDelete('cascade');

            $table->bigInteger('bid_price');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('biddings');
    }
};
