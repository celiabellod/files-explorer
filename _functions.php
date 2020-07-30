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


function addScheme($entry) {
  $tab['name'] = $entry;
  return $tab;
}

function list_dir($base, $cur, $level=0) {
  global $BASE;
  if ($dir = opendir($base)) {
    $tab = [];
    while($entry = readdir($dir)) {
      if(is_dir($base.DIRECTORY_SEPARATOR.$entry) && !in_array($entry, array('.','..'))) {
        $tab[] = $entry;
      }
    }

    foreach($tab as $elem) {
      $entry = $elem;
      $file = $base.DIRECTORY_SEPARATOR.$entry;
      for($i=1; $i<=(4*$level); $i++) {
        echo ' ';
      }

      if($file == $cur) {
        echo "<img src='assets/images/directory_mini.png' width='20px'/> $entry<br/>";
      } else {
        echo"<form method='POST' action='index.php'>
              <li><img src='assets/images/directory_mini.png' width='20px'/>
              <button type='submit' name='dir' value='$file'>$entry</button></li>
            </form>";
      }

      if(preg_match("#".$file.'/#',$cur.DIRECTORY_SEPARATOR)) {
        list_dir($file, $cur, $level+1);
      }
    }
    closedir($dir);
  }
}

function rrmdir($dir) {
  if (is_dir($dir)) {
    $files = scandir($dir);
    foreach ($files as $file)
    if ($file != "." && $file != "..") rrmdir("$dir/$file");
    rmdir($dir);
  }
  else if (file_exists($dir)) unlink($dir);
}

// copies files and non-empty directories
function cut($src, $dst, $dir) {
  if (file_exists($src)){
    if (is_dir($src .DIRECTORY_SEPARATOR. $dir)) {
      $files = scandir($src .DIRECTORY_SEPARATOR. $dir);
      foreach ($files as $file){
        if ($file != "." && $file != ".."){
          rcopy($src, $dst, $file);
        }
      }
      rrmdir($src .DIRECTORY_SEPARATOR. $dir);
      mkdir($dst .DIRECTORY_SEPARATOR. $dir);
    } else if (is_file($dir)){
      rrmdir($src .DIRECTORY_SEPARATOR. $dir);
      touch($src .DIRECTORY_SEPARATOR. $dir);
    }
  }
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
