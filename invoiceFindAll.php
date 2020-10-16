<?php

use QuickBooksOnline\API\Facades\Invoice;

include_once "includes.php";
$all = $dataService->FindAll("Invoice",2,20) ;
foreach ($all as $key => $invoice) {
    $singleInvoice = $dataService->FindById($invoice);
    print_r($singleInvoice);
    echo "<br /><br />" ;
}



//geting company info
echo "<br /><br />" ;
$companyInfo  = $dataService->getCompanyInfo() ;
$companyPref = $dataService->getCompanyPreferences() ;
// print_r($companyPref);