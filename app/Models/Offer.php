<?php

namespace App\Models;

use App\Scopes\offerScopes;
use Illuminate\Database\Eloquent\Model;
use LaravelLocalization;

class Offer extends Model
{
    protected $table="Offers";
    protected $fillable=['name_ar','name_en','price','details_ar','details_en','created_at','updated_at','photo','status'];
    protected $hidden=['created_at','updated_at'];
    public $timestamps=false;

    /* ====================================== scop ==================================== */
    public function scopeInactive($q,$status){
        return $q->select(
            'id',
            'name_' . LaravelLocalization::getCurrentLocale() . ' as name',
            'price',
            'details_' . LaravelLocalization::getCurrentLocale() . ' as details',
            'photo',
            'status'
        )->where('status',$status)->paginate(PAGINATION_COUNT);
    }


    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new offerScopes);
    }
}


