<?php include 'header.php';
      include '_functions.php';

$url = getcwd();
$arrayUrl = scandir($url);
$firstDirectory = "start";

if(!isset($_SESSION['currentPath'])) {
  if($url == FALSE){
    echo "Vous n'avez pas accès à l'explorateur";
  } else {
      if(in_array($firstDirectory, $arrayUrl)){
        $pathCurrent = getcwd() . DIRECTORY_SEPARATOR . $firstDirectory;
      } else {
        $pathCurrent = getcwd() . DIRECTORY_SEPARATOR . $firstDirectory;
        mkdir($pathCurrent);
      }
  }
}else{
  $pathCurrent = $_SESSION['currentPath'];
}

chdir($pathCurrent);
$arrayUrl= scandir($pathCurrent);
$arrayUrl= array_slice($arrayUrl, 2); // Without  et ..

$_SESSION['currentPath'] = $pathCurrent;
?>

  <div class="container-explorer">
    <div class="close">
      <div class="container-close">
        <img src="assets/images/close.png">
      </div>
    </div>
    <form method="POST" action="logic.php">
      <div class="function">

        <div class="function_firstparts">
          <label for="createFile">Nouveau</label>
          <input type="text" name="create" id="create">

        </div>
        <div class="">
          <div class="toggle toggle--daynight">
              <p>Elements masqués</p>
              <input type="hidden" id="toggle--daynight2" class="toggle--checkbox" name="showHideFile[]" value="hideFile">
              <input type="checkbox" id="toggle--daynight" class="toggle--checkbox" name="showHideFile[]" value="showFile"
                    <?php
                    if(isset($_SESSION['checked']) && $_SESSION['checked'] == "checked"){ ?>
                      checked
                    <?php } ?>>

              <label class="toggle--btn" for="toggle--daynight"><span class="toggle--feature"></span></label>
          </div>
          <input class="function-applicate" type="submit" value="appliquer">
        </div>
      </div>

      <nav>
        <div class="breadCrumbs">
          <ul>
            <button type='submit' name='directory' value='start'><img src="assets/images/directory_mini.png" class="img_directoryMini"></button>
              <?php breadCrumbs($pathCurrent, $firstDirectory) ?>
          </ul>
        </div>

        <div class="nav-aside">
          <?php

          $dir = isset($_POST['dir']) ? $_POST['dir'] : '';

          if(isset($_SESSION['navAsidePoint'])){
            $navAsidePoint  = $_SESSION['navAsidePoint'];
          } else {
            $navAsidePoint  = '..' . DIRECTORY_SEPARATOR;
            $_SESSION['navAsidePoint'] = $navAsidePoint;
          }

          $BASE = $navAsidePoint .  $firstDirectory;
          if(!$dir) {
            echo "<img src='assets/images/directory_mini.png' width='20px'/> / <br />";
          } else {
            echo "<img src='assets/images/directory_mini.png' width='20px'/> / <br/>";
          }

          list_dir($BASE, $dir, 1);

          if(!$dir) {
            $dir = $BASE;
          }

          ?>



          <!--
          <button type='submit' name='directory' value='start'><img src="assets/images/directory_mini.png" class="img_directoryMini"></button>
            <?php/*
              if(isset($_SESSION['navAsidePoint'])){
                $navAsidePoint  = $_SESSION['navAsidePoint'];
              } else{
                $navAsidePoint  = '..' . DIRECTORY_SEPARATOR;
                $_SESSION['navAsidePoint'] = $navAsidePoint;
              }

              architectExplorer($navAsidePoint .  $firstDirectory);*/
            ?>-->
        </div>
      </nav>

      <div class="container-dir">
        <div class="row">
          <?php include '_showDirectory.php';?>
        </div>
      </div>
    </div>
  </form>



<?php include 'footer.php' ?>
