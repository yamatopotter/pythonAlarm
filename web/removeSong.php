<h1 class="my-5">Remover música</h1>

<form action="action_removeSong.php" method="post">
    <label for="songSelection">
        Selecione a música a ser excluida do sistema
    </label>

    <select name="songSelection" class="form-select mb-3">
        <?php
            include('mysql.php');
            $sql = "Select * FROM Song";

            $result = mysqli_query($cn, $sql);

            $rc = mysqli_num_rows($result);
            if($rc > 0){
                while($song = mysqli_fetch_assoc($result)){
                    $id=$song['songID'];
                    $name=$song['name'];
                    echo "<option value='$id'>$name</option>";
                }
            }

        ?>
    </select>
    <button type="submit" class="btn btn-danger">Remover música do sistema</button>
</form>