<h2>Listar Alarmes</h2>

<?php 
    include('mysql.php');

    $sql = "SELECT a.name as nomeAlarme, a.startTime as horaDoAlarme, aa.Nome as area, aa.GPIO_PORT as porta, also.songTime as tempoMusica, also.fadeinTime as fadeIn, also.fadeoutTime as fadeout, s.path as path FROM Alarm as a INNER JOIN AlarmArea as aa ON aa.ID = a.AlarmeAreaID INNER JOIN AlarmSong as also ON also.alarmID = a.alarmID INNER JOIN Song as s ON s.songID = also.songID";
    $result = mysqli_query($cn, $sql);
?>

<table>
    <tr>
        <th>Nome do Alarme</th>
        <th>Hora de Inicio</th>
        <th>Música</th>
        <th>Tempo de Música</th>
        <th>Fade In</th>
        <th>Fade Out</th>
        <th>Ações</th>
    </tr>


    <?php

    while($row = mysqli_fetch_assoc($result)){
        $alarmName = $row['nomeAlarme'];
        $startTime = $row['horaDoAlarme'];
        $songName = $row['songName'];
        $songTime = $row['tempoMusica'];
        $fadeinTime = $row['fadeIn'];
        $fadeoutTime = $row['fadeout'];
        $alarmID = $row['alarmID'];

        echo "<tr><td>$alarmName</td>
        <td>$startTime</td>
        <td>$songName</td>
        <td>$songTime</td>
        <td>$fadeinTime</td>
        <td>$fadeoutTime</td>
        <td>
            <a href='confirmDeleteAlarm.php?id=$alarmID'><img src='./assets/img/delete.png' alt='Excluir Alarme'></a>
            <a href='editAlarm.php?id=$alarmID'><img src='./assets/img/edit.png' alt='Editar Alarme'></a>
        </td>
        </tr>";
    }

    ?>
</table>
