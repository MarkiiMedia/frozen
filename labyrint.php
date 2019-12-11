<?php require_once('config/config.php'); ?>
<?php require_once('config/db.php'); ?>
  
<?php include('inc/header.php'); ?>
  
  <?php 
   session_start();
   if(isset($_SESSION['adgang'])){
    //Blot brugt til testing af rettighedsstyring 
    //echo "Du er logget ind, så må derfor gerne se indholdeet nedenfor";
       
   }else {
      //Blot brugt til testing af rettighedsstyring 
      //echo "<h1>IKKE LOGGET IND</h1>";
       header("location:index.php");
   }
  ?>

    <!-- Anderledes class end de andre gametiles da dette spil fuckede, så det skulle være side om side istedet -->
<div class="markii_special_gametitle">
    <img src="img/frozen_logo.png" width="140" class="img-fluid logo_frontpage" alt="Disney Frozen logo">
    <h1>Labyrinten</h1>
    <p class="markii_timeLeft">Hjælp Elsa ud af labyrinten inden det er for sent!</p>
    <p class="markii_timeLeft">Tid tilbage:</p>
    <div id="countdown"></div>
    <p class="markii_timeLeft">Point:</p>
    <div id="score">0</div>
</div>


<!-- GAME CANVAS -->
    <center>
        <canvas id="canvas_lab" width="460" height="460"></canvas>
    </center>

<!-- SCRIPT TIL DETTE SPIL -->
    <script src="lab_game.js"></script>
        
    <?php include('inc/footer.php'); ?>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>