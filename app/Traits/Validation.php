<?php

namespace App\Traits;
use Illuminate\Support\Facades\Log;

trait Validation{

    private $messages=[
        'required'=>'El campo :attribute es requerido',
        'numeric'=>'El campo :attribute debe ser un número',
        'integer'=>'El campo :attribute debe ser un número entero',
        'string'=>'El campo :attribute debe ser una cadena de caracteres',
        'max'=>'El campo :attribute no puede tener más de :max caracteres',
        'min'=>'El campo :attribute no puede tener menos de :min caracteres',
        'unique'=>'El campo :attribute ya se encuentra registrado',
        'exists'=>'El campo :attribute no existe',
        'distinct'=>'El campo :attribute no puede tener valores repetidos',
        'regex'=>'El campo :attribute no tiene un formato válido',
        'between'=>'El campo :attribute debe estar entre :min y :max',
    ];

    private $rules_store=[
        'country'=>[
            'iso_code'=>['required','string','unique:country','max:255'],
            'name'=>['required','string','max:255'],
            'capital'=>['required','string','max:255'],
            'phone_code'=>['required','string','max:255'],
            'currency_iso_code'=>['required','string','max:255'],
            'src_flag'=>['required','string','max:255'],
            'continent_iso_code'=>['required','string','max:255']
        ],
        'language'=>[
            'iso_code'=>['required','string','unique:language','max:255'],
            'name'=>['required','string','max:255']
        ],
        'person'=>[
            'name'=>['required','string','max:255'],
            'surname'=>['required','string','max:255'],
            'country_id'=>['required','exists:country,id'],
            'languages_id.*'=>['required','distinct','exists:language,id'],
            'languages_leves.*'=>['required','integer','between:0,100']
        ]
    ];

    private $rules_update;

    public function validation(){
        $this->rules_update=[
            'country'=>$this->removeRequired($this->rules_store['country']),
            'language'=>$this->removeRequired($this->rules_store['language']),
            'person'=>$this->removeRequired($this->rules_store['person'])
        ];
    }

    // Pendiente a optimizar
    private function removeRequired(array $rules){
        foreach($rules as $key=>$value){
            $value=array_reduce($value,function($array,$item){
                if($item=='required'){
                    unset($item);
                }else{
                    $array[]=$item;
                }
                return $array;
            });
            $rules[$key]=$value;
        }
        return $rules;
    }
    
}

?>