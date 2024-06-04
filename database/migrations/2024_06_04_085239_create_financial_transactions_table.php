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
        Schema::create('financial_transactions', function (Blueprint $table) {
            $table->id();
            $table->string('description');
            $table->date('date_due');
            $table->decimal('amount');
            $table->foreignId('customer_provider_id')->unsigned()->index()->nullable();
            $table->foreignId('credit_account_id')->unsigned()->index()->nullable();
            $table->foreign('credit_account_id')->references('id')->on('accounting_financial')->onDelete('cascade');
            $table->foreignId('debit_account_id')->unsigned()->index()->nullable();
            $table->foreign('debit_account_id')->references('id')->on('accounting_financial')->onDelete('cascade');
            $table->enum('type',['p','r'])->default('p');
            $table->text('observation');
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
        Schema::dropIfExists('financial_transactions');
    }
};
