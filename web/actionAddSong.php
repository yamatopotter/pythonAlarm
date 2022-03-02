<?php
include('head.php'); 
include('menu.php');
?>

  <main>
    <section class="message">
      <div class="container">
        <h1 class="my-5">Relatório do upload</h1>
        <?php
          include('mysql.php');

          $target_dir = "songs/";
          $filename = basename($_FILES["newSong"]["name"]);
          $target_file = $target_dir . basename($_FILES["newSong"]["name"]);
          $uploadOk = 1;
          $songFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

          $mimes=array('audio/x-mp3', 'audio/x-mpeg-3', 'audio/mpeg3', 'audio/mpeg');

          if(isset($_FILES)) {
            $type = $_FILES['newSong']['type'];
            $checkFile = in_array($_FILES['newSong']['type'], $mimes);
            $checkSize = $_FILES["newSong"]["size"];
            if($checkFile !== false) {
              echo "<p class='mb-2'>O arquivo é uma música - " . $_FILES['newSong']['type'] . ".</p>";
              $uploadOk = 1;
            } else {
              echo "<p class='mb-2'>O arquivo não é uma música, portanto o upload não pode continuar</p>";
              $uploadOk = 0;
            }
          }

          if ($uploadOk == 0) {
              echo "<h2 class='mb-2'>Desculpe, seu arquivo não foi aceito.</h2>";
            // if everything is ok, try to upload file
            } else {
              if (move_uploaded_file($_FILES["newSong"]["tmp_name"], $target_file)) {
                echo "<p class='mb-2'>O arquivo ". htmlspecialchars( basename( $_FILES["newSong"]["name"])). " foi adicionado ao sistema com sucesso.</p>";
                $sql = "INSERT INTO Song (name, path) VALUES ('$filename', '$target_file')";
                mysqli_query($cn, $sql);
              } else {
                echo "<h2 class='mb-2'>Desculpe, houve um erro no processamento do seu upload.</h2>";
              }
            }
        ?>
      </div>
    </section>
  </main>
</body>
</html>