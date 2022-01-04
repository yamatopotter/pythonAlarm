<?php 
    include('head.php'); 
    include('menu.php');
    include('mysql.php');

    $alarmID = $_GET['id'];
    $sql = "SELECT * FROM `listSongs` WHERE alarmID = $alarmID";
    $result = mysqli_query($cn, $sql);

    $row = mysqli_fetch_assoc($result);
    $alarmName = $row['alarmName'];
    $startTime = $row['startTime'];
    $songName = $row['songName'];
    $songID = $row['songID'];
    $songTime = $row['songTime'];
    $fadeinTime = $row['fadeinTime'];
    $fadeoutTime = $row['fadeoutTime'];
?>
<h2>Edição de Alarme</h2>

<form action="actionEditAlarm.php" method="post">
    <input type="text" class="invisible" name="alarmID" value="<?php echo $alarmID; ?>" readonly>
    <label for="nome">
        Nome do Alarme
    </label>
    <input type="text" name="name" value="<?php echo $alarmName; ?>">

    <label for="startTime">
        Hora do Alarme
    </label>
    <input type="time" name="startTime" value="<?php echo $startTime; ?>">
    
    <select name="songID">
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
    <input type="number" name="songTime" min=1 max=120 value="<?php echo $songTime; ?>">

    <label for="fadeinTime">
        Fade-In (segundos)
    </label>
    <input type="number" name="fadeinTime" min=1 max=120 value="<?php echo $fadeinTime; ?>">

    <label for="fadeoutTime">
        Fade-Out (segundos)
    </label>
    <input type="number" name="fadeoutTime" min=1 max=120 value="<?php echo $fadeoutTime; ?>">

    <button type="submit">Alterar Alarme</button>
</form> 

    </body>
</html>
