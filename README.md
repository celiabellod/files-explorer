### Débuter le projet

On récupere l'url de départ, on transforme l'url de départ en tableau.

On choisit le nom de dossier de départ : "start".

```
$url = getcwd(); //string of url to start
$arrayUrlBase = scandir($url); // array of url to start
$nameStartDirectory = "start"; //name of the first directory

```
### Logique principale

- Si l'url de base retourne faux alors un message d'erreur est affiché.
- Si l'url retourne vrai:

  - Si le dossier de départ se trouve déjà dans l'architecture de l'explorateur :

    -Si le rechargement de la page n'est pas lié à une valeur envoyée du formulaire
      - Alors le chemin est crée depuis l'url de départ et le dossier start est ajouté au chemin puis le dossier est ouvert.

    -Si le rechargement de la page est lié à une valeur envoyée du formulaire
      - Si la valeur du formulaire est égal à la valeur de la case à cocher pour voir les élements cachés alors on reste dans le dossier déjà présent (erreur si fichier masquer des le debut)

      -Si la valeur du formulaire est égal à un changement de dossier alors on vérifi si le dossier est déjà present dans le tableau des dossiers, s'il n'y est pas on insère le dossier dans le tableau des dossiers. On prends ensuite le chemin courant puis on l'ajoute avec le dossier demandé. On se rend dans le dossier.

  - Si le dossier de départ ne se trouve pas dans l'architecture de l'explorateur alors le dossier est crée à partir de l'url de base, le dossier de début est ajouté au chemin.  Puis on se rend dans le dossier.

```
//Le répertoire de départ
if($url == FALSE){ // if url return false
  echo "Vous n'avez pas accès au dossier";
} else { // if url return true

    if(in_array($nameStartDirectory, $arrayUrlBase)){ // if first directory exists in projet architect
      if(!isset($_POST['directory']) && !isset($_POST['showHideFile'])){ // if no directory select
        $pathCurrent = getcwd() . DIRECTORY_SEPARATOR . $nameStartDirectory; //path of the first directory
        chdir($pathCurrent); //go the the first directory
      } elseif(isset($_POST['showHideFile'])) {
        chdir($pathCurrent);
      }
      else {
        $directory = $_POST["directory"];
        if(!in_array($directory, $allDirectories)){
          array_push($allDirectories, $directory);
        }
        $pathCurrent = $pathCurrent . DIRECTORY_SEPARATOR . $directory;
        chdir($pathCurrent);
      }
    } else { // if first directory doesn't exists in projet architect
      $pathCurrent = getcwd() . DIRECTORY_SEPARATOR . $nameStartDirectory; //path of the first directory
      mkdir($pathCurrent); // create first directory
      chdir($pathCurrent); //go the the first directory
    }

    // scanner l'interieur d'un dossier courrant
    $arrayUrl= scandir($pathCurrent);

```

### Pour le breadCrumbs :
     On met dans un tableau l'url courante.
     On cherche la position du dossier de départ
     Puis on enlève tous ce qui précède le dossier départ

     ```
     $BreadCrumbsArray = explode(DIRECTORY_SEPARATOR, $pathCurrent);
     $positionStart = array_search('start',$BreadCrumbsArray);
     $BreadCrumbsFromStart = array_slice($BreadCrumbsArray, $positionStart + 1);
     ```

### Pour enlever le . et .. des dossiers courant:
    On enleve les deux premières entrées du tableau des sous dossiers du dossier demandé qui correspondent à . et ..

    ```
      $arrayUrlWithoutParent = array_slice($arrayUrl, 2);

    ```


  On crée deux session, l'une pour garder en mémoire l'url courante.
  Et la deuxième pour garder en mémoire tous les dossiers présents dans l'architecture pour la navigation sur le côté.

  ```
  $_SESSION['currentPath'] = $pathCurrent;
  $_SESSION['allDirectories'] = $allDirectories;

  ```


### Pour la checkbox des éléments cachés :
  Si elle est cochée alors la variable "POST" est envoyée au fichier index.php et si cette variable existe alors la case à cocher est cocher par défaut.

```
<?php if(isset($_POST['showHideFile'])){?> checked <?php }?>

```

### Pour afficher le fil d'ariane :
    On parcours le tableau de l'url courante a partir du dossier start et on affiche toute les valeurs.

    ```
    <?php
    foreach ($BreadCrumbsFromStart as $value) {
      echo "<li>$value</li>";
    }
    ?>
    ```

### Pour la navigation sur le côté :
    Si le dossier contenant toute l'architecture des dossiers n'est pas vide alors on parcours ce tableau afin d'afficher toute les valeurs qui s'y trouve.
    Si l'utilisateur demande à afficher les dossiers cachés alors on affiche tous les dossiers sinon les fichiers sont triés: ceux qui commence par un point devant ne sont pas affichés.

    ```

    if(!empty($allDirectories)){
      foreach ($allDirectories as $value) {
        if(isset($_POST['showHideFile'])){
          echo "<li><img src='assets/images/directory_mini.png' class='img_directoryMini'>$value</li>";
        } else {
          if ($value == strstr($value, '.')) {
            echo "";
          } else {
            echo "<li><button type='submit' name='directory' value='$value'><img src='assets/images/directory_mini.png' class='img_directoryMini'>$value</button></li>";
          }
        }
    }
  }

    ```



### Pour la navigation centrale :
    On parcours le tableau contenant l'url courante. Si la premiere entrée est différente de NULL cela veut dire que le dossier contient des sous dossiers.
    On peut alors parcourir le tableau des sous dossiers et en afficher les valeurs correspondantes.
    Si l'utilisateur demande à afficher les dossiers cachés alors on affiche tous les dossiers sinon les fichiers sont triés: ceux qui commence par un point devant ne sont pas affichés.

    ```
    if($arrayUrlWithoutParent[0] != ''){
     foreach ($arrayUrlWithoutParent as $value) {
       if(isset($_POST['showHideFile'])){
         echo "<div class='logo-dir2'>
                 <button type='submit' name='directory' value='$value'><img src='assets/images/directory.png' alt=''></button>
                 <p>$value</p>
               </div>";
       } else {
           if ($value == strstr($value, '.')) {
             echo "";
           } else {
             echo "<div class='logo-dir2'>
                     <button type='submit' name='directory' value='$value'><img src='assets/images/directory.png' alt=''></button>
                     <p>$value</p>
                   </div>";
           }

       }
     }
   }

    ```
