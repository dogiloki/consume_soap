<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\AutoFillable;
use App\Models\Country;
use App\Models\PersonLanguage;

class Person extends Model{
    use HasFactory, AutoFillable;

    protected $table='person';

    protected $with=['country','languages'];

    public function country(){
        return $this->hasOne(Country::class,'id','country_id');
    }

    public function languages(){
        return $this->belongsToMany(Language::class,PersonLanguage::class,'person_id','language_id')->withPivot('level');
    }

}
