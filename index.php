<?php include 'header.php';


$url = getcwd();
$arrayUrl = scandir($url);
$firstDirectory = "start";
$deleteDirectory = "corbeille";

if(!isset($_SESSION['currentPath'])) {
  if($url == FALSE){
    echo "Vous n'avez pas accès à l'explorateur";
  } else {
      if(in_array($firstDirectory, $arrayUrl)){
        $pathCurrent = getcwd() . DIRECTORY_SEPARATOR . $firstDirectory;
        $_SESSION['startPath'] = $pathCurrent;
      } else {
        $pathCurrent = getcwd() . DIRECTORY_SEPARATOR . $firstDirectory;
        mkdir($pathCurrent, 0700);
        mkdir($pathCurrent .DIRECTORY_SEPARATOR. $deleteDirectory, 0700);
      }
  }
}else if(isset($_SESSION['redirection'])){
  $pathCurrent = $_SESSION['currentPath'];
} else {
  $pathCurrent = getcwd() . DIRECTORY_SEPARATOR . $firstDirectory;
}

chdir($pathCurrent);
$arrayUrl= scandir($pathCurrent);
$arrayUrl= array_slice($arrayUrl, 2); // Without  et ..
$_SESSION['currentPath'] = $pathCurrent;

$showNav = new ShowNav();
?>


  <div class="container">

    <h1>Explorateur de fichier</h1>

    <form method="POST" action="logic.php" id="function">
      <div class="globalFunctionality">
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

          <label for="createFile">Nouveau</label>
          <input type="text" name="create" id="createFile" pattern="[A-Za-z.]{3,15}">

          <button type="submit" class="function-applicate" form="function">Appliquer</button>

          <button type="submit" name="past" form="function">Coller</button>
      </div>
    </form>



  <form method="POST" action="logic.php" id="form1">

    <?php
        $path = scandir($_SESSION['startPath']);
        foreach ($path as $value) {
          if($value == "corbeille"){
            echo $showNav->getTrash($value);
          }
        }
    ?>

    <div class="breadCrumbs">
     <ul>
      <button type='submit' name='directory' value='start' form="form1" class="button-folder">
        <img src="assets/images/folder-mini.png"  width='20px'>
      </button>
       <?php $showNav->breadCrumbs($pathCurrent, $firstDirectory) ?>
     </ul>
    </div>

    <div class="container-directory">
      <?php

        foreach ($arrayUrl as $value) {
          if(isset($_SESSION['checked']) && $_SESSION['checked'] == "unchecked" || !isset($_SESSION['checked'])) {
            if ($value == strstr($value, '.')) {
              $showNav->hideFile($value);
            } else {
              echo $showNav->getElement($value, $pathCurrent);
            }
          } else {
            echo $showNav->getElement($value, $pathCurrent);
          }
        }
      ?>
    </div>

    <div class="container-Aside">
      <div class="nav-aside">
        <!--<?php

          $dir = '';

          if(isset($_SESSION['navAsidePoint'])){
            $navAsidePoint  = $_SESSION['navAsidePoint'];
          } else {
            $navAsidePoint  = '..' . DIRECTORY_SEPARATOR;
            $_SESSION['navAsidePoint'] = $navAsidePoint;
          }

          $BASE = $navAsidePoint .  $firstDirectory;

          echo "<div class='name-directoryStart'>
                  <img src='assets/images/folder.png' width='40px'/>
                  <span>Accueil</span>
                </div><br/>";

          $showNav->list_dir($BASE, $dir, 1);

        ?>-->
      </div>
    </div>

  </div>
</form>


<div id="myModal" class="modal">
  <!-- Modal content -->
  <div class="modal-content">
    <span class="closet">&times;</span>
    <?php
      if(isset($_GET['open'])){
        $file = $_GET['open'];
        $ressource = fopen( $file, 'rb');
        while(!feof($ressource)){
          echo fgets($ressource);
        }
      }
     ?>
  </div>
</div>



<?php include 'footer.php' ?>
