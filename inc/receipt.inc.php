<?php

function parseReceipt($fileContents) {

    //Declare a new array for receipts
    $receipt = array();

    try {
        //Parse the lines
        $lines = explode("\n",$fileContents);
            //Parse the individual line
            for ($x = 0; $x < count($lines); $x++)    {

                try { 
                    //Add each column of each line to the array
                    $columns = explode(",", $lines[$x]);
                    
                    //Check it has the right count, if not throw an exception
                    if (count($columns) != 4)   {
                        throw new Exception("Problem parsing file on line: ".($x + 1)."<BR>");
                    }
                    //Add the column to the array of each line
                    $receipt[] = $columns;
                    } 
                    catch (Exception $ex) {
                        echo $ex->getMessage();
                        error_log($ex->getMessage(), 0, ERRLOG);
                    }
            }
        
        }
    catch (Exception $ex) {

        echo $ex->getMessage();
        //Write to the error log
        error_log($ex->getMessage(), 0 , ERRLOG);

    }
    //Return the multi-dimensional array
    return $receipt;

}

function calculateReceiptData($receipt) {

    $subTotal = 0;
    //Open up each entry
    for($x = 0;$x < count($receipt); $x++)
    {
        if($x == 0)
        $receipt[$x][] = "Price";
        else
        {
        //Calculate the price
        $receipt[$x][] = '$'.sprintf('%0.2f',( ( (float)substr($receipt[$x][2],1) ) * $receipt[$x][3] ));
        //$price = (float)substr($receipt[$x][2],1) * $receipt[$x][3] ;
        //$subtotal += $price;
        }

    }

    return $receipt;

}

function assembleCSVReceipt($receiptData)  {

    //Create the header for the CSV file
    $header = "Item Number,Item Description,Cost,Quantity,Price";
    $csvString = $header. "\n";
    //Itereate through the array and create the CSV file
    for($y = 1; $y< count($receiptData);$y++) 
    {
        $receiptItem = $receiptData[$y]; 
        for($x=0;$x<count($receiptItem);$x++)
        {
            if($x == count($receiptItem)-1)
                $csvString .= $receiptItem[$x];
            else
                $csvString .= $receiptItem[$x].",";
        }
        $csvString .= "\n";
    }

    return $csvString;
}

function calculateTotalsnTax($receipt)  {

    //Intitialize subtotal
    $subTotal = 0;

    //Calculate the subTotal
    for($x = 1;$x < count($receipt); $x++)
    {
        $subTotal += (float)substr($receipt[$x][4],1);
    }
    //Add the value of the slubittal
    $totalsInfo = array(
        "SubTotal"=>'$'.sprintf('%0.2f',$subTotal)
    );
    //Calculate the Tax
    $tax = $subTotal * TAX;
    $totalsInfo["Tax"] = '$'.sprintf('%0.2f',$tax);
    //Calculate the Total
    $total = $subTotal + $tax;
    $totalsInfo["Total"] = '$'.sprintf('%0.2f', $total);
    //Return the associative array
    return $totalsInfo;
}

?>