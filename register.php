<?php require_once('config/config.php'); ?>
<?php require_once('config/db.php'); ?>

<?php include('inc/header.php'); ?>

  <?php

    //Flag sat til falsk som udgangspunkt og isuniqe er true
    $flag = false;
    $isunique = true;

  if(isset($_POST['submit'])){
    
    //mysqli_real_escape_string renser for karakterer som kan bruges til SQL injection
    $userName = mysqli_real_escape_string($conn, $_POST['username']);
    $pass1 = mysqli_real_escape_string($conn, $_POST['password1']);
    $pass2 = mysqli_real_escape_string($conn, $_POST['password2']);
    $message = "Brugernavn optaget";
    //Hvis password er ens, så bliver flag nu true
    if($pass1 == $pass2) {
        $flag = true;
    }
    //SQL hvor vi vælger alt fra login hvor user_name = username
    $sql = "SELECT * FROM login WHERE user_name = '$userName'";
      $result = mysqli_query($conn, $sql)  or die("Query virker ikke - henter");

      print_r($result); 

      //HVIS brugernavnet indtastet findes i DB så først sætter vi is unique til falsk og skriver at navnet er optaget
      if(mysqli_num_rows($result)){
          $isunique = false;
          echo "<script type='text/javascript'>alert('$message');</script>";   
      }
      //HVIS både flag og isuniqe er TRUE så salter vi password og derefter hasher
    if($flag && $isunique == true){
        $salt = "gfnlidrnigfd´4grfd" . $pass1 . "sdfk90e3s¨ds'dfdsf¨fsd";
        $hashed = hash('sha512' , $salt);
                
        //Denne query giver mig problemer
        //Løst! - jeg havde glemt at indsætte values i scores i denne query, efter jeg havde rodet med dem :)
        //Det var blot fordi DB vil have en værdi, da de ikke er NULL, men derimod 0 som standard, og så brokkede
        //den sig, når jeg ikke gav en værdi. Så derfor "blot" 0 i values til scores.
        $sql1 = "INSERT INTO login (user_name, pass, score_labyrint, score_arcade, score_snake, score_breakout)
        values('$userName', '$hashed', '0', '0', '0', '0')";

        $result = mysqli_query($conn, $sql1) or die ("Query virker ikke en skid");
        header("location:index.php");
        
    }
  }


  ?>

    <div class="container text-center markii_spacing_opret_overskrift"> 
    <h1>Register dig som bruger</h1>

        <form action="register.php" method="POST" onSubmit="return checkForm()" id="checkform">
        <div class="form-group text-center markii_spacing_opret">
            <label for="username">Brugernavn:</label>
            <input type="text" class="form-control" id="username" name="username">
        </div>
        <div class="form-group text-center">
            <label for="password">Kodeord:</label>
            <input type="password" class="form-control" id="pass1" name="password1" pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$" title="Store og små bogstaver, min 8 tegn">

            <label for="password2">Kodeord igen:</label>
            <input type="password" class="form-control" id="pass2" name="password2" pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$" title="Store og små bogstaver, min 8 tegn">
        </div>
        <div class="text-center markii_spacing_opret">
        <button name="submit" type="submit" class="btn btn-primary">Opret bruger</button>
        </div>
        </form>

    </div> 
    

    <?php include('inc/footer.php'); ?>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>