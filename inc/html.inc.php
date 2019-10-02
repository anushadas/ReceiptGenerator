<?php

function html_header($title)  { ?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title><?php echo $title; ?></title>
  </head>
  <body>
    <h1><?php echo $title; ?></h1>


<?php }

function html_footer()  { ?>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>
<?php }

function html_uploadForm()  { ?>
    <p>Please select a file to upload</p>
    <FORM METHOD="POST" ACTION="" ENCTYPE="multipart/form-data">
    <INPUT TYPE="file" NAME="CSVUpload">
    <INPUT TYPE="Submit" VALUE="Upload File">
    </FORM>

<?php }

function html_printReceipt($data, $totalInfo) {

    echo '<TABLE BORDER=1 WIDTH="80%">';

    for($i= 0 ;$i <count($data); $i ++)   {
        $entry = $data[$i];
        if($i == 0)
        {
            echo '<TR style="font-weight:bold">';
                echo '<TD>';
                echo "Item Number";
                echo '</TD>';
                echo '<TD>';
                echo "Item Description";
                echo '</TD>';
                echo '<TD>';
                echo "Cost";
                echo '</TD>';
                echo '<TD>';
                echo "Quantity";
                echo '</TD>';
                echo '<TD>';
                echo "Price";
                echo '</TD>';
            echo '</TR>';
        }
        else
        {
        echo '<TR>';
        
            foreach($entry as $attribute)  {
                echo '<TD>';
                echo $attribute;
                echo '</TD>';
            }
        echo '</TR>';
        }
    }

    echo '</TABLE>';
    foreach($totalInfo as $key=>$ele)
    {
        echo "<b>". $key. ": ". $ele. "<br /></b>";
    }

}

?>