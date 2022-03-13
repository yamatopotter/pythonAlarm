<h2 class="my-5">Listar Alarmes</h2>

<?php 
    include('mysql.php');

    $sql = "SELECT 
    a.name as nomeAlarme, a.startTime as horaDoAlarme, a.alarmID as alarmID,
    aa.Nome as area, aa.GPIO_PORT as porta,
    also.songTime as tempoMusica, also.fadeinTime as fadeIn, also.fadeoutTime as fadeout,
    s.name as songName, s.path as path
    FROM Alarm as a 
    INNER JOIN AlarmArea as aa ON aa.ID = a.AlarmeAreaID
    INNER JOIN AlarmSong as also ON also.alarmID = a.alarmID
    INNER JOIN Song as s ON s.songID = also.songID;";
    $result = mysqli_query($cn, $sql);
?>

<table class="table table-info table-striped">
    <tr>
        <th scope="col">Nome do Alarme</th>
        <th scope="col">Hora de Inicio</th>
        <th scope="col">Música</th>
        <th scope="col">Tempo de Música</th>
        <th scope="col">Fade In</th>
        <th scope="col">Fade Out</th>
        <th scope="col">Ações</th>
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

        echo "<tr>
                <td scope='row'>$alarmName</td>
                <td >$startTime</td>
                <td>$songName</td>
                <td>$songTime</td>
                <td>$fadeinTime</td>
                <td>$fadeoutTime</td>
                <td>
                    <a href='confirmDeleteAlarm.php?id=$alarmID' class='btn-table'><img src='./assets/img/delete.png' alt='Excluir Alarme'></a>
                    <a href='editAlarm.php?id=$alarmID' class='btn-table'><img src='./assets/img/edit.png' alt='Editar Alarme'></a>
                </td>
        </tr>";
    }

    ?>
</table>
