<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CTVBackendService
 *
 * @author ejacwro
 */
class CTVBackend {
    /**
     * Returns list of tvOffers
     *
     * @return tvOffer[]
     */
    public function getOffers()
    {
        $mdl = new Application_Model_Offer();
        return $mdl->getOffers();
    }
}
