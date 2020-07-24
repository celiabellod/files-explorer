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

### Afficher / masquer les fichiers cachés
Par défaut les fichiers avec un '.' au début de leur nom sont cachés.
- Si la case est cochée (on) alors les fichiers cachés sont affichés dans l'explorateur.
- Si la case n'est pas cochée (off) alors les fichiers cachés ne sont pas affichés dans l'explorateur


```
if(isset($_POST['showHideFile'])){
  echo "<div class='logo-dir2'>
          <img src='assets/images/directory.png' alt=''>
          <p>$value</p>
        </div>";
} else {
    if ($value == strstr($value, '.')) {
      echo "";
    } else {
      echo "<div class='logo-dir2'>
              <img src='assets/images/directory.png' alt=''>
              <p>$value</p>
            </div>";
    }
  }
```
