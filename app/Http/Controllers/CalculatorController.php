<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use App\Traits\Validation;
use SoapClient;

class CalculatorController extends Controller{
    
    use Validation;

    private $client;
    private $operations=[
        "+"=>"Sumar",
        "-"=>"Restar",
        "*"=>"Multiplicar",
        "/"=>"Dividir"
    ];

    public function __construct(){
        $this->client=new SoapClient(env("SOAP_WSDL"));
    }

    public function index(){
        Session::flash("operations",$this->operations);
        return view("index");
    }

    public function calculator(Request $request){
        $validator=Validator::make($request->all(),[
            "intA"=>["required","numeric"],
            "intB"=>["required","numeric"],
            "operation"=>["required"]
        ],$this->messages);
        if($validator->fails()){
            Session::flash("valitator_error",$validator->errors()->first());
        }
        try{
            $params=[
                "intA"=>$request->intA,
                "intB"=>$request->intB
            ];
            switch($request->operation){
                case "+":
                    $result=$this->client->add($params)->AddResult;
                    break;
                case "-":
                    $result=$this->client->subtract($params)->SubtractResult;
                    break;
                case "*":
                    $result=$this->client->multiply($params)->MultiplyResult;
                    break;
                case "/":
                    $result=$this->client->divide($params)->DivideResult;
                    break;
                default:
                    Session::flash("error","Operación no válida ".$request->operation);
                    break;
            }
            $str_result=$request->intA." ".$request->operation." ".$request->intB." = ".$result;
            Log::info("Se realizo una operación con resultado ".$str_result);
            Session::flash("result",$str_result);
        }catch(\Exception $ex){
            Log::error("Error al consumir el servicio SOAP ".$ex->getMessage());
            Session::flash("error","Error en el servidor SOAP");
        }
        Session::flash("operations",$this->operations);
        return view("index");
    }

}
