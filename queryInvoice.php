<?php

use QuickBooksOnline\API\Facades\Invoice;

include_once "includes.php";

$allInvoice = $dataService->Query("SELECT * FROM Invoice",1,50);
// $invoicesGreaterThenThousand = $dataServices->Query("SELECT * FROM Invoice WHERE TotalAmt > '1000.0'");

 function queryall($invoces)
{
    foreach ($invoces as $key => $invoce) {
        // print_r( json_encode( $invoces)) ;
        echo "<br />Id : <strong>" . $invoce->Id  . "</strong><br />" ;
        echo "<br />SyncToken : <strong>" . $invoce->SyncToken  . "</strong><br />" ;
        echo "<br />MetaData : <strong>" . $invoce->MetaData->CreateTime  . "</strong><br />" ;
        
        foreach ( $invoce->Line  as $key => $line) {
            echo "<br />Item Info Description : <strong>" .$line->Description . "</strong><br />" ;
            echo "<br />Item Info Amount : <strong>" . $line->Amount . "</strong><br />" ;
        }

    }
}
queryall($allInvoice) ;