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
            $table->foreignId('disbursement_account_id')->unsigned()->index()->nullable();
            $table->foreign('disbursement_account_id')->references('id')->on('company_banks_accounts')->onDelete('cascade');
            $table->string('description');
            $table->date('register_date');
            $table->enum('type', ['c', 'd']);
            $table->decimal('amount');
            $table->timestamps();
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
