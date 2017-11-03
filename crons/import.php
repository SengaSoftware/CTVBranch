<?php

require("init.php");
require_once APPLICATION_PATH . "/models/Offer.php";
require_once APPLICATION_PATH . "/models/Central.php";
require_once APPLICATION_PATH . "/class/tvOffer.php";
echo "-- Start cron -- \n";
$model = new Application_Model_Central();

try
{
    if($model->updateFromCentral())
        echo 'Database updated: '.date("Y-m-d H:i:s");
} catch (Exception $ex) {
        echo 'Error updating: '.date("Y-m-d H:i:s");
}
echo "-- End cron -- \n";