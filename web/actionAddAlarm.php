<?php
    include('head.php'); 
    include('menu.php');
    include('mysql.php');

    $alarmName = $_POST['name'];
    $startTime = $_POST['startTime'];
    $songID = $_POST['songID'];
    $songTime = $_POST['songTime'];
    $fadeinTime = $_POST['fadeinTime'];
    $fadeoutTime = $_POST['fadeoutTime'];
    
    $sql = "INSERT INTO Alarm (name, startTime, userID) VALUES ('$alarmName','$startTime', 1)";
    mysqli_query($cn, $sql);
    $alarmID = mysqli_insert_id($cn);

    $sql = "INSERT INTO AlarmSong (songID, alarmID, songTime, fadeinTime, fadeoutTime) VALUES ($songID, $alarmID, '$songTime','$fadeinTime', '$fadeoutTime')";
    mysqli_query($cn, $sql);
?>
 <h2>Alarme programado com sucesso.</h2>
</body>
</html>