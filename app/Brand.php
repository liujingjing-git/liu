<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    public $primaryKey="brand_id";

    protected $table="brand";

    public $timestamps=false;
  
    /*白名单  表设计中不允许为空*/
    /*protected $fillable = ['brand_name','brand_url','brand_desc'];*/
    /*黑名单  表设计中可以为空*/
    protected $guarded = [];
};