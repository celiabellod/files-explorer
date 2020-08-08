<?php

class ShowNav {

  public $imgFile = "<img src='assets/images/file.png' alt='Image fichier'>";
  public $imgFolder = "<img src='assets/images/folder.png' alt='Image dossier'>";
  public $imgTrashFolder = "<img src='assets/images/trash.png' alt='Icone poubelle'>";


  /**
  * @param $pathCurrent string
  * @param $firstDirectory string
  * @return string type HTML
  */
  public function breadCrumbs($pathCurrent,$firstDirectory) {
    $breadCrumbs = explode(DIRECTORY_SEPARATOR, $pathCurrent);
    $position = array_search($firstDirectory,$breadCrumbs);
    $breadCrumbs = array_slice($breadCrumbs, $position + 1);
    if(empty($breadCrumbs)){
      echo "<li></li>";
    } else {
      foreach ($breadCrumbs as $value) {
        $button = $this->getButton('directory', $value, $value, 'button-folder button-folder-red');
        echo "<li>$button</li>";
      }
    }
  }


  public function list_dir($base, $cur, $level=0) {

    if ($dir = opendir($base)) {
      $tab = [];
      while($entry = readdir($dir)) {
        if(is_dir($base.DIRECTORY_SEPARATOR.$entry) && !in_array($entry, array('.','..'))) {
          $tab[] = $entry;
        }
      }

      foreach($tab as $elem) {
        $entry = $elem;
        $file = $base.DIRECTORY_SEPARATOR.$entry;

        /*if($file == $cur) {
          $button =  $this->getButton('directory', $file, $entry, $class='button-folder current');
        } else {
          $button = $this->getButton('directory', $file, $entry, $class='button-folder current');
        }*/

        if($entry == "corbeille"){
          echo "";
        } else {
          echo"<li><img src='assets/images/folder-mini.png' width='20px'/>$entry<li>";
        }

        if(preg_match("#".$file.'/#',$cur.DIRECTORY_SEPARATOR)) {
          list_dir($file, $cur, $level+1);
        }
      }
      closedir($dir);
    }
  }


  /**
  * @param $name string
  * @param $value string
  * @return string type HTML
  */
  public function getElement($value, $pathCurrent){
    if(substr($pathCurrent, -9) == "corbeille"){
      $img = $this->getImg($value);
      $buttonRestaure = $this->getButton('restaure', $value, 'Restaurer');
      $buttonDelete = $this->getButton('delete', $value, 'Supprimer');
      return "<div class='directory-folder'>
                $img
                <p>$value</p>
                <div class='directory-optionFolder directory-optionFolder--trash'>
                  <div class='directory-optionInnerFolder'>
                    <span class='seeMoreOption'>+</span>
                    $buttonRestaure
                    $buttonDelete
                  </div>
                </div>
              </div>";
    } else if($value == "corbeille"){
      return "";
    }
    $element = $this->getFileOrDirectory($value);
    $buttonCopy = $this->getButton('copy', $value, 'Copier');
    $buttonDelete = $this->getButton('delete', $value, 'Supprimer');
    return "<div class='directory-folder'>
              $element
              <p>$value</p>
              <form method='POST' action='logic.php' id='rename'>
                <input type='text' name='rename[]' form='rename'>
                <input type='hidden' name='rename[]' value='$value' form='rename'>

                <div class='directory-optionFolder'>
                  <div class='directory-optionInnerFolder'>
                    <span class='seeMoreOption'>+</span>
                    <input type='submit' name='rename[]' value='Renommer' form='rename'>
                    $buttonCopy
                    $buttonDelete
                  </div>
                </div>

              </form>

          </div>";
  }

  /**
  * @param $value string
  * @return void
  */
  public function hideFile($value){
    if ($value == strstr($value, '.')) {
      return "";
    }
  }

  /**
  * @param $value string
  * @return string type html
  */
  public function getTrash($value){
    if($value == "corbeille"){
      $element = $this->getFileOrDirectory($value);
      return "<div class='directory-trash'>
                $element
                <p>$value</p>
              </div>";
      }
  }


  /**
  * @param $value string
  * @return string
  */
  private function getImg($value){
    if(substr($value, -4) == ".txt"){
      return $this->imgFile;
    } else if($value == "corbeille"){
      return $this->imgTrashFolder;
    } else {
      return $this->imgFolder;
    }
  }


  /**
  * @param $name string
  * @param $value string
  * @param $buttonName string
  * @param $class string / default null
  * @return string type HTML
  */
  private function getButton($name, $value, $buttonName, $class=''){
    return "<button type='submit' name='$name' value='$value' form='form1' class='$class'>$buttonName</button>";
  }


  /**
  * @param $value string
  * @return string type HTML
  */
  private function getFileOrDirectory($value){
    if(substr($value, -4) == ".txt"){
      $img = $this->getImg($value);
      return "<a href='?open=$value'>$img</a>";
    } else {
      $img = $this->getImg($value);
      return "<button type='submit' name='directory' value='$value' id='form1' class='button-folder'>$img</button>";
    }

  }


}
