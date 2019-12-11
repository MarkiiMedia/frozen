//Vores canvas
var canvas = document.getElementById("myCanvas");
var ctx = canvas.getContext("2d");
//Bold størrelse
var ballRadius = 10;
//Width divideret med 2, giver at x altså bolden på x aksen starter i midten
var x = canvas.width/2;
//y -30 på y aksen
var y = canvas.height-30;
var dx = 2;
var dy = -2;
//Bat højde
var paddleHeight = 10;
//Bat bredde
var paddleWidth = 75;
//Bat startposition (altså på xaksen er det canvas vidde-batvidde/2, således det bliver i midten)
var paddleX = (canvas.width-paddleWidth)/2;
//Som udgangspunkt er det falsk at vi trykker på højre (ellers rykker lortet sig konstant, skal først være true når vi faktisk GØR det)
var rightPressed = false;
//Som udgangspunkt er det falsk at vi trykker på venstre (ellers rykker lortet sig konstant, skal først være true når vi faktisk GØR det)
var leftPressed = false;
//Rækker = 5
var brickRowCount = 5;
//Kolonne = 3
var brickColumnCount = 3;
//Brick vidde
var brickWidth = 75;
//Brick højde
var brickHeight = 20;
//Brick padding (sjove ting ved at lave lidt større padding)
var brickPadding = 10;
//Brick offset fra toppen
var brickOffsetTop = 30;
//Brick offset fra venstre
var brickOffsetLeft = 30;
//Score sat til 0 til start af spillet
var score = 0;
//Liv sat til 3 fra start af spillet
var lives = 3;
//Bricks fjernet som udgangspunkt
var bricksremoved = 0;
//Startlevel
var level = 0;
//Fart
var speed = 2;
var bricks = [];

//Kører første gang og hver gang vi "går i nul"
/* Således får vi:
level up
speed up (fordi vi starter på 2 hedder den speed * -1, altså så vi ikke først går på 3, men "bliver på 2"),
men at vi næste gang går på 3 og derefter 4 osv osv.
bricksremoved bliver sat til 0 igen (som udgangspunktet)
column og row bliver bygget igen ved c er mindre end brickcolumncount og derfor plusser op til den ikk er det mere, og på
denne måde bliver vores bricks sat op igen (samme med brick row)
status sættes desuden til 1, fordi når vi så senere rammer dem bliver status 0 og de vil ikke vises før næste gang denne kører
*/
function initBricks() {
  level++;
  speed++;
  dx=speed;
  dy=(speed * -1);
  bricksremoved = 0;
  for(var c=0; c<brickColumnCount; c++) {
    bricks[c] = [];
    for(var r=0; r<brickRowCount; r++) {
      bricks[c][r] = { x: 0, y: 0, status: 1 };
    }
  }
}


//Lytter på keydown, keyup og mousemove
document.addEventListener("keydown", keyDownHandler, false);
document.addEventListener("keyup", keyUpHandler, false);
document.addEventListener("mousemove", mouseMoveHandler, false);

//Når der presses NED på knapperne så bliver state til true (sat til false som udgangspunkt)
function keyDownHandler(e) {
    if(e.key == "Right" || e.key == "ArrowRight") {
        rightPressed = true;
    }
    else if(e.key == "Left" || e.key == "ArrowLeft") {
        leftPressed = true;
    }
}
//Når der slippes på knapperne igen så bliver state til false igen (ligesom udgangspunktet)
//Hvis dette ikke skete ville den blot blive ved at gå mod højre/venstre da den jo ikke ville blive false state igen efter endt tryk
function keyUpHandler(e) {
    if(e.key == "Right" || e.key == "ArrowRight") {
        rightPressed = false;
    }
    else if(e.key == "Left" || e.key == "ArrowLeft") {
        leftPressed = false;
    }
}


//Muse bevægelse
function mouseMoveHandler(e) {
  var relativeX = e.clientX - canvas.offsetLeft;
  if(relativeX > 0 && relativeX < canvas.width) {
    paddleX = relativeX - paddleWidth/2;
  }
}
/* 
her tjekkes om der rammes bricks:
variablerne c og r er vores column og row på vores bricks
looper igennem bricks og sammenligner hver bricks position mod boldens position
b variablen indeholder brick objektet i hvert loop
*/
function collisionDetection() {
  for(var c=0; c<brickColumnCount; c++) {
    for(var r=0; r<brickRowCount; r++) {
      var b = bricks[c][r];
      /* Hvis status er 1, altså stadig aktiv tjekker vi efter kolision,
      4 ting skal være sande:
        x postitionen af bolden er STØRRE end x positionen af brick
        x positionen af bolden er MINDRE end x positionen af brick PLUS vidden
        y postitionen af bolden er STØRRE end y positionen af brick
        y positionen af bolden er MINDRE end y positionen af brick PLUS højden
      rykker derefter bolden i modsatte retning,
      sætter status til 0 (brick skal jo ikke tegnes mere efter den er ramt),
      samt sætter score++ og bricksremoved++
      HVIS bricksremoved er lig med brickrowcount*brickcolumncount er der ikke flere bricks og man stiger
      derfor level og vi starter forfra med at tegne alle bricks (initBricks)
      */
      if(b.status == 1) {
        if(x > b.x && x < b.x+brickWidth && y > b.y && y < b.y+brickHeight) {
          dy = -dy;
          b.status = 0;
          score++;
          bricksremoved++;
          if(bricksremoved == brickRowCount*brickColumnCount) {
            alert("Du har nu nået level: " + (level+1));
            //gameover(score);
            initBricks();
          }
        }
      }
    }
  }
}
//Tegn bold
function drawBall() {
  ctx.beginPath();
  ctx.arc(x, y, ballRadius, 0, Math.PI*2);
  ctx.fillStyle = "#0095DD";
  ctx.fill();
  ctx.closePath();
}
//Tegn "bat"
function drawPaddle() {
  ctx.beginPath();
  ctx.rect(paddleX, canvas.height-paddleHeight, paddleWidth, paddleHeight);
  ctx.fillStyle = "#0095DD";
  ctx.fill();
  ctx.closePath();
}

