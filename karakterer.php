<?php require_once('config/config.php'); ?>
<?php require_once('config/db.php'); ?>

<?php include('inc/header.php'); ?>
  
    
<?php 
session_start();
    if(isset($_SESSION['adgang'])){
      //Blot brugt til testing af rettighedsstyring 
      //echo '<div><h1>Velkommen, du er allerede logget ind, så du skal se et eller andet sjovt her</h1></div>';
       
       echo '<div class="jumbotron markii_jumbotron_color_spacing">
       <h1 class="display-4">Frozen! karakterer</h1>
       <p class="lead">Her kan du læse lidt om de forskellige karakterer i Frozen universet.</p>
       <hr class="my-4">
       <p>Vil du se det originale Disney Frozen univers?</p>
       <a class="btn btn-primary btn-lg" href="https://frozen.disney.com/" role="button" target="blank">Disney official</a>
     </div>';
       
       
       echo '<div class="row">
       <div class="col-sm-6">
         <div class="card text-center markii_background_color markii_mellemrum_forside">
         <img src="img/ct_frozen_elsa.jpg" class="card-img-top" alt="...">
           <div class="card-body">
             <h5 class="card-title">Elsa</h5>
             <p class="card-text">Elsa is the perfect mythic character – magical and larger than life.</p>
             <a href="https://frozen.disney.com/elsa" class="btn btn-primary" target="blank">Disney official</a>
           </div>
         </div>
       </div>
       <div class="col-sm-6">
         <div class="card text-center markii_background_color markii_mellemrum_forside">
         <img src="img/ct_frozen_anna.jpg" class="card-img-top" alt="...">
           <div class="card-body">
             <h5 class="card-title">Anna</h5>
             <p class="card-text">Anna is the perfect fairytale character; unflappable, she is the forever optimist.</p>
             <a href="https://frozen.disney.com/anna" class="btn btn-primary" target="blank">Disney official</a>
           </div>
         </div>
       </div>
       <div class="col-sm-3">
         <div class="card text-center markii_background_color markii_mellemrum_forside">
         <img src="img/ct_frozen_kristoff.jpeg" class="card-img-top" alt="...">
           <div class="card-body">
             <h5 class="card-title">Kristoffer</h5>
             <p class="card-text">Kristoff is a true outdoorsman. He lives high up in the mountains where he harvests ice and sells it to the kingdom of Arendelle.</p>
             <a href="https://frozen.disney.com/kristoff" class="btn btn-primary" target="blank">Disney official</a>
           </div>
         </div>
       </div>
       <div class="col-sm-3">
         <div class="card text-center markii_background_color markii_mellemrum_forside">
         <img src="img/ct_frozen_olaf.jpg" class="card-img-top" alt="...">
           <div class="card-body">
             <h5 class="card-title">Olaf</h5>
             <p class="card-text">Hes Olaf and he likes warm hugs. He is by far the friendliest snowman to walk the mountains above Arendelle.</p>
             <a href="https://frozen.disney.com/olaf" class="btn btn-primary" target="blank">Disney official</a>
           </div>
         </div>
       </div>
       <div class="col-sm-3">
         <div class="card text-center markii_background_color markii_mellemrum_forside">
         <img src="img/ct_frozen_svend.jpg" class="card-img-top" alt="...">
           <div class="card-body">
             <h5 class="card-title">Svend</h5>
             <p class="card-text">A reindeer with the heart of a Labrador, Sven is Kristoffs loyal friend, sleigh-puller and conscience.</p>
             <a href="#" class="btn btn-primary disabled" target="blank">Disney official</a>
           </div>
         </div>
       </div>
       <div class="col-sm-3">
         <div class="card text-center markii_background_color markii_mellemrum_forside">
         <img src="img/ct_frozen_snowglies.jpg" class="card-img-top" alt="...">
           <div class="card-body">
             <h5 class="card-title">Snowgies</h5>
             <p class="card-text">Snowgies are little snowmen Elsa unwittingly creates every time she sneezes—and she sneezes a lot.</p>
             <a href="#" class="btn btn-primary disabled" target="blank">Disney official</a>
           </div>
         </div>
       </div>
       <div class="col-sm-3">
         <div class="card text-center markii_background_color markii_mellemrum_forside">
         <img src="img/ct_frozen_hans.jpg" class="card-img-top" alt="...">
           <div class="card-body">
             <h5 class="card-title">Hans</h5>
             <p class="card-text">Hans is a handsome royal from a neighboring kingdom who comes to Arendelle for Elsas coronation.</p>
             <a href="#" class="btn btn-primary disabled" target="blank">Disney official</a>
           </div>
         </div>
       </div>
       <div class="col-sm-3">
         <div class="card text-center markii_background_color markii_mellemrum_forside">
         <img src="img/ct_frozen_duke.jpg" class="card-img-top" alt="...">
           <div class="card-body">
             <h5 class="card-title">Duke of Weselton</h5>
             <p class="card-text">What the Duke of Weselton lacks in stature, he makes up for in arrogance and showboating.</p>
             <a href="#" class="btn btn-primary disabled" target="blank">Disney official</a>
           </div>
         </div>
       </div>
       <div class="col-sm-3">
         <div class="card text-center markii_background_color markii_mellemrum_forside">
         <img src="img/ct_frozen_oaken.jpg" class="card-img-top" alt="...">
           <div class="card-body">
             <h5 class="card-title">Oaken</h5>
             <p class="card-text">Oaken runs Wandering Oakens Trading Post and Sauna. Not cute or anything to like, indeed</p>
             <a href="#" class="btn btn-primary disabled" target="blank">Disney official</a>
           </div>
         </div>
       </div>
       <div class="col-sm-3">
         <div class="card text-center markii_background_color markii_mellemrum_forside">
         <img src="img/ct_frozen_marshmallow.jpg" class="card-img-top" alt="...">
           <div class="card-body">
             <h5 class="card-title">Marshmallow</h5>
             <p class="card-text">Marshmallow is an enormous icy snowman born from Elsas powers. Cute as a simple flower</p>
             <a href="#" class="btn btn-primary disabled" target="blank">Disney official</a>
           </div>
         </div>
       </div>
     </div>';

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