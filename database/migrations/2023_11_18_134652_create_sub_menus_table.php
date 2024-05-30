<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('conf_sub_menus', function (Blueprint $table) {
            $table->id();
            $table->foreignId('menu_id')->unsigned()->index()->nullable();
            $table->foreign('menu_id')->references('id')->on('conf_menu')->onDelete('cascade');
            $table->string('description');
            $table->string('icon');
            $table->string('route');
            $table->boolean('actived');
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
        Schema::dropIfExists('sub_menus');
    }
}
