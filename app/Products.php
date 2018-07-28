<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
  protected $table = 'products';//specify which table
  protected $fillable = ['id']; //specify what is fillable//
}
