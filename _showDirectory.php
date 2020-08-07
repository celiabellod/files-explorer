<?php

if(substr($pathCurrent, -9) == "corbeille"){
  foreach ($arrayUrl as $value) {

    if(isset($_SESSION['checked']) && $_SESSION['checked'] == "checked"){
      echo "<div class='directory-folder'>
              <img src='assets/images/directory.png' alt=''>
              <p>$value</p>

              <div class='directory-optionFolder'>
                <div class='directory-optionInnerFolder'>
                  <span class='seeMoreOption'>+</span>
                  <form method='POST' action='logic.php'>
                    <button type='submit' name='restaure' value='$value'>Restaurer</button>
                  </form>
                  <form method='POST' action='logic.php'>
                    <button type='submit' name='delete' value='$value'>Supprimer</button>
                  </form>
                <div>
              <div>

            <div>";

    } else if (isset($_SESSION['checked']) && $_SESSION['checked'] == "unchecked" || !isset($_SESSION['checked']) ){

       if ($value == strstr($value, '.')) {
         echo "";

       } else {

         if(substr($value, -4) == ".txt"){
              echo "<div class='directory-folder'>
                      <img src='assets/images/directory.png' alt=''>
                      <p>$value</p>

                      <div class='directory-optionFolder'>
                        <div class='directory-optionInnerFolder'>
                          <span class='seeMoreOption'>+</span>
                          <form method='POST' action='logic.php'>
                            <button type='submit' name='restaure' value='$value'>Restaurer</button>
                          </form>
                          <form method='POST' action='logic.php'>
                            <button type='submit' name='delete' value='$value'>Supprimer</button>
                          </form>
                        <div>
                      <div>

                    <div>";

          } else {
              echo "<div class='directory-folder'>
                      <img src='assets/images/directory.png' alt=''>
                      <p>$value</p>

                      <div class='directory-optionFolder'>
                        <div class='directory-optionInnerFolder'>
                          <span class='seeMoreOption'>+</span>
                          <form method='POST' action='logic.php'>
                            <button type='submit' name='restaure' value='$value' >Restaurer</button>
                          </form>
                          <form method='POST' action='logic.php'>
                            <button type='submit' name='delete' value='$value'>Supprimer</button>
                          </form>
                        <div>
                      <div>

                    <div>";

          }
      }
    }
  }
} else {
    foreach ($arrayUrl as $value) {

      if($value == "corbeille"){
        echo"";

      } else if(isset($_SESSION['checked']) && $_SESSION['checked'] == "checked"){
        echo "<div class='directory-folder'>
                <form method='POST' action='logic.php'>
                  <button type='submit' name='directory' value='$value' form='navigation' class='button-folder'>
                    <img src='assets/images/directory.png' alt=''>
                  </button>
                </form>
                <p>$value</p>
                <form method='POST' action='logic.php'>
                  <input type='text' name='rename[]'>
                  <input type='hidden' name='rename[]' value='$value'>
                  <input type='submit' name='rename[]' value='Renommer'>
                </form>

                <div class='directory-optionFolder'>
                  <div class='directory-optionInnerFolder'>
                    <span class='seeMoreOption'>+</span>
                    <form method='POST' action='logic.php'>
                      <button type='submit' name='copy' value='$value'>Copier</button>
                    </form>
                    <form method='POST' action='logic.php'>
                      <button type='submit' name='delete' value='$value'>Supprimer</button>
                    </form>
                  </div>
                </div>

              </div>";

      } else if (isset($_SESSION['checked']) && $_SESSION['checked'] == "unchecked" || !isset($_SESSION['checked']) ){

         if ($value == strstr($value, '.')) {
           echo "";

         } else {

           if(substr($value, -4) == ".txt"){
               echo "<div class='directory-folder'>
                      <a href='?open=$value'><img src='assets/images/directory.png' alt=''></a>
                      <p>$value</p>
                      <form method='POST' action='logic.php'>
                        <input type='text' name='rename[]'>
                        <input type='hidden' name='rename[]' value='$value'>
                        <input type='submit' name='rename[]' value='Renommer'>
                      </form>

                      <div class='directory-optionFolder'>
                        <div class='directory-optionInnerFolder'>
                          <span class='seeMoreOption'>+</span>
                          <form method='POST' action='logic.php'>
                            <button type='submit' name='copy' value='$value'>Copier</button>
                          </form>
                          <form method='POST' action='logic.php'>
                            <button type='submit' name='delete' value='$value'>Supprimer</button>
                          </form>
                        </div>
                      </div>

                    </div>";
            } else {
                echo "<div class='directory-folder'>
                        <form method='POST' action='logic.php'>
                          <button type='submit' name='directory' value='$value' form='navigation' class='button-folder'>
                            <img src='assets/images/directory.png' alt=''>
                          </button>
                        </form>
                        <p>$value</p>
                        <form method='POST' id='rename' action='logic.php'>
                          <input type='text' name='rename[]'>
                          <input type='hidden' name='rename[]' value='$value'>
                        </form>

                        <div class='directory-optionFolder'>
                          <div class='directory-optionInnerFolder'>
                            <span class='seeMoreOption'>+</span>
                            <input type='submit' name='rename[]' form='rename' value='Renommer'>
                            <form method='POST' action='logic.php'>
                              <button type='submit' name='copy' value='$value'>Copier</button>
                            </form>
                            <form method='POST' action='logic.php'>
                              <button type='submit' name='delete' value='$value'>Supprimer</button>
                            </form>
                          </div>
                        </div>

                      </div>";
            }
        }
      }
    }
}
