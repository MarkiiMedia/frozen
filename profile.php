<?php require_once('config/config.php'); ?>
<?php require_once('config/db.php'); ?>


  <?php include('inc/header.php'); ?>

<?php 
   session_start();

   $userName = $_SESSION['userName'];
   if(isset($_SESSION['adgang'])){
       $sql = "SELECT * FROM login WHERE user_name = '$userName'";
       $result = mysqli_query($conn, $sql) or die("Query virker ikke");
       $user = mysqli_fetch_assoc($result);
        //Blot brugt til testing af rettighedsstyring 
       //echo "Du er logget ind, så må derfor gerne se indholdet nedenfor";
       
   } else {
       header("location:index.php");
   }
  ?>

<!-- -------- RESET SCORE -------- -->
  <?php
//Check for tryk på reset knap 
/* 
Lavet således:
vi resetter score ved at trykke på knappen. knappen har så den value som det hedder i DB, altså score_xxx
På den måde kan vi bruge denne samme metode til alle resets, istedet for at lave 4 forskellige
*/
if(isset($_POST['step']) && $_POST['step'] == 'resetscore') {

    $gameID=$_POST['gameID'];

    //SMIDER value fra input value ved knapperne ind efter score_
    $scoretable='score_' . $gameID; // Navn på score felt

  //SQL statement om at opdatere scoretest til 0 med username fra session
  //DETTE ER GJORT
	$queryrestescore = "UPDATE login SET $scoretable='0' WHERE user_name='$userName'";
  //Blot til testing
  //echo $queryrestescore;exit;
  //Hvis success
	if(mysqli_query($conn, $queryrestescore)){
    //echo 'score er nu reset';
    echo '<script language="javascript">';
    echo 'alert("Din score er nu reset")';
    echo '</script>';
  //Hvis fejl
	} else {
		echo 'ERROR: '.mysqli_error($conn); 
	}
}
  ?>

<!-- -------- GEM SPIL SCORE I DB -------- -->
  <?php
  //Gemme score i DB fra spil herunder
  //HVIS trykket på step og step = setscore
  if(isset($_GET['step']) && $_GET['step'] == 'setscore') {

    //GameID samt score fra spil siden gettes herunder
    $gameID=$_GET['gameID'];
    $score=$_GET['score'];

    //Her fortæller vi at scoretable = score_xxx - Fordi vi i DB har kaldt alle score_xxx og gameID får vi fra spil siden
    $scoretable='score_' . $gameID;
    //Update hvor username = username (session) og scoren der allerede findes i DB er MINDRE end denne nye score
    $querysetscore = "UPDATE login SET $scoretable='$score' WHERE user_name='$userName' AND $scoretable < '$score'";
    //Denne echo nedenunder er blot brugt for at tjekke, løbende i processen
    //echo $querysetscore;exit;
    //Hvis success
    if(mysqli_query($conn, $querysetscore)){
      //Blot til testing
      //echo 'score er nu sat';
    //Hvis fejl
    } else {
      echo 'ERROR: '.mysqli_error($conn); 
    }
  }

  ?>


<!-- -------- SLET BRUGER -------- -->
  <?php
  //Check for slet bruger tjek
if(isset($_POST['slet'])){

  //Slet fra login hvor username = username fra session
	$query = "DELETE FROM login WHERE user_name='$userName'";
  
  //Hvis det lykkedes, så destroy session og ryk til index
	if(mysqli_query($conn, $query)){
    session_destroy();
    header("location:index.php");
    
	} else {
		echo 'ERROR: '.mysqli_error($conn); 
	}
}

  ?>


<!-- -------- VIS BRUGER - SELECT ALT -------- -->
  <?php
//Create query - specifikt på den user der er logget ind, altså username fra session (da username er unikt)
$query = "SELECT * FROM login WHERE user_name = '$userName'";

//Få resultater
$result = mysqli_query($conn, $query);

//Fetch Data
$scores = mysqli_fetch_all($result, MYSQLI_ASSOC);


//Free result
mysqli_free_result($result);

