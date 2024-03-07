<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMemberTransactionsTable extends Migration
{
    public function up()
    {
        Schema::create('member_transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('price_list_id')->constrained();
            $table->integer('quantity');
            $table->integer('price');
            $table->integer('service_type_id')->nullable();
            $table->integer('service_cost')->default(0);
            $table->integer('discount')->nullable();
            $table->boolean('delivery_service')->default(false);
            $table->integer('delivery_charge')->default(0);
            $table->integer('payment_amount');
            $table->integer('total');
            $table->foreignId('user_id')->constrained();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('transactions');
    }
}
