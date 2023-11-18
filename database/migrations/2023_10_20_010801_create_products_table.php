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
            $table->unsignedBigInteger("category_id");
            $table->unsignedBigInteger("brand_id");
            $table->string("name");
            $table->string("slug");
            $table->string("author")->nullable();
            $table->mediumText("small_description")->nullable();
            $table->longText("description")->nullable();

            $table->integer("original_price");
            $table->integer("selling_price");
            $table->integer("quantity");
            $table->tinyInteger("trending")->default("1"); //1 là trending 2 là không trending
            $table->tinyInteger("featured")->default("1"); //1 là trending 2 là không trending
            $table->tinyInteger("status")->default("1"); //1 là hiện 2 là ẩn

            $table->string("meta_title")->nullable();
            $table->mediumText("meta_keyword")->nullable();
            $table->mediumText("meta_description")->nullable();

            $table->foreign("category_id")->references("id")->on("categories")->onDelete("cascade");
            $table->foreign("brand_id")->references("id")->on("brands")->onDelete("cascade");
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
