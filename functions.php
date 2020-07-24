<?php

$url = getcwd();
$current_dir = scandir($url);

//Récupérer l'url du répertoire de travail courant et afficher le contenu du dossier
if($url == FALSE){
  echo "Vous n'avez pas accès au dossier";
} else{
  $dir_start = scandir(getcwd());

}
//Le répertoire de départ
if($url == FALSE){
  echo "Vous n'avez pas accès au dossier";
} else {
  $start_dir = "start";
  $path_start = getcwd() . DIRECTORY_SEPARATOR . $start_dir;

  if(in_array($start_dir, $current_dir)){
    chdir($path_start);
    $dir_start = scandir(getcwd());
  } else {
    mkdir($path_start);
    chdir($path_start);
    $dir_start = scandir(getcwd());
  }
  foreach ($current_dir as $value) {
    if($value == "start"){
        $positionStart = $value;
        $breadCrumbs = implode(DIRECTORY_SEPARATOR, array_slice($dir_start,($positionStart  - 1)));
        //echo $breadCrumbs;
        $startArray = explode(DIRECTORY_SEPARATOR, $breadCrumbs);
      }
    }
}

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

?>
