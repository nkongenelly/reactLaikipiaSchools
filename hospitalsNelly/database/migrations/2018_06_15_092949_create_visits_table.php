<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVisitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('visits', function (Blueprint $table) {
            $table->increments('visit_id');
            $table->unsignedInteger('patient_patient_id');
            $table->foreign('patient_patient_id')->references('patient_id')->on('patients');
            $table->dropForeign('visits_patient_patient_id_foreign');
            $table->dateTime('visit_date');
            $table->tinyInteger('visit_type');
            $table->dateTime('exit_time');
            $table->tinyInteger('visit_status');
            $table->timestamps();
        });
    }
   // Schema::disableForeignKeyConstraints();
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('visits');
    }
}
