<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    protected $table="Offers";
    protected $fillable=['name','price','details'];
    protected $hidden=['create_at','update_at'];
    public $timestamps=false;
}
