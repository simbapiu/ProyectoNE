<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class OptionMigration extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('options', function (Blueprint $table) {
      $table->id();
      $table->string('answer_type');
      $table->string('first_option');
      $table->string('second_option');
      $table->string('third_option');
      $table->string('fourth_option');
      $table->string('fifth_option');
      $table->string('default_option');
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
    Schema::dropIfExists('options');
  }
}
