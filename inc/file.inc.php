<?php

function file_read($fileName) {

    try {
        //Open a File Handle
        $fh = fopen($fileName,'r');

        if (!$fh)   {
            throw new Exception("Could not open $fileName");
        }
        //Read the contents
        $contents = fread($fh,filesize($fileName));

        //Close the file Handle
        fclose($fh);
      
        //Check if the contents are empty, if they are then throw an exception
        if(empty($contents))
        {
            throw new Exception("File is empty");
        }
    }
    //Catch the exception
    catch(Exception $ex)
    {
        echo $ex->getMessage();
        //Wirte to the error log
        error_log($ex->getMessage(),0, ERRLOG);
    }
    //Return the file contents
    return $contents;
}
    
    
    

function writeFile($fileContents)    {

    try {
        //Open the file handle with the write mode
        $fh = fopen(OUT_FILE,'w');

        fwrite($fh,$fileContents);
        //Check if the contents are empty, if they are then throw an exception
        if(empty($fileContents))
        {
            throw new Exception("No contents to be written");
        }

        fclose($fh);
    }
    catch(Exception $ex)
    //Catch the exception
    {
        echo $ex->getMessage();
        //Wirte to the error log
        error_log($ex->getMessage(),0 , ERRLOG);
    }
}

?>