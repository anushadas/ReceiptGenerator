<?php

//Require the files
require_once("inc/config.inc.php");
require_once("inc/file.inc.php");
require_once("inc/html.inc.php");
require_once("inc/receipt.inc.php");
//Html header
html_header("Lab 04 - Recept Generator");


//Check if there where files posted,
if (isset($_FILES['CSVUpload'])) {
    //Read the file
    $input = file_read($_FILES['CSVUpload']['tmp_name']);
    //Parse the File
    $receipt = parseReceipt($input);


        //Calculate
        $receiptData = calculateReceiptData($receipt);
        //Calcualte the Totals and Tax
        $totalsInfo = calculateTotalsnTax($receiptData);
        //Render the results
        html_printReceipt($receiptData, $totalsInfo);
        //Assemble the updated CSV file with the total
        $fileContents = assembleCSVReceipt($receiptData);
        //Write out the file;
        writeFile($fileContents);
}
else
{
    //Render the upload form
    html_uploadForm();
}

//Html footer
html_footer();
?>