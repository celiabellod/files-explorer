<?php include 'header.php';
function mkmap($dir){
    $folder = opendir ($dir);

    while ($file = readdir ($folder)) {
        if ($file != "." && $file != "..") {
            $pathfile = $dir.DIRECTORY_SEPARATOR.$file;
            echo "<li><a href=$pathfile>$file</a></li>";
            if(filetype($pathfile) == 'dir'){
                mkmap($pathfile);
            }
        }
    }
    closedir ($folder);
}

//mkmap('start');



$url = getcwd(); //string of url to start
$arrayUrlBase = scandir($url); // array of url to start
$nameStartDirectory = "start"; //name of the first directory


if(isset($_SESSION['allDirectories'])) {
  $allDirectories = $_SESSION['allDirectories'];
} else {
  $allDirectories = [];
}

if(isset($_SESSION['currentPath'])) {
  $pathCurrent = $_SESSION['currentPath'];
}

//Le répertoire de départ
if($url == FALSE){ // if url return false
  echo "Vous n'avez pas accès au dossier";
} else { // if url return true

    if(in_array($nameStartDirectory, $arrayUrlBase)){ // if first directory exists in projet architect
      if(!isset($_POST['directory']) && !isset($_POST['showHideFile'])){ // if no directory select
        $pathCurrent = getcwd() . DIRECTORY_SEPARATOR . $nameStartDirectory; //path of the first directory
        chdir($pathCurrent); //go the the first directory
        $dir_iterator = new RecursiveDirectoryIterator($pathCurrent);
        $iterator = new RecursiveIteratorIterator($dir_iterator);
        foreach ($iterator as $file) {
        /*  $iteratorArray = explode(DIRECTORY_SEPARATOR, $file);
          $iterator = array_slice($iteratorArray, 3);
          print_r($iterator);*/
          //  echo $file;
        }
      } elseif(isset($_POST['showHideFile'])) {
        chdir($pathCurrent);
      }
      else {
        $directory = $_POST["directory"];
        if(!in_array($directory, $allDirectories)){
          array_push($allDirectories, $directory);
        }

        //go to back
        $pathArray = explode(DIRECTORY_SEPARATOR, $pathCurrent);
        print_r($pathArray);
        if(in_array($directory, $pathArray)){
          $positionDirectory = array_search($directory,$pathArray);
          $arrayPathToDirectory = array_slice($pathArray, 0, $positionDirectory + 1);
          $pathCurrent = implode(DIRECTORY_SEPARATOR, $arrayPathToDirectory);
        } else {
          $pathCurrent = $pathCurrent . DIRECTORY_SEPARATOR . $directory;
        }
        chdir($pathCurrent);
      }
    } else { // if first directory doesn't exists in projet architect
      $pathCurrent = getcwd() . DIRECTORY_SEPARATOR . $nameStartDirectory; //path of the first directory
      mkdir($pathCurrent); // create first directory
      chdir($pathCurrent); //go the the first directory
    }

    // scanner l'interieur d'un dossier courrant
    $arrayUrl= scandir($pathCurrent);

    // breadCrumbs
    $BreadCrumbsArray = explode(DIRECTORY_SEPARATOR, $pathCurrent);
    $positionStart = array_search('start',$BreadCrumbsArray);
    $BreadCrumbsFromStart = array_slice($BreadCrumbsArray, $positionStart + 1);


    // Without  et ..
    $arrayUrlWithoutParent = array_slice($arrayUrl, 2);
    $_SESSION['currentPath'] = $pathCurrent;
    $_SESSION['allDirectories'] = $allDirectories;


}
?>


  <div class="container-explorer">
    <div class="close">
      <div class="container-close">
        <img src="assets/images/close.png">
      </div>
    </div>
    <form class="function" method="POST" action="index.php">

      <div class="function_firstparts">
        <p>Couper</p>
        <p>Copier</p>
        <p>Coller</p>
        <p>Supprimer</p>
      </div>
      <div class="">
        <div class="toggle toggle--daynight">
            <p>Elements masqués</p>
            <input type="checkbox" id="toggle--daynight" class="toggle--checkbox" name="showHideFile" value="showHideFile" <?php if(isset($_POST['showHideFile'])){?> checked <?php }?>>
            <label class="toggle--btn" for="toggle--daynight"><span class="toggle--feature"></span></label>
        </div>
        <input class="function-applicate" type="submit" value="appliquer">
      </div>



    </form>

    <form class="" action="index.php" method="post">
      <nav>

        <div class="breadCrumbs">
          <ul>
            <img src="assets/images/directory_mini.png" class="img_directoryMini">

              <?php
              if(empty($BreadCrumbsFromStart)){
                echo "<li></li>";
              } else {
                foreach ($BreadCrumbsFromStart as $value) {
                  echo "<li><button type='submit' name='directory' value='$value'>$value</button></li>";
                }
              }
              ?>

          </ul>
        </div>

        <div class="nav-aside">
          <ul>
            <?php

            if(!empty($allDirectories)){
              foreach ($allDirectories as $value) {
                if(isset($_POST['showHideFile'])){
                  echo "<li><button type='submit' name='directory' value='$value'><img src='assets/images/directory_mini.png' class='img_directoryMini'>$value</button></li>";
                } else {
                  if ($value == strstr($value, '.')) {
                    echo "";
                  } else {
                    echo "<li><button type='submit' name='directory' value='$value'><img src='assets/images/directory_mini.png' class='img_directoryMini'>$value</button></li>";
                  }
                }
            }
          }
            ?>
          </ul>
        </div>
      </nav>

      <div class="container-dir">

        <div class="row">
          <?php if(isset($arrayUrlWithoutParent)){
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
          } ?>

        </div>
      </div>
    </div>
  </form>
<?php include 'footer.php' ?>
