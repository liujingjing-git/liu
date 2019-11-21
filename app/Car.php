<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    public $primaryKey="c_id";

    protected $table="car";

    public $timestamps=false;
  
    protected $guarded = [];

}
