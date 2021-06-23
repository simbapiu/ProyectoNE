<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evaluation extends Model
{
  use HasFactory;

  protected $fillable = [
    'id_general_data', 'id_quiz', 'id_score', 'id_summary_score', 'is_closed', 'user_id', 'user_evaluated_id'
  ];
}
