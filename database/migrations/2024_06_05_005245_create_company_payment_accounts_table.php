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
        Schema::create('company_banks_accounts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->unsigned()->index()->nullable();
            $table->foreign('company_id')->references('id')->on('company')->onDelete('cascade');
            $table->foreignId('bank_id')->unsigned()->index()->nullable();
            $table->foreign('bank_id')->references('id')->on('banks')->onDelete('cascade');
            $table->string('description');
            $table->string('agency',length: 4);
            $table->string('account');
            $table->string('account_dig');
            $table->string('pix_key');
            $table->decimal('account_balance');            
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
        Schema::dropIfExists('company_payment_accounts');
    }
};
