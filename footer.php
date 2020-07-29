
  <div id="myModal" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <span class="closet">&times;</span>
    <?php
    if(isset($_GET['open'])) {
      $file = $_GET['open'];
      echo $file;
      $ressource = fopen( $file, 'rb');
      echo fread($ressource, filesize( $file));
    }
     ?>
  </div>

</div>

  <script >

  // Get the modal
  var modal = document.getElementById("myModal");

  // Get the button that opens the modal
  var openModal = document.getElementsByClassName("openModal")[0];


  // Get the <span> element that closes the modal
  var span = document.getElementsByClassName("closet")[0];

 if(window.location.href.search("open=") != -1){
      modal.style.display = "block";
  }


  /*
  // When the user clicks the button, open the modal
  openModal.onclick = function() {

  modal.style.display = "block";
}*/

  // When the user clicks on <span> (x), close the modal
  span.onclick = function() {
    modal.style.display = "none";
  }

  // When the user clicks anywhere outside of the modal, close it
  window.onclick = function(event) {
    if (event.target == modal) {
      modal.style.display = "none";
    }
  }
  </script>

  </body>
</html>
