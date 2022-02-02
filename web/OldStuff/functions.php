<?php
    include('mp3FileClass.php');
    
    function addSongDB(){

    }

    function removeSongDB(){

    }

    function searchSongDB($file){
        if (file_exists($file)) {
            echo "Sorry, file already exists.";
            $uploadOk = 0;
          }
    }

    function limitSongSize($size){
        if ($size > 1000000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
          }
    }

    function checkSongDuration($file){
        $mp3file = new MP3File($file);
        $duration1 = $mp3file->getDurationEstimate();//(faster) for CBR only
        $duration2 = $mp3file->getDuration();//(slower) for VBR (or CBR)
        echo "duration: $duration1 seconds"."\n";
        echo "estimate: $duration2 seconds"."\n";
        echo MP3File::formatTime($duration2)."\n";
    }

?>