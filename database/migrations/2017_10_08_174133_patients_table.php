<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PatientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patients', function (Blueprint $table) {
            $table->increments('id');
            $table->string('document_no')->unique();
            $table->string('name');
            $table->string('surname');
            $table->string('gender');
            $table->date('DOB');
            $table->string('occupation')->nullable();
            $table->string('address')->nullable();
            $table->string('business_tel')->nullable();
            $table->string('home_tel')->nullable();
            $table->string('allergy_info')->nullable();
            $table->string('notes')->nullable();
            $table->string('history')->nullable();
            $table->string('medicines')->nullable();
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
        Schema::dropIfExists('patients');
    }
}
