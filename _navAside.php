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
