<?php 
    include('head.php'); 
    include('menu.php');
    include('mysql.php');

    $alarmID = $_GET['id'];
    $sql = "SELECT * FROM `listSongs` WHERE alarmID = $alarmID";
    $result = mysqli_query($cn, $sql);

    $row = mysqli_fetch_assoc($result);
    $alarmName = $row['alarmName'];
?>
<h1>Exclusão de Alarme</h1>

<h2>Tem certeza que deseja excluir o alarme <?php echo $alarmName; ?> do sistema?</h2>
<a href="actionDeleteAlarm.php?id=<?php echo $alarmID; ?>" class="btn btn-yes">Sim</a>
<a href="listAlarms.php" class="btn btn-no">Não</a>
</body>
</html>