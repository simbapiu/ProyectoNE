<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GeneralData extends Model
{
  use HasFactory;

  protected $fillable = [
    'id_employee_evaluator', 'id_employee_evaluated', 'start_period', 'end_period'
  ];
}
