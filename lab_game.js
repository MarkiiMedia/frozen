let canvas = document.querySelector("canvas");
    let ctx = canvas.getContext('2d');

    //TEGNER MAZE
    let maze = [
        [0,1,4,1,0,0,0,0,4,1,3,1,0,0,0,0,0,0,0,0,0,0,0],
        [3,1,0,1,0,1,0,1,1,1,4,1,0,1,0,1,1,1,0,1,0,1,1],
        [0,0,0,0,0,1,0,1,4,0,0,1,0,1,0,0,4,1,0,1,0,1,4],
        [0,1,1,1,0,1,0,1,1,1,0,1,0,1,1,1,1,1,0,1,0,1,0],
        [0,1,4,0,0,1,0,0,0,1,0,1,0,0,0,1,0,0,0,1,0,0,0],
        [0,1,0,1,0,1,1,1,0,1,0,1,0,1,0,1,0,1,0,1,0,1,0],
        [0,1,0,1,0,0,0,1,4,0,0,1,0,1,4,1,4,1,0,1,0,1,0],
        [0,1,1,1,0,3,0,1,1,1,1,1,0,1,1,1,1,1,1,1,0,1,0],
        [0,0,-1,1,0,0,0,0,0,0,0,0,0,1,0,3,4,1,4,1,0,1,0],
        [1,1,1,1,1,1,1,1,1,1,1,1,1,1,0,0,0,1,0,1,0,1,0],
        [0,0,0,3,0,1,0,0,0,0,4,1,0,0,0,3,4,1,0,0,0,1,4],
        [0,3,0,0,0,1,0,1,1,1,1,1,1,3,0,1,1,1,1,1,0,1,1],
        [0,1,4,1,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0],
        [0,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,0],
        [0,0,4,1,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,1,4],
        [0,1,1,1,0,1,1,1,1,1,1,1,1,1,1,1,1,1,0,1,0,1,1],
        [0,0,0,0,0,1,0,1,0,0,0,0,0,0,0,0,0,1,0,1,0,0,0],
        [1,1,1,1,1,1,0,1,0,1,1,1,1,1,4,3,0,1,4,1,0,1,1],
        [0,0,0,1,3,4,0,1,0,1,0,0,0,3,4,1,0,1,3,1,0,1,0],
        [0,1,0,1,1,1,0,1,0,1,0,3,0,0,0,1,0,1,1,1,0,3,0],
        [0,1,0,0,0,0,0,0,0,1,0,0,1,3,0,1,0,0,0,0,0,0,0],
        [0,1,1,1,1,1,1,1,1,1,3,0,1,0,0,1,1,1,0,1,1,1,0],
        [0,0,0,0,0,0,0,0,0,0,0,0,1,2,3,1,3,4,0,1,4,0,0]
    ];
    
    let y = 0;
    let x = 0;
    let tileSize = 20;
    let player = -1;
    let score = 0;
    
    //Sounds
    //Baggrundsmusik
    function backgroundmusic() {
        var audio = new Audio ('sounds/laddetske.mp3');
        audio.play();
    }
    
    //Bevægelseslyd
    function beepsound() {
        var audio = new Audio ('sounds/beepsound.mp3');
        audio.play();
    }
    
    //BOMBElyd
    function bombsound() {
        var audio = new Audio ('sounds/bombsound.mp3');
        audio.play();
    }
    
    //KLAPPElyd
    function applausesound() {
        var audio = new Audio ('sounds/applausesound.mp3');
        audio.play();
    }
    
    //VÆGlyd
    function wallsound() {
        var audio = new Audio ('sounds/wallsound.mp3');
        audio.play();
    }

    //POINTlyd
    function pointsound() {
        var audio = new Audio ('sounds/pointsound.mp3');
         audio.play();
    }
    
    
    //Generel countdown til at klare spillet
    (function countdown(remaining) {
        if(remaining === 0)
            location.reload(true);
            
        document.querySelector('#countdown').innerHTML = remaining;
        setTimeout(function(){ countdown(remaining - 1); }, 1000);
    })(60);

    backgroundmusic();
    
