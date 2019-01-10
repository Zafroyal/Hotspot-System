<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product_Orders extends Model
{
  public $timestamps = false;
  protected $table = 'order_product';//specify which table
  protected $fillable = ['o_id','p_id','quantity'];//specify what is fillable//

}
