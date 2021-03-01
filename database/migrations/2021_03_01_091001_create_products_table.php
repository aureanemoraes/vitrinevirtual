<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('main_name');
            $table->longText('description')->nullable();
            $table->float('price');
            $table->string('payment_methods'); // 1: Dinheiro; 2: Cartão de crédito; 3: Cartão de débito; 4: Pix; 5: Transferência Bancária
            $table->unsignedBigInteger('bussiness_id');
            $table->foreign('bussiness_id')->references('id')->on('bussinesses');
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
        Schema::dropIfExists('products');
    }
}
