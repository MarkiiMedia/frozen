<?php require_once('config/config.php'); ?>
<?php require_once('config/db.php'); ?>

<?php include('inc/header.php'); ?>
    <?php 
  
    //Tom som udgangspunkt
    $output = "";

    //Hvis trykket på submit så tager vi fra felter username og password og salter og hasher og det er så vores kodeord
    if(isset($_POST['submit'])){
    $userName = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    $salt = "gfnlidrnigfd´4grfd" . $password . "sdfk90e3s¨ds'dfdsf¨fsd";
    $hashed = hash('sha512' , $salt);

    $sql = "SELECT * FROM login WHERE user_name = '$userName' AND pass = '$hashed'";

    $result = mysqli_query($conn, $sql) or die("QUERY VIRKER IKKE" . $sql);
      //Hvis det der bliver skrevet i form findes i DB, start session osv
    if(mysqli_num_rows($result) ==1) {
        session_start();

        $_SESSION['adgang'] = 'adgang';
        $_SESSION['userName'] = $userName;
        header("location:index.php");
        $output = "Du er logget ind";
        
    } else {
        $output = "Forkert login - Prøv igen";
    }
    }


  ?>


<!-- HVIS session er sat så ser vi dette under, ELSE ser vi login screen -->
<?php 
session_start();
    if(isset($_SESSION['adgang'])){
      //Blot brugt til testing af rettighedsstyring 
      //echo '<div><h1>Velkommen, du er allerede logget ind, så du skal se et eller andet sjovt her</h1></div>';
       
       echo '<div class="jumbotron markii_jumbotron_color_spacing">
       <h1 class="display-4">Frozen! spilunivers</h1>
       <p class="lead">Dette smukke specielle Frozen univers indholder både en spil sektion, en syng med sektion samt en karakter sektion for de små der elsker Frozen universet.</p>
       <hr class="my-4">
       <p>Frozen 2 er nu tilgængelig!</p>
       <a class="btn btn-primary btn-lg" href="https://frozen.disney.com/" role="button" target="blank">Læs mere</a>
     </div>';
       
       
       echo '<div class="row">
       <div class="col-sm-6">
         <div class="card text-center markii_background_color markii_mellemrum_forside">
         <img src="img/frozen_wide_labyrint.png" class="card-img-top" alt="...">
           <div class="card-body">
             <h5 class="card-title">Labyrint</h5>
             <p class="card-text">Hjælp Elsa ud af labyrinten inden det er for sent!</p>
             <a href="labyrint.php" class="btn btn-primary">SPIL NU</a>
           </div>
         </div>
       </div>
       <div class="col-sm-6">
         <div class="card text-center markii_background_color markii_mellemrum_forside">
         <img src="img/frozen_wide_breakout.png" class="card-img-top" alt="...">
           <div class="card-body">
             <h5 class="card-title">Breakout</h5>
             <p class="card-text">Hjælp Olaf med at fjerne muren ved hjælp af din isbold!</p>
             <a href="breakout.php" class="btn btn-primary">SPIL NU</a>
           </div>
         </div>
       </div>
       <div class="col-sm-6">
         <div class="card text-center markii_background_color markii_mellemrum_forside">
         <img src="img/frozen_wide_arcade.png" class="card-img-top" alt="...">
           <div class="card-body">
             <h5 class="card-title">Arcade</h5>
             <p class="card-text">KOMMER SNART</p>
             <a href="#" class="btn btn-primary disabled">SPIL NU</a>
           </div>
         </div>
       </div>
       <div class="col-sm-6">
         <div class="card text-center markii_background_color markii_mellemrum_forside">
         <img src="img/frozen_wide_snake.png" class="card-img-top" alt="...">
           <div class="card-body">
             <h5 class="card-title">Snake</h5>
             <p class="card-text">KOMMER SNART</p>
             <a href="snake.php" class="btn btn-primary disabled">SPIL NU</a>
           </div>
         </div>
       </div>
     </div>';

    }
    else{
        echo '
        <div class="text-center">
        <img src="img/frozen_logo.png" class="img-fluid logo_frontpage" alt="Disney Frozen logo">
        </div>
        
        <div class="container markii_frontpage_container text-center"> 
            <form action="index.php" method="POST">
                <div class="form-group col-6 mx-auto">
                    <label for="username">Brugernavn:</label>
                    <input type="text" class="form-control" id="username" name="username">
                </div>
                <div class="form-group col-6 mx-auto">
                    <label for="password">Kodeord:</label>
                    <input type="password" class="form-control" id="password" name="password">
                </div>
                <button name="submit" type="submit" class="btn btn-primary frontpage_button_markii">Log ind</button>
                
                <p>'; echo $output; '</p>
            </form>
        </div>
        ';
        echo '<p class="markii_timeLeft">Ikke bruger endnu?</p><a href="register.php" class="btn btn-primary markii_opret_bruger_knap">Opret dig</a>';
        
    }
 ?>

    <?php include('inc/footer.php'); ?>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>