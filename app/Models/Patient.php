<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    protected $table="patients";
    protected $fillable=['name','age'];
    protected $hidden = [];
    public $timestamps=false;

    public function medicals(){
        return $this->hasOne('App\Models\Medical','patient_id');
    }

    public function doctors(){
        return $this->hasOneThrough('App\Models\Doctor','App\Models\Medical','patient_id','medical_id');
    }
    
}
