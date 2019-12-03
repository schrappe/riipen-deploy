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


<br>

<div class="container">
  <div class="row">

    <div class="col-sm-6">
      <h5>PDF File Upload</h5>
      <p>Select and upload a PDF file to be processed, classified per Climate Change Event Type, Geopolitical Entities and Actionable Items
        extracted using NLP techniques in Python code running on AWS lambda functions.
        On multiple-page PDF files, every page is processed as a block of text.
        Results can also be downloaded as a JSON data object.</p>
      <br>
      <form action="upload_test_memory.php" method="post" enctype="multipart/form-data">
        <input type="file" name="image" size="50" />
        <br><br>
        <button type="submit" class="btn btn-primary"><i class="fa fa-cloud-upload"></i> Upload file</button>
      </form>
    </div>

    <div class="col-sm-6">
      <h5>Enter Raw Text</h5>
      <p>Alternatively, a block of text can be entered here. Type or copy and paste text to process as a single block.</p>

      <form action="upload_test_memory.php" method="post">
        <div class="form-group">
          <textarea class="form-control" rows="10" name="prodText" id="prodText"></textarea>
        </div>
        <button type="submit" class="btn btn-primary"><i class="fa fa-cloud-upload"></i> Upload text</button>
      </form>


    </div>

  </div>
</div>

</body>
</html>
