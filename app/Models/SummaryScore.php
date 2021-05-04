<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SummaryScore extends Model
{
  use HasFactory;

  protected $fillable = [
    'id_score', 'recommendations', 'improvements', 'application_date', 'application_place'
  ];
}
