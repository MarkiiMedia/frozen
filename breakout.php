<?php require_once('config/config.php'); ?>
<?php require_once('config/db.php'); ?>
  
<?php include('inc/header.php'); ?>
  
  <?php 
   session_start();
   if(isset($_SESSION['adgang'])){
    //Blot brugt til testing af rettighedsstyring 
    //echo "Du er logget ind, så må derfor gerne se indholdeet nedenfor";
       
   }else {
    //echo "<h1>IKKE LOGGET IND</h1>";
       header("location:index.php");
   }
  ?>

<!-- Inline styles herunder -->
<style>
    	* { 
        padding: 0; margin: 0; 
        }

    	canvas {
        background: #eee;
        display: block;
        margin: 0 auto; 
        margin-top: 20px;
      }
    </style>

<div class="gametitle">
    <img src="img/frozen_logo.png" width="140" class="img-fluid logo_frontpage" alt="Disney Frozen logo">
    <h1>Breakout</h1>
    <p>Hjælp Olaf med at fjerne muren ved hjælp af din isbold!</p>
</div>

<!-- GAME CANVAS -->
<canvas id="myCanvas" width="480" height="320"></canvas>

<!-- SCRIPT TIL DETTE SPIL -->
<script src="breakout_game.js"></script>
        
    <?php include('inc/footer.php'); ?>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>
