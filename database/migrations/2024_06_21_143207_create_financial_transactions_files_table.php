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
        Schema::create('financial_transactions_files', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('transaction_id')->unsigned()->index()->nullable();
            $table->foreign('transaction_id')->references('id')->on('financial_transactions')->onDelete('cascade');
            $table->string('file_name');
            $table->string('file_size');
            $table->string('mime_type');
            $table->string('path');
            $table->foreignId('id_user_ins')->unsigned()->index()->nullable();
            $table->foreign('id_user_ins')->references('id')->on('users')->onDelete('cascade'); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('financial_transactions_files');
    }
};
