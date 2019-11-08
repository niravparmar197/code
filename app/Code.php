<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Code extends Model
{
  protected $table='code';
  protected $fillable=['fname','lname','email','image','city','country','job'];
 // public $timestamp=false;  
  public $timestamps = false;

 }
