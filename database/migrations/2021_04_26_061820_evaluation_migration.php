<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EvaluationMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('evaluations', function (Blueprint $table) {
        $table->id();
        $table->integer('id_general_data');
        $table->integer('id_quiz');
        $table->integer('id_score');
        $table->integer('id_summary_score');
        $table->boolean('is_closed');
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
      Schema::dropIfExists('evaluations');
    }
}
