<h2>Adicionar novo Alarme</h2>

<form action="includeAlarm.php" method="post">
    <label for="nome">
        Nome do Alarm
    </label>
    <input type="text" name="name">

    <label for="startTime">
        Hora do Alarme
    </label>
    <input type="time" name="startTime">
    <select name="songID">
        <?php 
            include('mysql.php');

            $sql = "select * from Song";
            $result = mysqli_query($cn, $sql);

            while($row = mysqli_fetch_assoc($result)){
                $songID = $row['songID'];
                $songName = $row['name'];
                echo "<option value='$songID'>$songName</option>";
            }
        ?>
    </select>
    
    <label for="songTime">
        Tempo de Execução (segundos)
    </label>
    <input type="number" name="songTime" min=1 max=120>

    <label for="fadeinTime">
        Fade-In (segundos)
    </label>
    <input type="number" name="fadeinTime" min=1 max=120>

    <label for="fadeoutTime">
        Fade-Out (segundos)
    </label>
    <input type="number" name="fadeoutTime" min=1 max=120>

    <button type="submit">Adicionar Alarme</button>
    
</form>

