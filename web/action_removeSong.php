<?php

include('head.php'); 
include('menu.php');
include('mysql.php');

$id = $_POST['songSelection'];
$sql = "SELECT path FROM Song WHERE songID=$id";
$result = mysqli_query($cn, $sql);

$path = mysqli_fetch_assoc($result);
$path = $path['path'];

$sql = "DELETE FROM Song Where songID=$id";
mysqli_query($cn, $sql);
unlink($path);

?>

<main>
    <section class="message">

        <div class="container">
            <h1 class="my-5">Música removida com sucesso.</h1>
        </div>

    </section>
</main>

</body>
</html>