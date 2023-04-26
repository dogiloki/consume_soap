<?php

namespace App\Services;

use SoapClient;

trait SoapCountries{

    private $_soap_country=null;

    private function soapCountries(){
        if($this->_soap_country==null){
            $this->_soap_country=new SoapClient(env("SOAP_WSDL"));
        }
        return $this->_soap_country;
    }

}

?>