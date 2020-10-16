<?php

use QuickBooksOnline\API\Facades\Invoice;

include_once "includes.php";


$updateinvoice = $dataService->Query("SELECT * FROM Invoice WHERE DocNumber > '103'");
print_r($updateinvoice) ;
if(!empty($targetInvoiceArray) && sizeof($targetInvoiceArray) == 1){
    $theInvoice = current($targetInvoiceArray);

    $updatedInvoice = Invoice::update($theInvoice, [
        "sparse" => true,
        "Line" => [
          [
            "Description" => "hpsting service for kivosh",
            "Amount" => 150.00,
            "DetailType" => "SalesItemLineDetail",
            "SalesItemLineDetail" => [
              "ItemRef" => [
                "value" => 1,
                "name" => "Services"
              ]
            ]
          ],
          [
            "Description" => "Discount for Kivosh",
            "Amount" => -10.00,
            "DetailType" => "SalesItemLineDetail",
            "SalesItemLineDetail" => [
              "ItemRef" => [
                "value" => 21,
                "name" => "Discount"
              ]
            ]
          ]
         ]
    ]); 

    $updateresult = $dataService->Update($updatedInvoice) ;

    print_r($updateresult) ;


}