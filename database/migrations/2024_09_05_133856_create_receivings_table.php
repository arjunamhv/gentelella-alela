<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReceivingsTable extends Migration
{
    public function up()
    {
        Schema::create('receivings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('purchase_order_id')->constrained()->onDelete('cascade');
            $table->date('receiving_date');
            $table->integer('quantity_received');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('receivings');
    }
}

