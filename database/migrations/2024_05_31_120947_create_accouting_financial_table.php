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
        Schema::create('accouting_financial', function (Blueprint $table) {
            $table->id();
            $table->string('account');
            $table->string('name');
            $table->string('description');
            $table->foreignId('id_user_ins')->unsigned()->index()->nullable();
            $table->foreign('id_user_ins')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('accouting_financial');
    }
};
