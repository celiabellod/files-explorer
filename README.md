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


    - Si au rechargement de la page la valeur envoyée du formulaire est égal à un changement de dossier
    Alors verifi si le dossier demandé ce trouve déjà dans l'url :
      - Si le dossier est dans l'url alors on cherche sa position puis on enleve tous ce qui se trouve après et on crée une nouvelle url et le dossier demandé est ouvert
      - Si le dossier n'est pas dans l'url alors on ajoute le dossier a l'url et on ouvre le dossier demandé

    - Si la valeur du formulaire est égal à la valeur de la case à cocher alors on reste dans le dossier déjà présent

    - Si le rechargement de la page n'est pas lié à une valeur envoyée du formulaire
    Alors le chemin est crée depuis l'url de départ et le dossier start est ajouté au chemin puis le dossier est ouvert.


  - Si le dossier de départ ne se trouve pas dans l'architecture de l'explorateur alors le dossier est crée à partir de l'url de base, le dossier de début est ajouté au chemin.  Puis on se rend dans le dossier.


```
//Le répertoire de départ
if($url == FALSE){ // if url return false
  echo "Vous n'avez pas accès au dossier";
} else { // if url return true

    if(in_array($nameStartDirectory, $arrayUrlBase)){ // if first directory exists in projet architect

      if(isset($_POST['directory'])){ // if no directory select
        $directory = $_POST["directory"];
        //go to back
        $pathArray = explode(DIRECTORY_SEPARATOR, $pathCurrent);
        if(in_array($directory, $pathArray)){
          $positionDirectory = array_search($directory,$pathArray);
          $arrayPathToDirectory = array_slice($pathArray, 0, $positionDirectory + 1);
          $pathCurrent = implode(DIRECTORY_SEPARATOR, $arrayPathToDirectory);
        } else {
          $pathCurrent = $pathCurrent . DIRECTORY_SEPARATOR . $directory;
        }
        chdir($pathCurrent);
      } elseif(isset($_POST['showHideFile'])) {
          chdir($pathCurrent);
      }
      else {
        $pathCurrent = getcwd() . DIRECTORY_SEPARATOR . $nameStartDirectory; //path of the first directory
        chdir($pathCurrent); //go the the first directory
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


  On crée une session, l'une pour garder en mémoire l'url courante.

  ```
  $_SESSION['currentPath'] = $pathCurrent;

  ```


### Pour la checkbox des éléments cachés :

  Deux inputs sont affichés, l'un est un type "checkbox" avec la valeur "showFile" l'autre est un type "hidden" avec la valeur "hideFile". Si la case est cochée alors la valeur "showfile" est envoyée, à contrario si la case n'est pas cochée alors c'est la valeur "HideFile" qui est envoyée.

  On verifie si la variable globale  ```$_POST``` existe:
    -Si elle existe on verifie si il y a une deuxieme entrée à cette variable globale:
      -Si la deuxieme entrée existe, on vérifie qu'elle soit bien égal a la valeur "showFile":
       -Si c'est bien le cas alors on crée une session pour mettre la variable globale et on coche l'input de la checkbox par defaut.

    -Si la variable globale n'existe pas :
      - Si la variable globale  ```$_SESSION['checked']```:
        On affecte la valeur de la session à la variable ```$_POST``` pour l'utilisé à la prochaine recharchement de page.

```

<input type="hidden" id="toggle--daynight2" class="toggle--checkbox" name="showHideFile[]" value="hideFile">

<input type="checkbox" id="toggle--daynight" class="toggle--checkbox" name="showHideFile[]" value="showFile"
      <?php

      if (isset($_POST['showHideFile'])) {
        if(isset($_POST['showHideFile'][1])){
          if($_POST['showHideFile'][1] == "showFile"){
              $_SESSION['checked'] = $_POST['showHideFile'];
              ?> checked <?php
          }
        }
      } else {
          if(isset($_SESSION['checked'])){
            $_POST['showHideFile'] = $_SESSION['checked'];
              if($_POST['showHideFile'][1] == "showFile"){
                  $_SESSION['checked'] = $_POST['showHideFile'];
                  ?> checked <?php
            }
          }
        }
    ?>

>

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
  Une fonction est crée qui parcours l'architecture des dossiers et sous dossiers à partir du dossier de départ.

  ```
  function mkmap($dir){
      $folder = opendir ($dir);

      while ($file = readdir ($folder)) {
          if ($file != "." && $file != "..") {
              $pathfile = $dir.DIRECTORY_SEPARATOR.$file;
              echo "<li><button type='submit' name='directory' value='$file'><img src='assets/images/directory_mini.png' class='img_directoryMini'>$file</button></li>";
              if(filetype($pathfile) == 'dir'){
                  mkmap($pathfile);
              }
          }
      }
      closedir ($folder);
  }

  ```

  - Si le rechargement de la page n'est pas lié à une demande de navigation dans un dossier ni même à une fonction sur un dossier alors le dossier passé à la fonction sera "../start"
  afin de remonter au dossier parent vu qu'au départ on se trouve dans le dossier start.

  - Si le rechargement de la page est lié à une demande de navigation dans un dossier :
    - Si le dossier se trouve déjà dans l'url :
        - Si l'url pour remonter dans le dossier start existe déjà :
          Alors on prends la dernière url pour remonter dans le dossier "start" enregistré.
        -Sinon :
          On prends par défaut "../"

      On compte le nombre d'entrée dans le tableau où se trouve l'url avant la demande de l'utilisateur puis on la soustrait aux nombres d'entrées dans le tableau d'url après la demande de l'utilisateur.

      On enleve autant de "../" que de dossier remontés demandés.

      Puis on lance la fonction de recherche d'architecture.

    - Si le dossier ne se trouve pas dans l'url :
      - Si l'url pour remonter dans le dossier start existe  déjà :
        Alors on prends la dernière url pour remonter dans le dossier start enregistré.
      -Sinon :
        On prends par défaut "../"

      On ajoute autant de "../" que de dossier demandés.

      Puis on lance la fonction de recherche d'architecture.

  Sinon :
    On prends la dernière url pour remonter dans le dossier start enregistré puis on lance la fonction

  ```
  if(!isset($_POST['directory']) && !isset($_POST['showHideFile'])){
      $point = '..' . DIRECTORY_SEPARATOR;
      mkmap($point . $nameStartDirectory);
  } else if(isset($_POST['directory'])) {
    if(in_array($directory, $pathArray)){
      if(isset($_SESSION['point'])){
        $point = $_SESSION['point'];
      } else {
        $point = '..' . DIRECTORY_SEPARATOR;
      }

      $arrayBeforeReturn = count($pathArray);
      $arrayAfterReturn = count($arrayPathToDirectory);
      $newPosition  = $arrayBeforeReturn - $arrayAfterReturn;
      for($i = 0; $i < $newPosition; $i++){
        $point = substr($point,0,-3);
      }
      $_SESSION['point'] = $point;
      mkmap($point . $nameStartDirectory);
    } else {
      if(isset($_SESSION['point'])){
        $point = $_SESSION['point'];
      } else {
        $point = '..' . DIRECTORY_SEPARATOR;
      }
      for($i = 0; $i < 1; $i++){
        $point = $point . '..' . DIRECTORY_SEPARATOR;
      }
      mkmap($point . $nameStartDirectory);
    }
  } else {
    $point = $_SESSION['point'];
    mkmap($point .  $nameStartDirectory);
  }
  $_SESSION['point'] = $point;

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
