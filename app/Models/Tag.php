<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
  use HasFactory;

  /*
  * 複数挿入可能な属性を指定
  */
  protected $fillable = [
    'article_id',
    'name'
  ];
}
