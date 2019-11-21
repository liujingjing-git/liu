<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    public $primaryKey="admin_id";

    protected $table="admin";

    public $timestamps=false;
  
    protected $fillable = ['admin_name','admin_pwd'];
}
