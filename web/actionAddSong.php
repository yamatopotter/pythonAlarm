<?php
include('head.php'); 
include('menu.php');
include('mysql.php');

$target_dir = "songs/";
$filename = basename($_FILES["newSong"]["name"]);
$target_file = $target_dir . basename($_FILES["newSong"]["name"]);
$uploadOk = 1;
$songFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

$mimes=array('audio/x-mp3', 'audio/x-mpeg-3', 'audio/mpeg3');

if(isset($_POST["submit"])) {
  $checkFile = inarray($_FILES['mp3']['type'], $mimes);
  $checkSize = $_FILES["fileToUpload"]["size"];
  if($check !== false) {
    echo "File is an song - " . $check["mime"] . ".";
    $uploadOk = 1;
  } else {
    echo "File is not an song.";
    $uploadOk = 0;
  }
}

if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
  // if everything is ok, try to upload file
  } else {
    if (move_uploaded_file($_FILES["newSong"]["tmp_name"], $target_file)) {
      echo "The file ". htmlspecialchars( basename( $_FILES["newSong"]["name"])). " has been uploaded.";
      $sql = "INSERT INTO Song (name, path) VALUES ('$filename', '$target_file')";
      mysqli_query($cn, $sql);
    } else {
      echo "Sorry, there was an error uploading your file.";
    }
  }
?>

</body>
</html>