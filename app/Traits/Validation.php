<?php

namespace App\Traits;

trait Validation{

    private $messages=[
        'required'=>'El campo :attribute es requerido',
        'numeric' => 'El campo :attribute debe ser un número'
    ];
    
}

?>