//Close connection
mysqli_close($conn);
  ?>

  

  <!-- For each for at skrive scoren, som jeg først udskriver længere nede. Mærkelig løsning jeg kom frem til -->
			<?php foreach($scores as $score) : ?>			
			<?php endforeach; ?>

      <div class="jumbotron markii_jumbotron_color_spacing">
       <h1 class="display-4">Brugerprofil: <?php echo $userName; ?></h1>
       <p class="lead">Her kan du se din highscore i de forskellige spil samt resette hvis du ønsker at udfordre dig selv på ny!</p>
       <hr class="my-4">
       <p>Frozen 2 er nu tilgængelig!</p>

      <!-- Knapper -->
      <div class="row">
<div class="col text-center">

<!-- Modal (slet bruger) -->
<a class="btn btn-primary btn-lg float-left" href="https://frozen.disney.com/" target="_blank" role="button">Se mere her</a>
    <button type="button" class="btn btn-danger btn-lg float-right" data-toggle="modal" data-target="#confirmDeleteModal">
  Slet bruger
</button>

<!-- Modal up -->
<div class="modal fade" id="confirmDeleteModal" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="confirmDeleteModalLabel">Slet bruger</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Er du sikker på du vil slette din bruger? Hvis du trykker "Slet" kan dette valg IKKE fortrydes
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Anuller</button>
        <form class="" method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
			  <input type="submit" name="slet" value="Slet" class="btn btn-danger">
		</form>
      </div>
    </div>
  </div>
</div>
</div>
</div>
 </div>

<!-- Spil -->
<div class="row">
       <div class="col-sm-6">
         <div class="card text-center markii_background_color markii_mellemrum_forside">
         <img src="img/test_spil_logo_labyrint.png" class="card-img-top" alt="...">
           <div class="card-body">
             <h5 class="card-title">Labyrint</h5>
             <p class="card-text">Highscore: <?php echo $score['score_labyrint']; ?></p>
             <a href="labyrint.php" class="btn btn-primary float-left">SPIL NU</a>
             <form class="float-right" method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
        <input type="hidden" name="step" value="resetscore"/>
        <input type="hidden" name="gameID" value="labyrint"/>
			  <input type="submit" name="Reset" value="Reset score" class="btn btn-danger">
		</form>
           </div>
         </div>
       </div>
       <div class="col-sm-6">
         <div class="card text-center markii_background_color markii_mellemrum_forside">
         <img src="img/test_spil_logo_breakout.png" class="card-img-top" alt="...">
           <div class="card-body">
             <h5 class="card-title">Breakout</h5>
             <p class="card-text">Highscore: <?php echo $score['score_breakout']; ?></p>
             <a href="breakout.php" class="btn btn-primary float-left">SPIL NU</a>
             <form class="float-right" method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
        <input type="hidden" name="step" value="resetscore"/>
        <input type="hidden" name="gameID" value="breakout"/>
			  <input type="submit" name="Reset" value="Reset score" class="btn btn-danger">
		</form>
           </div>
         </div>
       </div>
       <div class="col-sm-6">
         <div class="card text-center markii_background_color markii_mellemrum_forside">
         <img src="img/test_spil_logo_arcade.png" class="card-img-top" alt="...">
           <div class="card-body">
             <h5 class="card-title">Arcade</h5>
             <p class="card-text">Highscore: <?php echo $score['score_arcade']; ?></p>
             <a href="#" class="btn btn-primary float-left disabled">KOMMER SNART</a>
             <form class="float-right" method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
        <input type="hidden" name="step" value="resetscore"/>
        <input type="hidden" name="gameID" value="arcade"/>
			  <input type="submit" name="Reset" value="Reset score" class="btn btn-danger disabled">
		</form>
           </div>
         </div>
       </div>
       <div class="col-sm-6">
         <div class="card text-center markii_background_color markii_mellemrum_forside">
         <img src="img/test_spil_logo_snake.png" class="card-img-top" alt="...">
           <div class="card-body">
             <h5 class="card-title">Snake</h5>
             <p class="card-text">Highscore: <?php echo $score['score_snake']; ?></p>
             <a href="snake.php" class="btn btn-primary float-left disabled">KOMMER SNART</a>
             <form class="float-right" method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
        <input type="hidden" name="step" value="resetscore"/>
        <input type="hidden" name="gameID" value="snake"/>
			  <input type="submit" name="Reset" value="Reset score" class="btn btn-danger disabled">
		</form>
           </div>
         </div>
       </div>
     </div>

    <?php include('inc/footer.php'); ?>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>