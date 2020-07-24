<?php include 'header.php';
$url = getcwd(); //string of url to start
$arrayUrlBase = scandir($url); // array of url to start

if(isset($_SESSION['urlStart'])) {
  $pathStart = $_SESSION['urlStart'];
  print_r(scandir($pathStart));
  $arrayPathStart = scandir($pathStart);
}
if(isset($_SESSION['urlCurrent'])) {
  $pathCurrent = $_SESSION['urlCurrent'];
  print_r(scandir($pathCurrent));
  $arrayPathCurrent = scandir($pathCurrent);
}
//Le répertoire de départ
if($url == FALSE){ // if url return false
  echo "Vous n'avez pas accès au dossier";
} else { // if url return true
  $nameStartDirectory = "start"; //name of the first directory
  $pathStart = getcwd() . DIRECTORY_SEPARATOR . $nameStartDirectory; //path of the first directory
  if(!isset($_POST["directory"])){
    if(in_array($nameStartDirectory, $arrayUrlBase)){ // if first directory exists in projet architect
      chdir($pathStart); //go the the first directory
    } else { // if first directory doesn't exists in projet architect
      mkdir($pathStart); // create first directory
      chdir($pathStart); //go the the first directory
    }
    $arrayUrlStart = scandir($pathStart); // put all the under directory inside array
    $newUrlWithoutParent = implode(DIRECTORY_SEPARATOR, array_slice($arrayUrlStart, 2)); // string url without . et ..
    $arrayUrlWithoutParent = explode(DIRECTORY_SEPARATOR, $newUrlWithoutParent);
  } else {
    $directory = $_POST["directory"];
    $pathCurrent = $pathStart . DIRECTORY_SEPARATOR . $directory;
    chdir($pathCurrent);
    $arrayUrlStart = scandir($pathCurrent); // put all the under directory inside array
    $newUrlWithoutParent = implode(DIRECTORY_SEPARATOR, array_slice($arrayUrlStart, 2)); // string url without . et ..
    $arrayUrlWithoutParent = explode(DIRECTORY_SEPARATOR, $newUrlWithoutParent);
    $_SESSION['urlCurrent'] = $pathCurrent;
    }

    // array url without . et ..
    $_SESSION['urlStart'] = $pathStart;

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
                  foreach ($arrayPathStart as $value) {
                      if ($value == strstr($value, '.')) {
                        echo "";
                      } else {
                        echo "<li>$value</li>";
                      }
                    }

              ?>

          </ul>
        </div>

        <div class="nav-aside">
          <ul>
            <?php
              if($arrayUrlWithoutParent[0] != ''){
                foreach ($arrayUrlWithoutParent as $value) {
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
