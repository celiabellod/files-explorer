 <div class="container-navAside2">
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
        echo "<div class='name-directoryStart'>
              <img src='assets/images/directory.png' width='40px'/>
                <span>Accueil</span>
              </div>
              <br />";
      } else {
        echo "<img src='assets/images/directory.png' width='40px'/> <p>Accueil</p> <br/>";
      }

      list_dir($BASE, $dir, 1);

      if(!$dir) {
        $dir = $BASE;
      }

      ?>

    </div>


</div>
