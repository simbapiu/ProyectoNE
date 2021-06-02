<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class GeneralDataMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('general_datas', function (Blueprint $table) {
        $table->id();
        $table->integer('id_employee_evaluator');
        $table->integer('id_employee_evaluated');
        $table->date('start_period');
        $table->date('end_period');
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
      Schema::dropIfExists('general_datas');
    }
}
