<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\AutoFillable;
use App\Models\Person;

class Country extends Model{
    use HasFactory, AutoFillable;

    protected $table='country';
    
    public function persons(){
        return $this->hasMany(Person::class,'country_id','id');
    }

}
