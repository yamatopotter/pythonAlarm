<h2>Listar Alarmes</h2>

<?php 
    include('mysql.php');

    $sql = "SELECT * FROM `listSongs`";
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
        $alarmName = $row['alarmName'];
        $startTime = $row['startTime'];
        $songName = $row['songName'];
        $songTime = $row['songTime'];
        $fadeinTime = $row['fadeinTime'];
        $fadeoutTime = $row['fadeoutTime'];
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
