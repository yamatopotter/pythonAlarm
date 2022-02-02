<?php 
    include('head.php'); 
    include('menu.php');
?>
        <main>
            <div class="container">
                <?php
                    $opMenu = $_GET['op'];
                    if ($opMenu == null):
                        $opMenu = 0;
                    endif;

                    switch($opMenu){
                        case 0: 
                            include('intro.php');
                            break;
                        case 1:
                            include('addSong.php');
                            break;
                        case 2:
                            include('removeSong.php');
                            break;
                        case 3:
                            include('addAlarm.php');
                            break;
                        case 4:
                            include('listAlarms.php');
                            break;
                    }
                ?>
            </div>
        </main>
    </body>
</html>