//Tegn bricks
/* 
Looper igennem og tjekker alle bricks
HVIS status er 1 så tegnes brick
Hver brickX position regnes som brickWidth + brickPadding * kolonne nr, c + brickOffsetLeft.
samme med brickY - der udregnes hvor de skal placeres
*/
function drawBricks() {
  for(var c=0; c<brickColumnCount; c++) {
    for(var r=0; r<brickRowCount; r++) {
      if(bricks[c][r].status == 1) {
        var brickX = (r*(brickWidth+brickPadding))+brickOffsetLeft;
        var brickY = (c*(brickHeight+brickPadding))+brickOffsetTop;
        bricks[c][r].x = brickX;
        bricks[c][r].y = brickY;
        ctx.beginPath();
        ctx.rect(brickX, brickY, brickWidth, brickHeight);
        ctx.fillStyle = "#0095DD";
        ctx.fill();
        ctx.closePath();
      }
    }
  }
}
//Tegn score
function drawScore() {
  ctx.font = "16px Arial";
  ctx.fillStyle = "#0095DD";
  ctx.fillText("Score: "+score, 8, 20);
}
//Tegn liv
function drawLives() {
  ctx.font = "16px Arial";
  ctx.fillStyle = "#0095DD";
  ctx.fillText("Liv: "+lives, canvas.width-65, 20);
}
//Tegn level
function drawLevel() {
  ctx.font = "16px Arial";
  ctx.fillStyle = "#0095DD";
  ctx.fillText("Level: "+level, canvas.width/2-20, 20);
}
//Alt tegn - bliver kaldt hver 10 milisekund indtil stoppes, sådan tegner vi
function draw() {
  //Clearer canvas hele tiden, sådan at det ikke er trails
  ctx.clearRect(0, 0, canvas.width, canvas.height);
  drawBricks();
  drawBall();
  drawPaddle();
  drawScore();
  drawLives();
  drawLevel();
  collisionDetection();

  //Bouncing herunder. Generelt hvis bolden rammer noget så rykker vi modsat
  //HVIS xogdx er større end width minus boldradius ELLER xogdx er mindre end boldradius
  // || betyder ELLER
  //Altså allerede hvis første del er sandt, gider den ikke teste næste del efter ELLER
  //Altså kræver vi kun at en af disse skal være true
  //I dette tilfælde så rammer bolden kanten af canvas og derfor ændrer den retning, ved at sætte dx til MINUS, altså modsat retning
  if(x + dx > canvas.width-ballRadius || x + dx < ballRadius) {
    dx = -dx;
  }
  
  /*
  sætter den lig sig selv, omvendt. (hvis den bevægede sig opad med 2px vil den nu bevæge sig "op" altså ned (fordi det er -2), med en fart på
  -2px )
  */ 
  if(y + dy < ballRadius) {
    dy = -dy;
  }
  // Rammer bat
  else if(y + dy > canvas.height-ballRadius) {
    if(x > paddleX && x < paddleX + paddleWidth) {
      dy = -dy;
    }
    else {
      //Mister 1 liv hver gang man rammer bunden
      lives--;
      //Mister 1 i score hver gang man rammer bunden
      score--;
      
      /*
      Hvis ikke flere liv (vi har 3 som udgangspunkt - 
      så alert at spil er slut og vis score, og kør gameover funktion med score som argument)
      */ 
      if(!lives) {
        alert("Spil slut! Du fik " + score + " point");
        gameover(score);
        
      }
      /*
      Hvis ovenstående sker, men vi stadig har flere liv, så start bolden igen som vi gjorde fra start (x og y akserne)
      og derefter sæt fart ned og sæt paddle i midten igen
      */
      else {
        x = canvas.width/2;
        y = canvas.height-30;
        speed--;
        dx = speed;
        dy = speed * -1;
        paddleX = (canvas.width-paddleWidth)/2;
      }
    }
  }

  //Bevægelse af bat
  if(rightPressed && paddleX < canvas.width-paddleWidth) {
    paddleX += 7;
  }
  else if(leftPressed && paddleX > 0) {
    paddleX -= 7;
  }

  //shortcutoperator
  //her står i virkeligheden:
  //x = x+dx
  x += dx;
  y += dy;
  requestAnimationFrame(draw);
}
//Funktionen tager score som parameter samt gameID med til profil ved endt spil og indsætter dem derfra i DB
function gameover(score) {
  document.location = 'profile.php?step=setscore&score=' + score + '&gameID=breakout'
}
initBricks();
draw();
