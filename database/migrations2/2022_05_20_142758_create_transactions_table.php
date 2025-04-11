<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->longText("CountryName")->nullable();
            $table->longText("FinancialInstitutionCountryCode")->nullable();
            $table->longText("TransactionID")->nullable();
            $table->longText("MerchantEstablishedDateTime")->nullable();
            $table->bigInteger("PayerAccountNumber")->nullable();
            $table->bigInteger("PayerAccountSortCode")->nullable();
            $table->bigInteger("MerchantAccountSortCode")->nullable();
            $table->longText("MerchantAccountName")->nullable();
            $table->longText("CurrencyName")->nullable();
            $table->longText("TransactionStatus")->nullable();
            $table->longText("MerchantEntityID")->nullable();
            $table->longText("UserIPAddress")->nullable();
            $table->bigInteger("TransactionRefNo")->nullable();
            $table->Integer("PaymentAmount")->nullable();
            $table->Integer("AmountPaid")->nullable();
            $table->dateTime("EstablishedDateTime")->nullable();
            $table->dateTime("StartDateTime")->nullable();
            $table->dateTime("EndDateTime")->nullable();
            $table->longText("BankReceipt")->nullable();
            $table->longText("BankReceiptDateTime")->nullable();
            $table->longText("TransactionStatusCode")->nullable();
            $table->longText("MerchantReference")->nullable();
            $table->longText("MerchantAccountNumber")->nullable();
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
        Schema::dropIfExists('transactions');
    }
}
