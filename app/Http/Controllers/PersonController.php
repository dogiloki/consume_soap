<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use App\Models\Person;
use App\Models\Language;
use App\Models\Country;
use App\Models\PersonLanguage;

class PersonController extends Controller{

    public function index(int $id=null){
        $person=Person::find($id);
        $persons=Person::paginate();
        $countries=Country::all();
        $languages=Language::all();
        return view('person.index',compact('person','persons','countries','languages'));
    }

    public function store(Request $request){
        try{
            $validation=Validator::make($request->all(),$this->getRulesStore('person'),$this->getMessages());
            if($validation->fails()){
                Log::channel('error')->error('Error al validar los datos para crear una nueva persona | PersonController@store | error: '.$validation->errors());
                Session::flash('message','Error al validar los datos para crear una nueva persona');
                return redirect()->back();
            }
            $person_language=[];
            for($index=0; $index<count($request->languages_id??[]); $index++){
                if(($request->languages_leves[$index]??0)==0){
                    continue;
                }
                $person_language[$request->languages_id[$index]]=['level'=>$request->languages_leves[$index]];
                
            }
            try{
                DB::transaction(function()use($request,$person_language){
                    $person=Person::create($request->all());
                    $person->languages()->attach($person_language);
                });
            }catch(\Exception $ex){
                Log::channel('error')->error('Error al crear una nueva persona | PersonController@store | error: '.$ex->getMessage());
                Session::flash('message','Error al crear una nueva persona');
                return redirect()->back();
            }
            Log::channel('info')->info('Se creo una nueva persona | PersonController@store');
            Session::flash('message','Se creo una nueva persona');
            return redirect()->back();
        }catch(\Exception $ex){
            Log::channel('error')->error('Error en el servidor Exception (catch) | PersonController@store | error: '.$ex->getMessage());
            Session::flash('message','Error en el servidor');
            return redirect()->back();
        }
    }

    public function update(Request $request){
        try{
            $validation=Validator::make($request->all(),$this->getRulesUpdate('person'),$this->getMessages());
            if($validation->fails()){
                Log::channel('error')->error('Error al validar los datos para actualizar una persona | PersonController@update | error: '.$validation->errors());
                Session::flash('message','Error al validar los datos para actualizar una persona '.$validation->errors());
                return redirect()->back();
            }
            $person=Person::find($request->id);
            if(!$person){
                Log::channel('error')->error('Error al buscar la persona a actualizar | PersonController@update');
                Session::flash('message','Error al buscar la persona a actualizar');
                return redirect()->back();
            }
            $person_language=[];
            for($index=0; $index<count($request->languages_id??[]); $index++){
                if(($request->languages_leves[$index]??0)==0){
                    continue;
                }
                $person_language[$request->languages_id[$index]]=['level'=>$request->languages_leves[$index]];
            }
            try{
                DB::transaction(function()use($request,$person,$person_language){
                    $person->update($request->all());
                    $person->languages()->sync($person_language);
                });
            }catch(\Exception $ex){
                Log::channel('error')->error('Error al actualizar la persona | PersonController@update | error: '.$ex->getMessage());
                Session::flash('message','Error al actualizar la persona');
                return redirect()->back();
            }
            Log::channel('info')->info('Se actualizo la persona | PersonController@update');
            Session::flash('message','Se actualizo la persona');
            return redirect()->back();
        }catch(\Exception $ex){
            Log::channel('error')->error('Error en el servidor Exception (catch) | PersonController@update | error: '.$ex->getMessage());
            Session::flash('message','Error en el servidor');
            return redirect()->back();
        }
    }

    public function show(int $id){
        try{
            $person=Person::find($id);
            if(!$person){
                Log::channel('error')->error('Error al buscar la persona | PersonController@show');
                Session::flash('message','Error al buscar la persona');
                return $this->return_not_found();
            }
            Log::channel('info')->info('Se obtuvo información de persona | PersonController@show');
            return $this->return_success_data(compact('person'));
        }catch(\Exception $ex){
            Log::channel('error')->error('Error en el servidor Exception (catch) | PersonController@show | error: '.$ex->getMessage());
            Session::flash('message','Error en el servidor');
            return $this->return_error_server();
        }
    }

    public function destroy(Request $request){
        try{
            $person=Person::find($request->id);
            if(!$person){
                Log::channel('error')->error('Error al buscar la persona a eliminar | PersonController@destroy');
                Session::flash('message','Error al buscar la persona a eliminar');
                return redirect()->back();
            }
            try{
                DB::transaction(function()use($person){
                    $person->languages()->detach();
                    $person->delete();
                });
            }catch(\Exception $ex){
                Log::channel('error')->error('Error al eliminar la persona | PersonController@destroy');
                Session::flash('message','Error al eliminar la persona');
                return redirect()->back();
            }
            Log::channel('info')->info('Se elimino la persona | PersonController@destroy');
            Session::flash('message','Se elimino la persona');
            return redirect()->back();
        }catch(\Exception $ex){
            Log::channel('error')->error('Error en el servidor Exception (catch) | PersonController@destroy | error: '.$ex->getMessage());
            Session::flash('message','Error en el servidor');
            return redirect()->back();
        }
    }
    
}
