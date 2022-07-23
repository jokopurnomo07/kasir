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
            $table->bigInteger("transactions_id");
            $table->bigInteger("product_id");
            $table->string("nama");
            $table->string("merek");
            $table->integer("harga");
            $table->integer("qty");
            $table->bigInteger("subtotal")->nullable();
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
        Schema::dropIfExists('transaction__details');
    }
}
