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
        Schema::create('gangas', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->text('url');
            $table->bigInteger('category')->unsigned()->nullable();
            $table->integer('likes')->unsigned();
            $table->integer('unlikes')->unsigned();
            $table->double('price')->unsigned();
            $table->double('price_sale')->unsigned();
            $table->boolean('available');
            $table->bigInteger('user_id')->unsigned()->nullable();
            $table->timestamps();

            $table->foreign('category')->references('id')->on('categories');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('gangas', function (Blueprint $table) {
            Schema::drop('gangas');
            $table->dropForeign('gangas_usuari_id_foreign');
            $table->dropForeign('categories_category_foreign');
        });
    }
};
