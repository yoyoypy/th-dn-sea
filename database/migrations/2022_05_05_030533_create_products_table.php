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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('category_id')->nullable()->references('id')->on('category')->onDelete('cascade');
            $table->integer('category_details_id')->nullable()->references('id')->on('category_details')->onDelete('cascade');
            $table->integer('category_type_id')->nullable()->references('id')->on('category_types')->onDelete('cascade');
            $table->string('name');
            $table->longText('description');
            $table->string('slug')->unique();
            $table->boolean('is_premium')->default(false);
            $table->boolean('is_sold')->default(false);

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
        Schema::dropIfExists('products');
    }
};
