<?php

function navAsideGoUp($newPosition, $navAsidePoint){
  for($i = 0; $i < $newPosition; $i++){
    $navAsidePoint = substr($navAsidePoint,0,-3);
  }
  return $navAsidePoint;
}

function navAsideGoDown($navAsidePoint){
  for($i = 0; $i < 1; $i++){
    $navAsidePoint = $navAsidePoint . '..' . DIRECTORY_SEPARATOR;
  }
  return $navAsidePoint;
}

function breadCrumbs($pathCurrent,$firstDirectory) {
  $breadCrumbs = explode(DIRECTORY_SEPARATOR, $pathCurrent);
  $position = array_search($firstDirectory,$breadCrumbs);
  $breadCrumbs = array_slice($breadCrumbs, $position + 1);
  if(empty($breadCrumbs)){
    echo "<li></li>";
  } else {
    foreach ($breadCrumbs as $value) {
      echo "<li><button type='submit' name='directory' value='$value'>$value</button></li>";
    }
  }
}

function renameElement($pathCurrent , $name){
  $f = $name[1];
  $d = $name[0];
  rename($pathCurrent.DIRECTORY_SEPARATOR.$f , $pathCurrent.DIRECTORY_SEPARATOR.$d);
}

function create($pathCurrent, $fileName){
  if(stristr($fileName, '.')){
    fopen($pathCurrent .DIRECTORY_SEPARATOR. $_POST['create'], 'c+b');
  } else {
    mkdir($pathCurrent .DIRECTORY_SEPARATOR. $_POST['create']);
  }
}

function elementFunction($value){
  echo "<form method='POST' action='_logic.php'>
          <input type='text' name='rename[]'>
          <input type='hidden' name='rename[]' value='$value'>
          <input type='submit' name='rename[]' value='Renommer'>
        </form>
       </div>";
}

function architectExplorer($dir){
   echo "<ul>";
    $folder = opendir ($dir);

    while ($file = readdir ($folder)) {
        if ($file != "." && $file != "..") {
            $pathfile = $dir.DIRECTORY_SEPARATOR.$file;

            if ($file == strstr($file, '.') || substr($file, -4) == ".txt") {
              echo"";
            } else {
              echo "<li>> <button type='submit' name='directory' value='$file'><img src='assets/images/directory_mini.png' class='img_directoryMini'>$file</button></li></br>";
            }

            if(filetype($pathfile) == 'dir'){
                architectExplorer($pathfile);
            }
        }
    }
    closedir ($folder);
    echo "</ul>";
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
