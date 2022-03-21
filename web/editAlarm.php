<?php 
    include('head.php'); 
    include('menu.php');
    include('mysql.php');

    $alarmID = $_GET['id'];
    $sql = "SELECT 
    a.name as nomeAlarme, a.startTime as horaDoAlarme, a.alarmID as alarmID, a.enabled as ativo,
    aa.Nome as area, aa.GPIO_PORT as porta,
    also.songTime as tempoMusica, also.fadeinTime as fadeIn, also.fadeoutTime as fadeout,
    s.name as songName, s.path as path, s.songID as songID
    FROM Alarm as a 
    INNER JOIN AlarmArea as aa ON aa.ID = a.AlarmeAreaID
    INNER JOIN AlarmSong as also ON also.alarmID = a.alarmID
    INNER JOIN Song as s ON s.songID = also.songID 
    HAVING alarmID = $alarmID";
    
    $result = mysqli_query($cn, $sql);

    $row = mysqli_fetch_assoc($result);
    $alarmName = $row['nomeAlarme'];
    $startTime = $row['horaDoAlarme'];
    $songName = $row['songName'];
    $songID = $row['songID'];
    $songTime = $row['tempoMusica'];
    $fadeinTime = $row['fadeIn'];
    $fadeoutTime = $row['fadeout'];
    $alarmeAtivo = $row['ativo'];
?>
    <div class="container"> 
        <h2 class="my-5">Edição de Alarme</h2>

        <div class="card p-4 w-50">
            <form action="actionEditAlarm.php" method="post" class="d-flex flex-column">
                <input type="text" class="invisible" name="alarmID" value="<?php echo $alarmID; ?>" readonly>
                <label for="nome">
                    Nome do Alarme
                </label>
                <input type="text" name="name" value="<?php echo $alarmName; ?>" class="mb-3">

                <label for="startTime">
                    Hora do Alarme
                </label>
                <input type="time" name="startTime" value="<?php echo $startTime; ?>" class="mb-3">
                
                <select name="songID" class="mb-3">
                    <?php 
                        $sql = "select * from Song";
                        $result = mysqli_query($cn, $sql);

                        while($row = mysqli_fetch_assoc($result)){
                            $songIDList = $row['songID'];
                            $songNameList = $row['name'];

                            if($songIDList == $songID)
                                echo "<option value='$songIDList' selected>$songNameList</option>";
                            else
                                echo "<option value='$songIDList'>$songNameList</option>";
                        }
                    ?>
                </select>
                
                <label for="songTime">
                    Tempo de Execução (segundos)
                </label>
                <input type="number" name="songTime" min=1 max=120 value="<?php echo $songTime; ?>" class="mb-3">

                <label for="fadeinTime">
                    Fade-In (segundos)
                </label>
                <input type="number" name="fadeinTime" min=1 max=120 value="<?php echo $fadeinTime; ?>" class="mb-3">

                <label for="fadeoutTime">
                    Fade-Out (segundos)
                </label>
                <input type="number" name="fadeoutTime" min=1 max=120 value="<?php echo $fadeoutTime; ?>" class="mb-3">

                <label for="alarmeAtivo">
                    Alarme ativo?
                </label>

                <select name="alarmeAtivo" class="mb-3">
                    <option value="1" <?php if($alarmeAtivo==1) echo "selected"; ?>>Sim</option>
                    <option value="0" <?php if($alarmeAtivo==0) echo "selected"; ?>>Não</option>
                </select>

                <button type="submit" class="btn btn-success">Alterar Alarme</button>
            </form> 
        </div>
    
    </div>                   
    </body>
</html>