//Elsa player tile
let elsa = new Image();
elsa.src = 'img/elsa_player.jpg';

//Bombe tile
let bombpic = new Image();
bombpic.src = 'img/bomb_lab_game.jpg';

//point tile
let pointtilepic = new Image();
pointtilepic.src = 'img/point_lab_game.jpg';

//goal/hans tile
let hansgoaltile = new Image();
hansgoaltile.src = 'img/hans_goal_lab_game.jpg';

    function grid() {
        for(y = 0; y < maze.length; y++) {
            //Det yderste loop kaster ét tal af sted
            for(x = 0; x < maze[y].length; x++) {
                //Denne ovenstående refererer til første loops længde
                //Det inderste loop kaster 3 tal afsted
    
                //Her bygges vores spil op
                /*
                Hvis 0 så laves HVID tile (der hvor man kan bevæge sig)
                Hvis 1 så laves BLÅ tile (vægge i spillet)
                Hvis 2 så laves HANS tile (mål)
                Hvis -1 så laves ELSA (spiller)
                Hvis 3 så laves BOMBE tile (bomber)
                Hvis 4 så laves POINT tile (point)
                */
                if(maze[y][x] == 0){
                    ctx.fillStyle = "white";
                    ctx.fillRect(x * tileSize, y * tileSize, tileSize, tileSize);
                } else if (maze[y][x] == 1) {
                    ctx.fillStyle = "#41A6D4";
                    ctx.fillRect(x * tileSize, y * tileSize, tileSize, tileSize);
                } else if (maze[y][x] == 2) {
                    ctx.drawImage(hansgoaltile, x * tileSize, y * tileSize, tileSize, tileSize)
                } else if(maze[y][x] == -1){
                    player = {y,x};
                    //console.log(player.y + " " + player.x);
                    ctx.drawImage(elsa, x * tileSize, y * tileSize, tileSize, tileSize);      
                } else if (maze[y][x] == 3) {
                    ctx.drawImage(bombpic, x * tileSize, y * tileSize, tileSize, tileSize)
                } else if (maze[y][x] == 4) {
                    ctx.drawImage(pointtilepic, x * tileSize, y * tileSize, tileSize, tileSize)

                }
                //Bare log
                console.log("y er = " + y + " og x er = " + x);
            }
        }
    
    }
    
    //Callback function (vi har tjekket hvad keyCode er inde i f12)
    window.addEventListener('keydown', function(event) {
        console.log(event.keyCode);
    
        //Her er vores switch som ud fra hvilken case der sker, kører vores if (else if) osv.
        //Det er sat op til at kigge på vores keyCode som vi fandt tidligere at f.eks venstre er 37.
        /*
        1. if vi rykker player f.eks -1 (det vil sige en til venstre da det er på x-aksen) og derefter sætter den nye position til 0
        2. else if hvis vi rammer en 3'er så kører vi bombsound og i en timeout reloader(så bombelyd kan nå at spilles) (død)
        3. else if hvis vi rammer en 2'er så vinder vi og kører applausesound og i en timeout sender profile siden (og gemmer score)
        4. else if hvis vi rammer en 4'er så får vi point og tæller derfor score op
        5. vores generelle else er wallsound, altså når vi rammer en væg. For vi kan jo ikke ramme andre muligheder efter de andre
        */
        switch (event.keyCode) {
            case 37:
                //alert("venstre")
                //x aksen -1 betyder venstre
                if(maze[player.y][player.x-1] == 0){
                    maze[player.y][player.x-1] = -1;
                    maze[player.y][player.x] = 0; 
                    beepsound();
    
                } else if (maze[player.y][player.x-1] == 3){
                    bombsound();
                    setTimeout (function() {
                        location.reload()
                    },800);
                    //alert("DU DØDE DIN IDIOT");
    
                } else if (maze[player.y][player.x-1] == 2){
                    applausesound();
                    //Her vil jeg istedet have en score der regnes således:
                    //Timeleft + score
                    setTimeout (function() {
                        gameover(score);
                    },2500);
                    //alert("DU VANDT");
    
                } else if (maze[player.y][player.x-1] == 4){
                    pointsound();
                    // +10 på score
                    score += 10;
                    // Display score on screen
                    document.getElementById('score').innerHTML = score;
                    maze[player.y][player.x-1] = -1;
                    maze[player.y][player.x] = 0;
                } else {
                    wallsound();
                } grid();  
                break;
    
            case 38:
                //alert("op")´
                //Y aksen -1 betyder op
                if(maze[player.y-1][player.x] == 0){
                     maze[player.y-1][player.x] = -1;
                     maze[player.y][player.x] = 0; 
                     beepsound();
    
                } else if (maze[player.y-1][player.x] == 3){
                    bombsound();
                    setTimeout (function() {
                        location.reload()
                    },800);
                    //alert("DU DØDE DIN IDIOT");
    
                } else if (maze[player.y-1][player.x] == 2){
                    applausesound();
                    setTimeout (function() {
                        gameover(score);
                    },2500);
                //alert("DU VANDT");
                } else if (maze[player.y-1][player.x] == 4){
                    pointsound();
                    // +10 på score
                    score += 10;
                    // Display score on screen
                    document.getElementById('score').innerHTML = score;
                    maze[player.y-1][player.x] = -1;
                    maze[player.y][player.x] = 0;
                } else {
                    wallsound();
                }grid(); 
                break;
    
            case 39:
                //alert("højre")
                //x aksen +1 betyder højre
                if(maze[player.y][player.x+1] == 0){
                    maze[player.y][player.x+1] = -1;
                    maze[player.y][player.x] = 0;
                    beepsound();
    
                } else if (maze[player.y][player.x+1] == 3){
                    bombsound();
                    setTimeout (function() {
                        location.reload()
                    },800);
                    //alert("DU DØDE DIN IDIOT");
    
                } else if (maze[player.y][player.x+1] == 2){
                    applausesound();
                    setTimeout (function() {
                        gameover(score);
                    },2500);
                //alert("DU VANDT");
                } else if (maze[player.y][player.x+1] == 4){
                    pointsound();
                    // +10 på score
                    score += 10;
                    // Display score on screen
                    document.getElementById('score').innerHTML = score;
                    maze[player.y][player.x+1] = -1;
                    maze[player.y][player.x] = 0;
                } else {
                    wallsound();
                }grid();
                break;
    
            case 40:
                //alert("ned")
                //y aksen +1 betyder ned
                if(maze[player.y+1][player.x] == 0){
                    maze[player.y+1][player.x] = -1;
                    maze[player.y][player.x] = 0;
                    beepsound();
    
                } else if (maze[player.y+1][player.x] == 3){
                    bombsound();
                    setTimeout (function() {
                        location.reload()
                    },800);
                    //alert("DU DØDE DIN IDIOT");
    
                } else if (maze[player.y+1][player.x] == 2){
                    applausesound();
                    setTimeout (function() {
                        gameover(score);
                    },2500);
                    //alert("DU VANDT");
                } else if (maze[player.y+1][player.x] == 4){
                    pointsound();
                    // +10 på score
                    score += 10;
                    // Display score on screen
                    document.getElementById('score').innerHTML = score;
                    maze[player.y+1][player.x] = -1;
                    maze[player.y][player.x] = 0;
                } else {
                    wallsound();
                }grid();
                 break;
        
            default:
                break;
        }
    })

    //Funktionen tager score som parameter samt gameID med til profil ved endt spil og indsætter dem derfra i DB
    function gameover(score) {
        document.location = 'profile.php?step=setscore&score=' + score + '&gameID=labyrint'
      }
    
    grid();