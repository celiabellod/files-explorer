<?php

  foreach ($arrayUrl as $value) {
    if($value == "corbeille"){
      echo"<div class='logo-dir2'>
             <form method='POST' action='logic.php'>
               <button type='submit' name='directory' value='$value'><img src='assets/images/directory.png' alt=''></button>
             </form>
             <p>$value</p>";
    }else if(isset($_SESSION['checked']) && $_SESSION['checked'] == "checked"){
      echo "<div class='logo-dir2'>
              <form method='POST' action='logic.php'>
               <button type='submit' name='directory' value='$value'><img src='assets/images/directory.png' alt=''></button>
              </form>
               <p>$value</p>
               <form method='POST' action='logic.php'>
                 <input type='text' name='rename[]'>
                 <input type='hidden' name='rename[]' value='$value'>
                 <input type='submit' name='rename[]' value='Renommer'>
               </form>
            </div>";
    } else if (isset($_SESSION['checked']) && $_SESSION['checked'] == "unchecked" || !isset($_SESSION['checked']) ){
       if ($value == strstr($value, '.')) {
         echo"";
       } else {
         if(substr($value, -4) == ".txt"){
             echo "<div class='logo-dir2'>
                     <a href='?open=$value'><img src='assets/images/directory.png' alt=''></a>
                     <p>$value</p>";
          } else {
           echo "<div class='logo-dir2'>
                  <form method='POST' action='logic.php'>
                    <button type='submit' name='directory' value='$value'><img src='assets/images/directory.png' alt=''></button>
                  </form>
                  <p>$value</p>";
       }
       echo "<form method='POST' action='logic.php'>
               <input type='text' name='rename[]'>
               <input type='hidden' name='rename[]' value='$value'>
               <input type='submit' name='rename[]' value='Renommer'>
             </form>
             <form method='POST' action='logic.php'>
               <input type='submit' name='copy' value='Copier'>
             </form>
             <form method='POST' action='logic.php'>
               <input type='submit' name='delete' value='Supprimer'>
             </form>
            </div>";
     }

   }
}
