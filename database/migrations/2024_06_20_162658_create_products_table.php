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
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('parent_category_id');
            $table->integer('brand_id')->nullable();
            $table->string('name');
            $table->string('slug');
            $table->mediumText('short_description');
            $table->longText('description');
            // $table->enum('qty_type',[1,2,3])->comment('1:200,2:500,3:1000');
            $table->longText('images')->nullable();
            $table->tinyInteger('trending')->default(2)->comment('1 : Yes , 2 : No');
            $table->tinyInteger('status')->default(1)->comment('1 : Active , 2 : In Active');

            // $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
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
