<?php
session_start();
include '_functions.php';


if(isset($_SESSION['currentPath'])){
  $pathCurrent = $_SESSION['currentPath'];
} else {
  $pathCurrent = getcwd();
}

if(isset($_POST['directory'])){ // if no directory select
  $directory = $_POST['directory'];
  $navAsidePoint = $_SESSION['navAsidePoint'];

  $pathArrayBefore = explode(DIRECTORY_SEPARATOR, $pathCurrent);

  if(in_array($directory, $pathArrayBefore)){
    $positionDirectory = array_search($directory, $pathArrayBefore);
    $pathArrayAfter = array_slice($pathArrayBefore, 0, $positionDirectory + 1);
    $pathCurrent = implode(DIRECTORY_SEPARATOR, $pathArrayAfter);

    $numberArrayBefore = count($pathArrayBefore);
    $numberArrayAfter= count($pathArrayAfter);
    $newPosition  = $numberArrayBefore - $numberArrayAfter;
    $navAsidePoint = navAsideGoUp($newPosition, $navAsidePoint);

  } else {
    $navAsidePoint = navAsideGoDown($navAsidePoint);
    $pathCurrent = $pathCurrent . DIRECTORY_SEPARATOR . $directory;
    if($pathCurrent == null){

    }
  }

  $_SESSION['navAsidePoint'] = $navAsidePoint;
  $_SESSION['currentPath'] = $pathCurrent;
}


if(isset($_POST['rename']) && !empty($_POST['rename'][0])){
  if(file_exists($pathCurrent .DIRECTORY_SEPARATOR. $_POST['rename'][1])){
    renameElement($pathCurrent, $_POST['rename']);
  }else{
    echo $_POST['rename'][1] . ' n\'existe pas';
  }
}

if(isset($_POST['create']) && !empty($_POST['create'])){
  create($pathCurrent, $_POST['create']);
}

if(isset($_POST['showHideFile'][1]) && $_POST['showHideFile'][1] == "showFile"){
    $_SESSION['checked'] = "checked";
} else {
    $_SESSION['checked'] = "unchecked";
}


header('Location: index.php');
