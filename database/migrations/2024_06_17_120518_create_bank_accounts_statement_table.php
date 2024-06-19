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
        Schema::create('banks_accounts_statement', function (Blueprint $table) {
            $table->id();
            $table->foreignId('banks_account_id')->unsigned()->index()->nullable();
            $table->foreign('banks_account_id')->references('id')->on('company_banks_accounts')->onDelete('cascade');
            $table->string('description');
            $table->date('register_date');
            $table->enum('type', ['c', 'd']);
            $table->decimal('amount');
            $table->foreignId('transaction_id')->unsigned()->index()->nullable();
            $table->foreign('transaction_id')->references('id')->on('financial_transactions')->onDelete('cascade');
            $table->timestamps();
            $table->foreignId('id_user_ins')->unsigned()->index()->nullable();
            $table->foreign('id_user_ins')->references('id')->on('users')->onDelete('cascade'); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bank_accounts_statement');
    }
};
