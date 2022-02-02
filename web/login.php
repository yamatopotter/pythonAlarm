<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Falha no login</title>
</head>
<?php
    include('mysql.php');

    $user = $_POST['user'];
    $password = $_POST['password'];

    $password = sha1($password);

    $sql = "SELECT * FROM User WHERE user='$user' AND password='$password'";
    mysqli_query($cn, $sql);

    if(mysqli_affected_rows($cn) > 0):
?>

<body>
<script>
    window.location.href="http://<?php echo $host; ?>/admin.php";
</script>
</body>
</html>

<?php
    else:
?>

<body>
    <h1>Falha no login</h1>
    <a href="index.php">Tente novamente</a>
</body>
</html>

<?php
    endif;
?>