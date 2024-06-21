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
            $table->decimal('value');
            $table->decimal('addition');
            $table->decimal('discount');
            $table->decimal('amount');
            $table->date('register_date')->nullable();
            $table->date('due_date')->nullable();
            $table->date('pay_date')->nullable();
            $table->foreignId('customer_provider_id')->unsigned()->index()->nullable();
            $table->foreignId('credit_account_id')->unsigned()->index()->nullable();
            $table->foreign('credit_account_id')->references('id')->on('accounting_financial')->onDelete('cascade');
            $table->foreignId('debit_account_id')->unsigned()->index()->nullable();
            $table->foreign('debit_account_id')->references('id')->on('accounting_financial')->onDelete('cascade');
            $table->foreignId('disbursement_account_id')->unsigned()->index()->nullable();
            $table->foreign('disbursement_account_id')->references('id')->on('company_banks_accounts')->onDelete('cascade');
            $table->enum('type', ['p', 'r'])->default('p');
            $table->foreignId('payment_method_id')->unsigned()->index()->nullable();
            $table->foreign('payment_method_id')->references('id')->on('payment_method')->onDelete('cascade');
            $table->string('document_number');
            $table->string('document_key');
            $table->foreignId('reference_transaction_id')->unsigned()->index()->nullable();
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
