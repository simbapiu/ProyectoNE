<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GeneralData extends Model
{
  use HasFactory;

  protected $table = 'general_datas';

  protected $fillable = [
    'start_period', 'end_period'
  ];
}
