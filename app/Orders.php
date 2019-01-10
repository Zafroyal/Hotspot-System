<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
  public $timestamps = false;
  protected $table = 'orders';//specify which table
  protected $fillable = ['order_id','user_id','ostatus'];//specify what is fillable//

}
