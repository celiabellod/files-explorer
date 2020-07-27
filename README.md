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





On récupere l'url de départ, on transforme l'url de départ en tableau.

On choisit le nom de dossier de départ : "start".

Si l'url de base retourne false alors un message d'erreur est affiché.
Si l'url retourne vrai:

  - Si le dossier de départ se trouve déjà dans l'architecture de l'explorateur :

    -Si le rechargement de la page n'est pas lié à une valeur envoyée du formulaire
      - Alors le chemin est crée depuis l'url de départ et le dossier start est ajouté au chemin puis le dossier est ouvert.

    -Si le rechargement de la page est lié à une valeur envoyée du formulaire
      - Si la valeur du formulaire est égal à la valeur de la case à cocher pour voir les élements cachés alors on reste dans le dossier déjà présent (erreur si fichier masquer des le debut)

      -Si la valeur du formulaire est égal à un changement de dossier alors on vérifi si le dossier est déjà present dans le tableau des dossiers, s'il n'y est pas on insère le dossier dans le tableau des dossiers. On prends ensuite le chemin courant puis on l'ajoute avec le dossier demandé. On se rend dans le dossier.

  - Si le dossier de départ ne se toruve pas dans l'architecture de l'explorateur alors le dossier est crée à partir de l'url de base, le dossier de début est ajouté au chemin.  Puis on se rend dans le dossier.



  Pour le breadCrumbs :
     On met dans un tableau l'url courante.
     On cherche la position du dossier de départ
     Puis on enlève tous ce qui précède le dossier depart

  Pour enlever le . et .. des dossiers courant:
    On enleve les deux premières entrées du tableau des sous dossiers du dossier demandé qui correspondent à . et ..


  On crée deux session, l'une pour garder en mémoire l'url courante.
  Et la deuxième pour garder en memoire tous les dossiers présent dans l'architecture pour la navigation sur le côté.


  Pour la checkbox des éléments cachés.
  Si elle est cochée alors la variable post est envoyée au fichier index.php et si cette variable existe alors le case à cocher est cocher par défaut.



  Pour afficher le fil d'ariane :
    On parcours le tableau de l'url courrante a partir du dossier start et on affiche toute les valeurs.

  Pour la navigation sur le côté:
    Si le dossier contenant toute l'architecture des dossiers nest pas vide alors on parcours se tableau afin d'afficher toute les valeurs qui s'y trouve.
    Si le variable afficher les dossiers cachés est coché alors on affiche tous les dossiers mais si la case n'est pas cocher alors kes fichiers sont triée: ceux qui commence par un point devant ne sont pas affiché.



    Pour la navigation centrale :
    On parcours le tableau contenant l'url courrante. Si la premiere entrée est differente de NULL ca veut dire que le dossier contient des sous dossiers.
    On peut alors parcourir le tableau des sous dossier et afficher les valeurs correspondante.
    Si le variable afficher les dossiers cachés est coché alors on affiche tous les dossiers mais si la case n'est pas cocher alors kes fichiers sont triée: ceux qui commence par un point devant ne sont pas affiché.
