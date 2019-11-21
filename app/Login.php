<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Login extends Model
{
    public $primaryKey="user_id";

    protected $table="user";

    public $timestamps=false;
  
    protected $guarded = ['user_pwds','code'];
}
