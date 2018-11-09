<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVisitservicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('visitservices', function (Blueprint $table) {
            $table->increments('visitservice_id');
            $table->unsignedInteger('visit_visit_id');
            $table->foreign('visit_visit_id')->references('visit_id')->on('visits');           
            $table->unsignedInteger('service_service_id');
            $table->foreign('service_service_id')->references('service_id')->on('services');           
            $table->double('amount', 10, 2);
            $table->integer('quantity');
            $table->dateTime('bill_time');
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
        Schema::dropIfExists('visitservices');
    }
}
