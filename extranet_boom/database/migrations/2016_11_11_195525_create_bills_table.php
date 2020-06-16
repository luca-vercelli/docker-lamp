<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBillsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bills', function (Blueprint $table) {
            $table->increments('id');
            $table->boolean('status')->default(1);
            $table->integer('condition');
            $table->integer('quantity');
            $table->decimal('amount', 15, 2);
            $table->decimal('exemption', 15, 2);
            $table->decimal('base_IVA', 15, 2);
            $table->decimal('IVA', 15, 2);
            $table->decimal('sub_total', 15, 2);
            $table->decimal('total', 15, 2);
            $table->integer('client_id')->unsigned();
            $table->integer('budget_id')->unsigned();

            /* client data */
            $table->string('client_name', 150);
            $table->string('client_short_name', 150);
            $table->text('client_address');
            $table->string('client_phone', 20);
            $table->string('client_RIF', 25);

            // Foreign keys
            $table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade');
            $table->foreign('budget_id')->references('id')->on('budgets')->onDelete('cascade');

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
        Schema::dropIfExists('bills');
    }
}
