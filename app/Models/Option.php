<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    use HasFactory;

    protected $fillable = [
      'answer_type', 'first_option', 'second_option', 'third_option', 'fourth_option', 'fifth_option',
      'default_option'
    ];
}
