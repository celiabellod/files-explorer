### Récupérer l'url du répertoire de travail courant et afficher le contenu du dossier
- Si le dossier courant n'est pas accessible alors il affiche un message d'erreur " Vous n'avez pas accès à ce dossier"
- Si le dossier courant est accessible il faut l'afficher.

```
if($url == FALSE){
  echo "Vous n'avez pas accès au dossier";
} else{
  $dir_start = scandir(getcwd());
}
```

### Le répertoire de départ
Au lancement du script:
- Vérifier le répertoire courant
- Si le dossier start n'existe pas alors il est crée et ouvert.
- Si le dossier start existe, il est ouvert directement.

```
if($url == FALSE){
  echo "Vous n'avez pas accès au dossier";
} else {
  $start_dir = "start";
  $path_start = getcwd() . DIRECTORY_SEPARATOR . $start_dir;
  if(in_array($start_dir, $current_dir)){
    chdir($path_start);
    $dir_start = scandir(getcwd());
    }

  } else {
    mkdir($path_start);
    chdir($path_start);
    $dir_start =scandir(getcwd());
  }
}
```

### Faire en sorte que . et .. n’apparaissent pas && Afficher le fil d'Ariane
- Au l'affichage du dossier start, l'affichage de l'url est modifiée pour ne pas afficher les dossiers parents.

```
foreach ($current_dir as $value) {
  if($value == "start"){
      $breadCrumbs = implode(DIRECTORY_SEPARATOR, array_slice($dir_start,2));
      echo $breadCrumbs;
    }
```
