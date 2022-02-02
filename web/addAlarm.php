<h2 class="my-5">Adicionar novo Alarme</h2>

<div class="card p-4 w-50">
    <form action="actionAddAlarm.php" method="post" class="d-flex flex-column">
        
        <label for="nome">
            Nome do Alarm
        </label>
        <input type="text" name="name" class="mb-3">

        <label for="startTime">
            Hora do Alarme
        </label>
        <input type="time" name="startTime" class="mb-3">

        <label for="songSelector">
            Selecione a música
        </label>
        <select name="songID" id="songSelector" class="mb-3">
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
        <input type="number" name="songTime" min=1 max=120 class="mb-3">

        <label for="fadeinTime">
            Fade-In (segundos)
        </label>
        <input type="number" name="fadeinTime" min=1 max=120 class="mb-3">

        <label for="fadeoutTime">
            Fade-Out (segundos)
        </label>
        <input type="number" name="fadeoutTime" min=1 max=120 class="mb-3">

        <button type="submit" class="btn btn-success">Adicionar Alarme</button>
        
    </form>
</div>

