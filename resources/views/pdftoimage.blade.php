<?php
// require("../vendor/autoload.php");
// use \ConvertApi\ConvertApi;

// ConvertApi::setApiSecret('VNUbyWATgWRnPGvg');
// $msg ="";
// $contents="";
// $output="";
// if (isset ($_POST["submit"])) {
//   $filename = $_FILES["formfile"]["name"];
//   $filetype = $_FILES["formfile"]["type"]; 
//   $filetemp = $_FILES["formfile"]["tmp_name"]; 
//   $dir= 'uploads/'.$filename;
//  if ($filetype == "application/pdf") {
//     move_uploaded_file($filetemp,$dir);
//     $result = ConvertApi::convert('png', [
//         'File' => $dir,

//     ], 'pdf'
// );

// $contents = $result->getFile()->getContents();
// $output="converted_files/".rand();
// $fopen=fopen($output,"w");
// fwrite($fopen,$contents);
// fclose($fopen);
// if ($result) {
//     $msg ="<div class='alert alert-success'>File converted.</div>";
//    } else {
//     $msg ="<div class='alert alert-danger'>something wrong.</div>";
//    }

//  }else {
//     $msg = "<div class='alert alert-danger'>Invalid file format.</div>";
   
//  }
// }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pdf to Image</title>
    <link rel="stylesheet" href="asset/css/style.css">
 
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container py-5">
  <div class="row">
    <div class="col-lg-5 mx-auto">
      <div class="card border p-4 rounded bg-white">
        <div class="card-body">
          <h3 class="card-title mb-3">PDF to PNG converter</h3>
          <form action="pdftoimage" method="POST" enctype="multipart/form-data">
            @csrf
             <div class="mb-3">
               <label for="formFile" class="form-1abel">Browse your file</label>
               <input class="form-control" type="file" id="formfile" name="formfile" required>
             </div>
             <button class="btn btn-primary" name="submit">Convert Now</button>
          </form>
         
        </div>
      </div>
    </div>
  </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>