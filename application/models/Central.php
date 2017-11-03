<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Central
 *
 * @author ejacwro
 */
class Application_Model_Central {
    
    public function updateFromCentral()
    {
        try {
            $soapClient = new SoapClient(CENTRAL_URL."/wsdl");
            $result = $soapClient->getOffers();
            $mdlOffer = new Application_Model_Offer();
            $updateResult = $mdlOffer->updateFromCentral($result);
            if($updateResult)
                return TRUE;
            else
                return FALSE;
        } catch (Exception $ex) {
            return FALSE;
        }
    }
}
