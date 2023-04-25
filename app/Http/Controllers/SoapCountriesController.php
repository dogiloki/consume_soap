<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Traits\ReturnJson;
use App\Services\SoapCountries;

class SoapCountriesController extends Controller{
    use ReturnJson, SoapCountries;

    public function __construct(){
        $this->soapCountries();
    }

    /**
     * Información de países
     */

    public function getFullCountryInfoAll(){
        try{
            $countries=$this->soap_countries->FullCountryInfoAllCountries()->FullCountryInfoAllCountriesResult->tCountryInfo;
            Log::channel('info')->info('Se obtuvo la información completa de países | SoapCountriesController@getFullCountryInfo');
            return $this->return_success_data(compact('countries'));
        }catch(\Exception $ex){
            Log::channel('error')->error('Error en el servidor Exception (catch) | SoapCountriesController@getFullCountryInfo | error: '.$ex->getMessage());
            return $this->return_error_server();
        }
    }

    public function getFullCountryInfo(string $iso_code){
        try{
            $country=$this->soap_countries->FullCountryInfo(['sCountryISOCode'=>$iso_code])->FullCountryInfoResult;
            Log::channel('info')->info('Se obtuvo la información completa de un país | SoapCountriesController@getFullCountryInfo');
            return $this->return_success_data(compact('country'));
        }catch(\Exception $ex){
            Log::channel('error')->error('Error en el servidor Exception (catch) | SoapCountriesController@getFullCountryInfo | error: '.$ex->getMessage());
            return $this->return_error_server();
        }
    }

    public function getListCountryName(){
        try{
            $countries=$this->soap_countries->ListOfCountryNamesByName()->ListOfCountryNamesByNameResult->tCountryCodeAndName;
            Log::channel('info')->info('Se obtuvo la lista de países | SoapCountriesController@getListCountryName');
            return $this->return_success_data(compact('countries'));
        }catch(\Exception $ex){
            Log::channel('error')->error('Error en el servidor Exception (catch) | SoapCountriesController@getListCountryName | error: '.$ex->getMessage());
            return $this->return_error_server();
        }
    }

    /**
     * Información de idiomas
     */

     public function getListLanguageName(){
        try{
            $languages=$this->soap_countries->ListOfLanguagesByName()->ListOfLanguagesByNameResult->tLanguage;
            Log::channel('info')->info('Se obtuvo la información completa de idiomas | SoapCountriesController@getFullLanguageInfo');
            return $this->return_success_data(compact('languages'));
        }catch(\Exception $ex){
            Log::channel('error')->error('Error en el servidor Exception (catch) | SoapCountriesController@getFullLanguageInfo | error: '.$ex->getMessage());
            return $this->return_error_server();
        }
    }

}
