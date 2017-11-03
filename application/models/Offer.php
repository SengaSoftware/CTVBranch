<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class Application_Model_Offer extends Zend_Db_Table_Abstract{
    protected $_name = 'offers';
//    protected $_rowClass = 'tvOffer';


    public function getOffers()
    {
        $list = $this->fetchAll();
        
        $ret = new ArrayObject();
        foreach ($list as $row)
        {
            $tmpOffer = new tvOffer();
            $tmpOffer->id = $row->id;
            $tmpOffer->offerActivationPrice = $row->offerActivationPrice;
            $tmpOffer->offerCurrency = $row->offerCurrency;
            $tmpOffer->offerDescription = $row->offerDescription;
            $tmpOffer->offerMonthlyLength = $row->offerMonthlyLength;
            $tmpOffer->offerMonthlyPrice = $row->offerMonthlyPrice;
            $tmpOffer->offerName = $row->offerName;
            $art = new SoapVar($tmpOffer, SOAP_ENC_OBJECT,null,null, "tvOffer");
//            $art = new SoapVar($tmpOffer, SOAP_ENC_OBJECT, "tvOffer");
            $ret->append($art);
//            $ret->append($tmpOffer);

        }
        return $ret;
    }
    
    public function addOffer($offer)
    {
        $row = $this->createRow();
        if ($row) {
            $row->offerActivationPrice = $offer->offerActivationPrice;
            $row->offerCurrency = $offer->offerCurrency;
            $row->offerDescription = $offer->offerDescription;
            $row->offerMonthlyLength = $offer->offerMonthlyLength;
            $row->offerMonthlyPrice = $offer->offerMonthlyPrice;
            $row->offerName = $offer->offerName;
            return $row->save();
        }
        return FALSE;
    }
    
    public function updateFromCentral($list)
    {
        try {
            $this->getAdapter()->beginTransaction();
            $this->delete(TRUE);
            foreach ($list as $item)
            {
                $this->addOffer($item);
            }
            $this->getAdapter()->commit();
            return TRUE;
        
        } catch (Exception $ex) {
            $this->getAdapter()->rollBack();
            return FALSE;
        }
        
    }
}
