<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Score extends Model
{
  use HasFactory;

  protected $fillable = [
    'total_percentage', 'total_answered', 'pre_score', 'final_score', 'extra_points', 'id_quiz'
  ];
}
