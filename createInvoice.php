<?php

use QuickBooksOnline\API\Facades\Invoice;

include_once "includes.php";

$invoiceToCreate = Invoice::create([
    "DocNumber" => "104",
    "Line" => [
        [
            "Description" => "vegitables for Salome",
            "Amount" => 450.00,
            "DetailType" => "SalesItemLineDetail",
            "SalesItemLineDetail" => [
                "ItemRef" => [
                    "value" => 2,
                    "name" => "Services"
                ],
                // "TaxCodeRef"=>[
                //     "value"=>2
                // ]
            ]
        ]
    ],
    
    "CustomerRef" => [
        "value" => "2",
        "name" => "salome"
    ]
]);

 $response =  $dataService->add($invoiceToCreate) ;

$response= json_encode($response) ;
print_r($response) ;
