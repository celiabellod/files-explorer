<?php

class Tools {

  public function navAsideGoUp($newPosition, $navAsidePoint){
    for($i = 0; $i < $newPosition; $i++){
      $navAsidePoint = substr($navAsidePoint,0,-3);
    }
    return $navAsidePoint;
  }

  public function navAsideGoDown($navAsidePoint){
    for($i = 0; $i < 1; $i++){
      $navAsidePoint = $navAsidePoint . '..' . DIRECTORY_SEPARATOR;
    }
    return $navAsidePoint;
  }

}
