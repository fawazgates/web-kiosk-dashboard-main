<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaction_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('transaction_id')->nullable()->references('id')->on('transactions')->onDelete('cascade');
            $table->foreignId('food_id')->references('id')->on('foods')->onDelete('cascade');
            $table->string('quantity');
            $table->string('discount')->default('0');
            $table->string('price');
            $table->string('total_price');
            $table->enum('is_deleted', ['0','1'])->default('0');
            $table->enum('status', ['0','1'])->default('0');
            $table->dateTime('deleted_at')->nullable();
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
        Schema::dropIfExists('transaction_details');
    }
}
