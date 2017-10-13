<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExaminationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('examinations', function (Blueprint $table) {
            $table->increments('id');
            $table->date('date');
            $table->unsignedInteger('patient_id');
            $table->string('boy')->nullable();
            $table->string('kilo')->nullable();
            $table->string('bmi')->nullable();
            $table->string('sikayet')->nullable();
            $table->string('suur')->nullable();
            $table->string('kooperasyon')->nullable();
            $table->string('deri')->nullable();
            $table->string('ikter')->nullable();
            $table->string('subikter')->nullable();
            $table->string('siyanoz')->nullable();
            $table->string('odempreb')->nullable();
            $table->string('odembis')->nullable();
            $table->string('lap')->nullable();
            $table->string('turgor')->nullable();
            $table->string('tiroid')->nullable();
            $table->string('ates')->nullable();
            $table->string('tedavi')->nullable();
            $table->foreign('patient_id')->references('id')->on('patients');
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
        Schema::dropIfExists('examinations');
    }
}
