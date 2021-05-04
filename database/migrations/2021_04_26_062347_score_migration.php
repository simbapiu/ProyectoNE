<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ScoreMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('scores', function (Blueprint $table) {
        $table->id();
        $table->integer('id_quiz');
        $table->integer('total_percentage');
        $table->integer('total_answered');
        $table->float('final_score');
        $table->integer('extra_points');
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
      Schema::dropIfExists('scores');
    }
}
