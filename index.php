<?php
$url = getcwd();
$current_dir = scandir($url);

//Récupérer l'url du répertoire de travail courant et afficher le contenu du dossier
if($url == FALSE){
  echo "Vous n'avez pas accès au dossier";
} else{
  $dir_start = scandir(getcwd());
  /*print_r($dir_start);*/
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
    //print_r($dir_start);

  } else {
    mkdir($path_start);
    chdir($path_start);
    $dir_start =scandir(getcwd());
    //print_r($dir_start);
  }
}



// Faire en sorte que . et .. n’apparaissent pas
$dir_start[0] = '';
$dir_start[1] = '';
print_r($dir_start );
?>
