<?php

function mkmap($dir){
    $folder = opendir ($dir);

    while ($file = readdir ($folder)) {
        if ($file != "." && $file != "..") {
            $pathfile = $dir.DIRECTORY_SEPARATOR.$file;
            return "<li><button type='submit' name='directory' value='$file'><img src='assets/images/directory_mini.png' class='img_directoryMini'>$file</button></li>";
            if(filetype($pathfile) == 'dir'){
                mkmap($pathfile);
            }
        }
    }
    closedir ($folder);
}

/*
foreach ($startArray as $value) {
  $file = $value;
  $hideFile = hide($file);
  $keyHideFile = array_keys($hideFile);
  $fileHideShow = show($hideFile);
}

  function hide($file) {
    $fileArray = explode(" ", $file);
     foreach ($fileArray as $key => $value) {
       $key = ' ';
        $fileArray = [
          $key => $value
        ];
        return $fileArray;
    }
  }

  function show($hideFile) {
    foreach ($hideFile as $value) {
      echo $value;
    }
  }
*/
?>
