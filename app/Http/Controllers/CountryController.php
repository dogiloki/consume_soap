<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use App\Traits\Validation;
use App\Models\Country;
use App\Services\SoapCountries;

class CountryController extends Controller{
    use Validation, SoapCountries;

    public function __construct(){
        $this->validation();
        $this->soapCountries();
    }

    public function index(){
        return view('country.index');
    }
    
    public function store(Request $request){
        try{
            $validation=Validator::make($request->all(),$this->rules_store['country'],$this->messages);
            if($validation->fails()){
                Log::channel('error')->error('Error al validar los datos para crear un nuevo país | CountryController@store | error: '.$validation->errors());
                Session::flash('message','Error al validar los datos para crear un nuevo país');
                return redirect()->back();
            }
            $store=$country=Country::create($request->all());
            if(!$store){
                Log::channel('error')->error('Error al crear un nuevo país | CountryController@store');
                Session::flash('message','Error al crear un nuevo país');
                return redirect()->back();
            }
            Log::channel('info')->info('Se creo un nuevo país | CountryController@store');
            Session::flash('message','Se creo un nuevo país');
            return redirect()->back();
        }catch(\Exception $ex){
            Log::channel('error')->error('Error en el servidor Exception (catch) | CountryController@store | error: '.$ex->getMessage());
            Session::flash('message','Error en el servidor');
            return redirect()->back();
        }
    }

    public function update(Request $request){
        try{
            $validation=Validator::make($request->all(),$this->rules_update['country'],$this->messages);
            if($validation->fails()){
                Log::channel('error')->error('Error al validar los datos para actualizar un país | CountryController@update | error: '.$validation->errors());
                Session::flash('message','Error al validar los datos para actualizar un país');
                return redirect()->back();
            }
            $country=Country::find($request->id);
            if(!$country){
                Log::channel('error')->error('Error al buscar el país a actualizar | CountryController@update');
                Session::flash('message','Error al buscar el país a actualizar');
                return redirect()->back();
            }
            $update=$country->update($request->all());
            if(!$update){
                Log::channel('error')->error('Error al actualizar el país | CountryController@update');
                Session::flash('message','Error al actualizar el país');
                return redirect()->back();
            }
            Log::channel('info')->info('Se actualizo el país | CountryController@update');
            Session::flash('message','Se actualizo el país');
            return redirect()->back();
        }catch(\Exception $ex){
            Log::channel('error')->error('Error en el servidor Exception (catch) | CountryController@update | error: '.$ex->getMessage());
            Session::flash('message','Error en el servidor');
            return redirect()->back();
        }
    }

    public function show(int $id){
        try{
            $country=Country::find($id);
            if(!$country){
                Log::channel('error')->error('Error al buscar el país | CountryController@show');
                Session::flash('message','Error al buscar el país');
                return $this->return_not_found();
            }
            Log::channel('info')->info('Se busco el país | CountryController@show');
            return $this->return_success_data(compact('country'));
        }catch(\Exception $ex){
            Log::channel('error')->error('Error en el servidor Exception (catch) | CountryController@show | error: '.$ex->getMessage());
            Session::flash('message','Error en el servidor');
            return $this->return_error_server();
        }
    }

    public function destroy(Request $request){
        try{
            $country=Country::find($request->id);
            if(!$country){
                Log::channel('error')->error('Error al buscar el país a eliminar | CountryController@destroy');
                Session::flash('message','Error al buscar el país a eliminar');
                return redirect()->back();
            }
            $destroy=$country->delete();
            if(!$destroy){
                Log::channel('error')->error('Error al eliminar el país | CountryController@destroy');
                Session::flash('message','Error al eliminar el país');
                return redirect()->back();
            }
            Log::channel('info')->info('Se elimino el país | CountryController@destroy');
            Session::flash('message','Se elimino el país');
            return redirect()->back();
        }catch(\Exception $ex){
            Log::channel('error')->error('Error en el servidor Exception (catch) | CountryController@destroy | error: '.$ex->getMessage());
            Session::flash('message','Error en el servidor');
            return redirect()->back();
        }
    }

}
