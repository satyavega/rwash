<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemTransactionsTable extends Migration
{
    public function up()
    {
        Schema::create('item_transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('item_id')->constrained();
            $table->foreignId('transaction_id')->constrained();
            $table->integer('quantity');
            $table->timestamps();

            $table->unique(['item_id', 'transaction_id']);
        });

    }

    public function down()
    {
        Schema::dropIfExists('item_transactions');
    }
}
