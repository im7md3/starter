<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Medical extends Model
{
    protected $table="medicals";
    protected $fillable=['pdf','patient_id'];
    protected $hidden = [];
    public $timestamps=false;

    public function patients(){
        return $this->belongsTo('App\Models\Patient','patient_id');
    }

    
}
