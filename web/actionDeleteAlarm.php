<?php
    include('head.php'); 
    include('menu.php');
    include('mysql.php');

    $alarmID = $_GET['alarmID'];
    
    $sql = "DELETE FROM AlarmSong WHERE alarmID = $alarmID";
    mysqli_query($cn, $sql);

    $sql = "DELETE FROM Alarm WHERE alarmID = $alarmID";
    mysqli_query($cn, $sql);
?>
 <h2>Alarme excluido com sucesso com sucesso.</h2>
 
</body>
</html>