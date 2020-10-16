<?php

use QuickBooksOnline\API\Facades\Invoice;

include_once "includes.php";

$singleInvoice = $dataService->FindById("Invoice", 150);


print_r($singleInvoice);

//geting company info
echo "<br /><br />" ;
$companyInfo  = $dataService->getCompanyInfo() ;
$companyPref = $dataService->getCompanyPreferences() ;
// print_r($companyPref);