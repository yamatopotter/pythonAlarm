<?php
    include('head.php'); 
    include('menu.php');
    include('mysql.php');

    $alarmID = $_POST['alarmID'];
    $alarmName = $_POST['name'];
    $startTime = $_POST['startTime'];
    $songID = $_POST['songID'];
    $songTime = $_POST['songTime'];
    $fadeinTime = $_POST['fadeinTime'];
    $fadeoutTime = $_POST['fadeoutTime'];
    $alarmeAtivo = $_POST['alarmeAtivo'];
    
    $sql = "UPDATE Alarm SET name = '$alarmName', startTime = '$startTime', enabled = $alarmeAtivo WHERE alarmID = $alarmID";
    mysqli_query($cn, $sql);

    $sql = "UPDATE AlarmSong SET songID=$songID, songTime=$songTime, fadeinTime = $fadeinTime, fadeoutTime = $fadeoutTime WHERE alarmID = $alarmID";
    mysqli_query($cn, $sql);
?>
<div class="container"> 
    <h2 class="my-5">Alarme editado com sucesso.</h2>
</div>
</body>
</html>