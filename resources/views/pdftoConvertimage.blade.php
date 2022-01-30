{{-- <img src="{{$output}}" alt=""> --}}

<?php 
if(isset($_GET['image'])){
    $output=$_GET['image'];
}



?>

<img src="{{$output}}" alt="">

