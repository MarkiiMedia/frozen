<?php require_once('config/config.php'); ?>
<?php require_once('config/db.php'); ?>

<?php include('inc/header.php'); ?>

<?php 
session_start();
    if(isset($_SESSION['adgang'])){
      //Blot brugt til testing af rettighedsstyring  
      //echo '<div><h1>Velkommen, du er allerede logget ind, så du skal se et eller andet sjovt her</h1></div>';
       
       echo '<div class="jumbotron markii_jumbotron_color_spacing">
       <h1 class="display-4">Syng med!</h1>
       <p class="lead">Vi har samlet alle de bedste sange fra Frozen lige her, så du kan synge med.</p>
       <hr class="my-4">
       <p>Læs mere om Frozen og Frozen 2.</p>
       <a class="btn btn-primary btn-lg" target="_blank" href="https://frozen.disney.com/" role="button">Disney official</a>
     </div>';
       
       
       echo '<div class="row">

       <div class="col-sm-12">
       <div class="card text-center markii_background_color markii_mellemrum_forside">
       <div class="embed-responsive embed-responsive-16by9">
      <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/CW1YkYQy-Ng" allowfullscreen></iframe>
      </div>
         <div class="card-body">
           <h5 class="card-title">Lad det ske</h5>
           </div>
         </div>
       </div>



       <div class="col-sm-6">
         <div class="card text-center markii_background_color markii_mellemrum_forside">
         <div class="embed-responsive embed-responsive-16by9">
        <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/zXq8rbWd1Zo" allowfullscreen></iframe>
        </div>
           <div class="card-body">
             <h5 class="card-title">Jeg har ventet alt for længe</h5>
           </div>
         </div>
       </div>

       <div class="col-sm-6">
       <div class="card text-center markii_background_color markii_mellemrum_forside">
       <div class="embed-responsive embed-responsive-16by9">
      <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/yaqXsG5wNo8" allowfullscreen></iframe>
      </div>
         <div class="card-body">
           <h5 class="card-title">Småskavanker</h5>
           </div>
         </div>
       </div>

       <div class="col-sm-6">
       <div class="card text-center markii_background_color markii_mellemrum_forside">
       <div class="embed-responsive embed-responsive-16by9">
      <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/_Q9KOfR_5mI" allowfullscreen></iframe>
      </div>
         <div class="card-body">
           <h5 class="card-title">Til sommer</h5>
           </div>
         </div>
       </div>

       <div class="col-sm-6">
       <div class="card text-center markii_background_color markii_mellemrum_forside">
       <div class="embed-responsive embed-responsive-16by9">
      <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/HfTdK93ldnQ" allowfullscreen></iframe>
      </div>
         <div class="card-body">
           <h5 class="card-title">Skal vi ikke lave en snemand</h5>
           </div>
         </div>
       </div>
 
     </div>
     ';

    } else{
        header("location:index.php");
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