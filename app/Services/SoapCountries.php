<?php

namespace App\Services;
use SoapClient;

trait SoapCountries{

    private $soap_countries;

    public function soapCountries(){
        $this->soap_countries=new SoapClient(env("SOAP_WSDL"));
    }

}

?>