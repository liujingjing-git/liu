<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cate extends Model
{
    public $primaryKey="cate_id";

    protected $table="cate";

    public $timestamps=false;
  
    protected $fillable = ['cate_name','parent_id','cate_show'];
}
