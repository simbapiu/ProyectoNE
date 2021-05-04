<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SummaryScoreMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('summary_scores', function (Blueprint $table) {
        $table->id();
        $table->integer('id_score');
        $table->string('recommendations');
        $table->string('improvements');
        $table->date('application_date');
        $table->string('application_place');
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
      Schema::dropIfExists('summary_scores');
    }
}
