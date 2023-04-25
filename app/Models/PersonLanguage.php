<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\AutoFillable;

class PersonLanguage extends Model{
    use HasFactory, AutoFillable;

    protected $table='person_language';

}
