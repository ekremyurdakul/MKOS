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

            $table->string('solunum_sds')->nullable();
            $table->string('solunum_toraks_ins')->nullable();
            $table->string('solunum_toraks_palpas')->nullable();
            $table->string('solunum_perkusyon')->nullable();
            $table->string('kardiyo_periferik_nabz')->nullable();
            $table->string('kardiyo_nds')->nullable();
            $table->string('kardiyo_palpasyon')->nullable();
            $table->string('kardiyo_oskultasyon')->nullable();
            $table->string('kardiyo_venuz_dolgunluk')->nullable();
            $table->string('gastro_inspeksiyon')->nullable();
            $table->string('gastro_tonsiller')->nullable();

            $table->string('gastro_palpasyon')->nullable();
            $table->string('gastro_perkusyon')->nullable();
            $table->string('gastro_oskultasyon')->nullable();
            $table->string('genito_kuntperk')->nullable();
            $table->string('genito_ureternoktalar')->nullable();
            $table->string('genito_suprapubik')->nullable();
            $table->string('lokomotor_notlar')->nullable();
            $table->string('noro_ense_sertligi')->nullable();
            $table->string('noro_kernig')->nullable();
            $table->string('noro_bruzinski')->nullable();
            $table->string('noro_lasegue_sag')->nullable();
            $table->string('noro_lasegue_sol')->nullable();
            $table->string('noro_femoral_sag')->nullable();
            $table->string('noro_femoral_sol')->nullable();
            $table->string('noro_notlar')->nullable();
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
