<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\AutoFillable;
use App\Models\PersonLanguage;

class Language extends Model{
    use HasFactory, AutoFillable;

    protected $table='language';
    
    public function persons(){
        return $this->belongsToMany(Person::class,PersonLanguage::class,'language_id','person_id');
    }

}
