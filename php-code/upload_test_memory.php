<!DOCTYPE html>
<html lang="en">
<head>
  <title>Machine Learning Course</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>
</head>
<body>

  <div class="jumbotron jumbotron-fluid">
    <div class="container">
      <img class="img-responsive" src = "https://deploy-pdf.s3.amazonaws.com/utscs.png" width="400"></a>
      <br><br>
      <h2><p class="text-secondary">Climate Change Classifier and Key Actions Extractor</p></h2>
      <p class="text-secondary">SCS_3253_017 Machine Learning – Riipen Project for Deploy Solutions – December/2019</p>
    </div>
  </div>

  <div class="container">

<?php

  $pastedText = $_POST["prodText"];

  if (is_null($pastedText)) {

 // Nice little class to retrieve PDF text:
 include 'pdfparser-master/vendor/autoload.php';

 $targetfolder = $targetfolder . basename( $_FILES['image']['name']) ;

 $pdfName = $_FILES['image']['name'];
 $temp_file_location = $_FILES['image']['tmp_name'];


echo "<br>";
echo "<br>";

 // Parse pdf file and build necessary objects.
 $parser = new \Smalot\PdfParser\Parser();
 $pdf    = $parser->parseFile($temp_file_location);

 // Retrieve all pages from the pdf file.
 $pages  = $pdf->getPages();

 // Array of texts
 $textArray = '["';

 //Loop over each page to extract text.
$pageNumber = 0;
foreach ($pages as $page) {
    $pageNumber = $pageNumber +1;
    $pageContent = $page->getText();
    $pageContent = preg_replace('/[^a-z0-9\.,!?$;]/i', ' ', $pageContent);

    if ($pageNumber == 1) {
      $textArray .= $pageContent.'"';
    }
    else {
      $textArray .= ',"'.$pageContent.'"';
    }

    }
    $textArray .= ']';

}

else {
  $pastedText = preg_replace('/[^a-z0-9\.,!?$;]/i', ' ', $pastedText);
  $textArray = '["'.$pastedText.'"]';
  $pdfName = "uploaded text";
}
    // AWS Lambda calls sending text array as body
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL,            "https://pimput9831.execute-api.us-east-1.amazonaws.com/default/nlp-disaster-api" );
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1 );
    curl_setopt($ch, CURLOPT_POST,           1 );
    curl_setopt($ch, CURLOPT_POSTFIELDS,     $textArray);
    curl_setopt($ch, CURLOPT_HTTPHEADER,     array('x-api-key: U5qu4OKBst7vyzbYtjjE61A888qUWAGT4j1gtHAt'));

    $result=curl_exec ($ch);
    curl_close($ch);

    # Modal to download the JSON code

    echo '<button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal"><i class="fa fa-cloud-download"></i> Download JSON Data for '.$pdfName.'</button>'."    ";
    echo '<a href="index.php" class="btn btn-success float-right" role="button"><i class="fa fa-magic"></i> Let\'s do this again!</a>';
    echo '<br>';
    echo '<br>';

    echo '<div class="modal" id="myModal">';
      echo '<div class="modal-dialog modal-lg">';
        echo '<div class="modal-content">';

          echo '<div class="modal-header">';
            echo '<h4 class="modal-title">Climate Change Classifier and Key Actions Extractor - JSON Data</h4>';
            echo '<button type="button" class="close" data-dismiss="modal">&times;</button>';
          echo '</div>';

          echo '<div class="modal-body">';
          echo $result;
          echo '</div>';

          echo '<div class="modal-footer">';
            echo '<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>';
          echo '</div>';

        echo '</div>';
      echo '</div>';
    echo '</div>';




    $fullData = json_decode($result,true);

    # Spit out results
    foreach($fullData as $block){
      #echo "Block ".$block['block'];
      echo "<br>";
      foreach($block['classes'] as $disClass){
        # Assigning colors to classes. We can always use a touch of color.
        $butype = "secondary";
        switch ($disClass) {
          case "Snowstorm":
            $butype = "danger";
            break;
          case "Carbon Neutrality":
            $butype = "dark";
            break;
          case "Climate Change Adaptation":
            $butype = "info";
            break;
          case "Drought":
            $butype = "danger";
            break;
          case "Flooding":
            $butype = "warning";
            break;
          case "Heatwave":
            $butype = "danger";
          break;
          case "Mitigation":
            $butype = "success";
            break;
          case "Severe Wind":
            $butype = "danger";
            break;
          case "Low Temperatures":
            $butype = "info";
            break;
          case "Wildfire":
            $butype = "danger";
            break;
          }

        echo '<button type="button" class="btn btn-'.$butype.' btn-sm"><i class="fa fa-bolt"></i> '.$disClass.'</button>'.' ';
      }

      foreach($block['places'] as $disPlace){
        echo '<button type="button" class="btn btn-light btn-sm"><i class="fa fa-map-o"></i> '.$disPlace.'</button>'.' ';
      }


      echo '<ul class="list-group list-group-flush">';
      foreach($block['actions'] as $disActions){
        echo '<li class="list-group-item">'.$disActions.'</li>';
      }
      echo '</ul>';
    }


 ?>

</div>
</body>
</html>
