<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
require("../vendor/autoload.php");
use \ConvertApi\ConvertApi;

class PtoimageController extends Controller
{
    //
    public function pdftoimage(Request $req){
      
       

        ConvertApi::setApiSecret('VNUbyWATgWRnPGvg');
        $msg ="";
        $contents="";
        $output="";

        if (isset ($_POST["submit"])) {            
        $filename = $_FILES["formfile"]["name"];
        $filetype = $_FILES["formfile"]["type"]; 
        $filetemp = $_FILES["formfile"]["tmp_name"]; 
        $dir= $filename;

            if ($filetype == "application/pdf") {
                move_uploaded_file($_FILES["formfile"]["tmp_name"], public_path($dir));
            
                $result = ConvertApi::convert('png', [
                    'File' => $dir,

                ], 'pdf'
                );

                $contents = $result->getFile()->getContents();
                $output=$filename.'_converted.png';

                $fopen=fopen($output,"w");
                fwrite($fopen,$contents);
                fclose($fopen);

                if ($result) {
                    $msg ="<div class='alert alert-success'>File converted.</div>";
                }else {
                    $msg = "<div class='alert alert-danger'>Invalid file format.</div>";
                }
                // return redirect('pdftoimage',['output'=>$output]);
                

            

            
                
            // return "<img src=\"../$output\">";
            return "<a href=\"../$output\">Download</a>";
                 
            }
        }
    }
    // public function getdata($output){
    //     return view('pdftoConvertimage',['output'=>$output]);
    // }
}
