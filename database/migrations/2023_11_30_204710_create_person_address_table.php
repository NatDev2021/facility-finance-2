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
        Schema::create('person_address', function (Blueprint $table) {
            $table->id();
            $table->foreignId('person_id')->unsigned()->index()->nullable();
            $table->foreign('person_id')->references('id')->on('person')->onDelete('cascade');
            $table->string('zip_code');
            $table->string('country');
            $table->string('state');
            $table->string('city');
            $table->string('street_address');
            $table->string('address_number');
            $table->string('complement');
            $table->string('neighborhood');
            $table->boolean('primary');
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
        Schema::dropIfExists('person_address');
    }
};
