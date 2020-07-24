<?php include 'header.php';
$url = getcwd(); //string of url to start
$arrayUrlBase = scandir($url); // array of url to start

//Le répertoire de départ
if($url == FALSE){ // if url return false
  echo "Vous n'avez pas accès au dossier";
} else { // if url return true
  $nameStartDirectory = "start"; //name of the first directory
  $pathStart = getcwd() . DIRECTORY_SEPARATOR . $nameStartDirectory; //path of the first directory

  if(in_array($nameStartDirectory, $arrayUrlBase)){ // if first directory exists in projet architect
    chdir($pathStart); //go the the first directory
  } else { // if first directory doesn't exists in projet architect
    mkdir($pathStart); // create first directory
    chdir($pathStart); //go the the first directory
  }
  $arrayUrlStart = scandir(getcwd()); // put all the under directory inside array
  $newUrlWithoutParent = implode(DIRECTORY_SEPARATOR, array_slice($arrayUrlStart, 2)); // string url without . et ..
  $arrayUrlWithoutParent = explode(DIRECTORY_SEPARATOR, $newUrlWithoutParent);  // array url without . et ..
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


      <p>Couper</p>
      <p>Copier</p>
      <p>Coller</p>
      <p>Supprimer</p>

      <div class="toggle toggle--daynight">
          <p>Elements masqués</p>
          <input type="checkbox" id="toggle--daynight" class="toggle--checkbox" name="showHideFile" value="showFile">
          <label class="toggle--btn" for="toggle--daynight"><span class="toggle--feature"></span></label>
      </div>

      <input type="submit" value="appliquer" >

    </form>

    <nav>
      <div class="breadCrumbs">
        <ul>
          <img src="assets/images/directory_mini.png" class="img_directoryMini">

            <?php
              if($arrayUrlWithoutParent[0] != ''){
                foreach ($arrayUrlWithoutParent as $value) {
                  if(isset($_POST['showHideFile'])){
                    echo "<li>$value</li>";
                  } else {
                    if ($value == strstr($value, '.')) {
                      echo "";
                    } else {
                      echo "<li>$value</li>";
                    }
                  }
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
                    echo "<li><img src='assets/images/directory_mini.png' class='img_directoryMini'>$value</li>";
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
          }
        } ?>

      </div>
    </div>
  </div>
<?php include 'footer.php' ?>
