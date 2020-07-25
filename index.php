<?php include 'header.php';
$url = getcwd(); //string of url to start
$arrayUrlBase = scandir($url); // array of url to start
$nameStartDirectory = "start"; //name of the first directory


if(isset($_SESSION['allDirectories'])) {
  $allDirectories = $_SESSION['allDirectories'];
} else {
  $allDirectories = [];
}

if(isset($_SESSION['pathCurrent'])) {
  $pathCurrent = $_SESSION['pathCurrent'];
}

//Le répertoire de départ
if($url == FALSE){ // if url return false
  echo "Vous n'avez pas accès au dossier";
} else { // if url return true

    if(in_array($nameStartDirectory, $arrayUrlBase)){ // if first directory exists in projet architect
      if(!isset($_POST["directory"])){ // if no directory select
        $pathCurrent = getcwd() . DIRECTORY_SEPARATOR . $nameStartDirectory; //path of the first directory
        chdir($pathCurrent); //go the the first directory
        $arrayUrl= scandir($pathCurrent); // put all the under directory inside array
      } else {
        $directory = $_POST["directory"];
        if(!in_array($directory, $allDirectories)){
          array_push($allDirectories, $directory);
        }
        $pathCurrent = $pathCurrent . DIRECTORY_SEPARATOR . $directory;
        chdir($pathCurrent);
        $arrayUrl= scandir($pathCurrent); // put all the under directory inside array
      }
    } else { // if first directory doesn't exists in projet architect
      $pathCurrent = getcwd() . DIRECTORY_SEPARATOR . $nameStartDirectory; //path of the first directory
      mkdir($pathCurrent); // create first directory
      chdir($pathCurrent); //go the the first directory
      $arrayUrl = scandir($pathCurrent); // put all the under directory inside array
    }

    $newUrlWithoutParent = implode(DIRECTORY_SEPARATOR, array_slice($arrayUrl, 2)); // string url without . et ..
    $arrayUrlWithoutParent = explode(DIRECTORY_SEPARATOR, $newUrlWithoutParent);     // array url without . et ..

    $_SESSION['pathCurrent'] = $pathCurrent;
    $_SESSION['allDirectories'] = $allDirectories;

}
?>


  <?php
    if (isset($_POST["showHideFile"])){
      echo "<input type='hidden' id='showFile' name='' value=''>";
    }

  ?>

  <div class="container-explorer">
    <div class="close">
      <div class="container-close">
        <img src="assets/images/close.png">
      </div>
    </div>
    <form class="function" method="post" action="index.php">

      <div class="function_firstparts">
        <p>Couper</p>
        <p>Copier</p>
        <p>Coller</p>
        <p>Supprimer</p>
      </div>
      <div class="">
        <div class="toggle toggle--daynight">
            <p>Elements masqués</p>
            <input type="checkbox" id="toggle--daynight" class="toggle--checkbox" name="showHideFile" value="showFile">
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
              if(!empty($allDirectories)){
                foreach ($allDirectories as $key => $value) {
                    if ($value == strstr($value, '.')) {
                      echo "";
                    } else {
                      echo "<li>$value</li>";
                    }
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
            ?>
          </ul>
        </div>
      </nav>

      <div class="container-dir">

        <div class="row">
          <?php if($arrayUrlWithoutParent[0] != ''){
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
