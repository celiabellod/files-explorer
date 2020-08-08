<?php

class Functionality {

  public function create($pathCurrent, $fileName){
    if(stristr($fileName, '.')){
      fopen($pathCurrent .DIRECTORY_SEPARATOR. $_POST['create'], 'c+b');
    } else {
      mkdir($pathCurrent .DIRECTORY_SEPARATOR. $_POST['create'], 0700);
    }
  }

  public function renameElement($pathCurrent , $name){
    $f = $name[1];
    $d = $name[0];
    rename($pathCurrent.DIRECTORY_SEPARATOR.$f , $pathCurrent.DIRECTORY_SEPARATOR.$d);
  }

  public function rmElement($element) {
    if (is_dir($element)) {
      $files = scandir($element);
      foreach ($files as $file){
        if ($file != "." && $file != ".."){
          $this->rmElement("$element/$file");
        }
      }
      rmdir($element);
    } elseif (is_file($element)) {
      unlink($element);
    }
  }

  // copies files and non-empty directories
  public function cutAndPast($src, $dst) {
    if (is_dir($src)) {
      mkdir($dst);
      $files = scandir($src);
      foreach ($files as $file){
        if ($file != "." && $file != "..") $this->cutAndPast("$src/$file", "$dst/$file");
      }
      $this->rmElement($src);
    }elseif (is_file($dst)) {
      touch($dst);
      $this->rmElement($src);
    }
  }

  public function copyDir($dirSrc,$dirDest){
      if (is_dir($dirSrc)) {
        if ($dh = opendir($dirSrc)) {
          while (($file = readdir($dh)) !== false) {

          if (!is_dir($dirDest)) {
            mkdir($dirDest, 0777);
          }
          if(is_dir($dirSrc.DIRECTORY_SEPARATOR.$file) && $file != '..' && $file != '.') {

            copyDir ($dirSrc .DIRECTORY_SEPARATOR. $file , $dirDest .DIRECTORY_SEPARATOR. $file );

          } elseif($file != '..' && $file != '.') {
               copy($dirSrc .DIRECTORY_SEPARATOR. $file , $dirDest .DIRECTORY_SEPARATOR. $file );
            }
          }

          closedir($dh);
      }
    }
  }



  /*
  foreach ($startArray as $value) {
    $file = $value;
    $hideFile = hide($file);
    $keyHideFile = array_keys($hideFile);
    $fileHideShow = show($hideFile);
  }
    function hide($file) {
      $fileArray = explode(" ", $file);
       foreach ($fileArray as $key => $value) {
         $key = ' ';
          $fileArray = [
            $key => $value
          ];
          return $fileArray;
      }
    }
    function show($hideFile) {
      foreach ($hideFile as $value) {
        echo $value;
      }
    }
  */
}
