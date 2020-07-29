
  <div id="myModal" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <span class="closet">&times;</span>
    <?php
    if(isset($_GET['open'])){
      $file = $_GET['open'];
      $ressource = fopen( $file, 'rb');
      echo fgets($ressource);
    }
     ?>
  </div>

</div>

  <script >


  var modal = document.getElementById("myModal");

  var openModal = document.getElementsByClassName("openModal")[0];

  var span = document.getElementsByClassName("closet")[0];

 if(window.location.href.search("open=") != -1){
      modal.style.display = "block";
  }



  span.onclick = function() {
    modal.style.display = "none";
  }


  window.onclick = function(event) {
    if (event.target == modal) {
      modal.style.display = "none";
    }
  }
  </script>

  </body>
</html>
