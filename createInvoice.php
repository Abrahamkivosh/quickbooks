<?php

use QuickBooksOnline\API\Facades\Invoice;

include_once "includes.php";

$invoiceToCreate = Invoice::create([
    "DocNumber" => "103",
    "Line" => [
        [
            "Description" => "online hosting for Alex",
            "Amount" => 450.00,
            "DetailType" => "SalesItemLineDetail",
            "SalesItemLineDetail" => [
                "ItemRef" => [
                    "value" => 2,
                    "name" => "Services"
                ]
            ]
        ]
    ],
    "CustomerRef" => [
        "value" => "1",
        "name" => "Alex"
    ]
]);

 $response =  $dataService->add($invoiceToCreate) ;

$response= json_encode($response) ;
print_r($response) ;
