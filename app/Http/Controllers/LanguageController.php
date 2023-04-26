<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use App\Models\Language;

class LanguageController extends Controller{

    public function index(){
        $languages=Language::paginate();
        return view('language.index',compact('languages'));
    }

    public function store(Request $request){
        try{
            $validation=Validator::make($request->all(),$this->getRulesStore('language'),$this->getMessages());
            if($validation->fails()){
                Log::channel('error')->error('Error al validar los datos para crear un nuevo idioma | LanguageController@store | error: '.$validation->errors());
                Session::flash('message','Error al validar los datos para crear un nuevo idioma');
                return redirect()->back();
            }
            $store=$language=Language::create($request->all());
            if(!$store){
                Log::channel('error')->error('Error al crear un nuevo idioma | LanguageController@store');
                Session::flash('message','Error al crear un nuevo idioma');
                return redirect()->back();
            }
            Log::channel('info')->info('Se creo un nuevo idioma | LanguageController@store');
            Session::flash('message','Se creo un nuevo idioma');
            return redirect()->back();
        }catch(\Exception $ex){
            Log::channel('error')->error('Error en el servidor Exception (catch) | LanguageController@store | error: '.$ex->getMessage());
            Session::flash('message','Error en el servidor');
            return redirect()->back();
        }
    }

    public function update(Request $request){
        try{
            $validation=Validator::make($request->all(),$this->getRulesUpdate('language'),$this->getMessages());
            if($validation->fails()){
                Log::channel('error')->error('Error al validar los datos para actualizar un idioma | LanguageController@update | error: '.$validation->errors());
                Session::flash('message','Error al validar los datos para actualizar un idioma');
                return redirect()->back();
            }
            $language=Language::find($request->id);
            if(!$language){
                Log::channel('error')->error('Error al buscar el idioma a actualizar | LanguageController@update');
                Session::flash('message','Error al buscar el idioma a actualizar');
                return redirect()->back();
            }
            $update=$language->update($request->all());
            if(!$update){
                Log::channel('error')->error('Error al actualizar el idioma | LanguageController@update');
                Session::flash('message','Error al actualizar el idioma');
                return redirect()->back();
            }
            Log::channel('info')->info('Se actualizo el idioma | LanguageController@update');
            Session::flash('message','Se actualizo el idioma');
            return redirect()->back();
        }catch(\Exception $ex){
            Log::channel('error')->error('Error en el servidor Exception (catch) | LanguageController@update | error: '.$ex->getMessage());
            Session::flash('message','Error en el servidor');
            return redirect()->back();
        }
    }

    public function show(int $id){
        try{
            $language=Language::find($id);
            if(!$language){
                Log::channel('error')->error('Error al buscar el idioma | LanguageController@show');
                Session::flash('message','Error al buscar el idioma');
                return $this->return_not_found();
            }
            Log::channel('info')->info('Se obtuvo información de idioma | LanguageController@show');
            return $this->return_success_data(compact('language'));
        }catch(\Exception $ex){
            Log::channel('error')->error('Error en el servidor Exception (catch) | LanguageController@show | error: '.$ex->getMessage());
            Session::flash('message','Error en el servidor');
            return $this->return_error_server();
        }
    }

    public function destroy(Request $request){
        try{
            $language=Language::find($request->id);
            if(!$language){
                Log::channel('error')->error('Error al buscar el idioma a eliminar | LanguageController@destroy');
                Session::flash('message','Error al buscar el idioma a eliminar');
                return redirect()->back();
            }
            $delete=$language->delete();
            if(!$delete){
                Log::channel('error')->error('Error al eliminar el idioma | LanguageController@destroy');
                Session::flash('message','Error al eliminar el idioma');
                return redirect()->back();
            }
            Log::channel('info')->info('Se elimino el idioma | LanguageController@destroy');
            Session::flash('message','Se elimino el idioma');
            return redirect()->back();
        }catch(\Exception $ex){
            Log::channel('error')->error('Error en el servidor Exception (catch) | LanguageController@destroy | error: '.$ex->getMessage());
            Session::flash('message','Error en el servidor');
            return redirect()->back();
        }
    }

}
