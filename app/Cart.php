<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
  protected $table = 'cart';//specify which table
  protected $fillable = ['id']; //specify what is fillable//  //
}
