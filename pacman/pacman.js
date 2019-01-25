const PACMAN_SPEED = 10;
const GHOST_SPEED = 5;

var walls = new Array();

var output;
var pacman;
var redGhost;
var pinkGhost;
var greenGhost;
var blueGhost;

var loopTimer;
var numLoops = 0;

var upArrowDown = false;
var downArrowDown = false;
var leftArrowDown = false;
var rightArrowDown = false;

var direction = 'right';
var rgDirection; //Red Ghost Direction
var pgDirection; //Pink Ghost Direction
var ggDirection; //Green Ghost Direction
var bgDirection; //Blue Ghost Direction

// LISTENERS
document.addEventListener('keydown', function(event) {
    if(event.keyCode==37) leftArrowDown = true;
    if(event.keyCode==38) upArrowDown = true;
    if(event.keyCode==39) rightArrowDown = true;
    if(event.keyCode==40) downArrowDown = true;
});

document.addEventListener('keyup', function(event) {
     if(event.keyCode==37) leftArrowDown = false;
     if(event.keyCode==38) upArrowDown = false;
     if(event.keyCode==39) rightArrowDown = false;
     if(event.keyCode==40) downArrowDown = false;
});

// FUNCTIONS
function loadComplete(){
	output = document.getElementById('output');
	pacman = document.getElementById('pacman');
	pacman.style.left = '280px';
	pacman.style.top = '240px';
	pacman.style.width ='40px';
	pacman.style.height = '40px';
	
	redGhost = document.getElementById('redGhost');
	redGhost.style.left = '250px';
	redGhost.style.top = '40px';
	redGhost.style.width = '40px';
	redGhost.style.height = '40px';
	
	pinkGhost = document.getElementById('pinkGhost');
	pinkGhost.style.left = '310px';
	pinkGhost.style.top = '40px';
	pinkGhost.style.width = '40px';
	pinkGhost.style.height = '40px';
	
	greenGhost = document.getElementById('greenGhost');
	greenGhost.style.left = '200px';
	greenGhost.style.top = '40px';
	greenGhost.style.width = '40px';
	greenGhost.style.height = '40px';
	
	blueGhost = document.getElementById('blueGhost');
	blueGhost.style.left = '360px';
	blueGhost.style.top = '40px';
	blueGhost.style.width = '40px';
	blueGhost.style.height = '40px';
	
	loopTimer = setInterval(loop, 50);
	
	// inside walls
	createWall(240, 280, 120, 40);
	createWall(240, 200, 120, 40);
	
	createWall(240, 80, 40, 80);
	createWall(320, 80, 40, 80);
	
	createWall(160, 0, 40, 120);
	createWall(400, 0, 40, 120);
	
	createWall(160, 160, 40, 40);
	createWall(400, 160, 40, 40);
	
	createWall(160, 240, 40, 140);
	createWall(400, 240, 40, 140);
	
	createWall(80, 80, 40, 40);
	createWall(480, 80, 40, 40);
	
	createWall(80, 160, 40, 160);
	createWall(480, 160, 40, 160);
	
	// top wall
	createWall(-20, 0, 640, 40);
	
	// left side walls
	createWall(0, 0, 40, 180);
	createWall(0, 220, 40, 180);
	
	// right side walls
	createWall(560, 0, 40, 180);
	createWall(560, 220, 40, 180);
	
	// bottom wall
	createWall(-20, 360, 640, 40);
}

function createWall(left, top, width, height) {
    var wall = document.createElement('div');
	wall.className = 'wall';
	wall.style.left = left + 'px';
	wall.style.top = top + 'px';
	wall.style.width = width + 'px';
	wall.style.height = height + 'px';
	gameWindow.appendChild(wall);
	
	walls.push(wall);
}

function loop() {
    numLoops++;
    tryToChangeDirection();
    
    var originalLeft = pacman.style.left;
    var originalTop = pacman.style.top;
    
    if(direction == 'up') {
        var pacmanY = parseInt(pacman.style.top) - PACMAN_SPEED;
        if(pacmanY < -30) pacmanY = 390;
        pacman.style.top = pacmanY + 'px';
    }
    if(direction == 'down') {
        var pacmanY = parseInt(pacman.style.top) + PACMAN_SPEED;
        if(pacmanY > 390) pacmanY = -30;
        pacman.style.top = pacmanY + 'px';
    }
    if(direction == 'left') {
        var pacmanX = parseInt(pacman.style.left) - PACMAN_SPEED;
        if(pacmanX < -30) pacmanX = 590;
        pacman.style.left = pacmanX + 'px';
    }
    if(direction == 'right') {
        var pacmanX = parseInt(pacman.style.left) + PACMAN_SPEED;
        if(pacmanX > 590) pacmanX = -30;
        pacman.style.left = pacmanX + 'px';
    }
    
    if(hitWall(pacman)) {
        pacman.style.left = originalLeft;
        pacman.style.top = originalTop;
    }
    
    moveRedGhost();
    movePinkGhost();
    moveGreenGhost();
    moveBlueGhost();
    
    if(hittest(pacman, redGhost)) {
        clearInterval(loopTimer);
    }
    if(hittest(pacman, pinkGhost)) {
        clearInterval(loopTimer);
    }
    if(hittest(pacman, greenGhost)) {
        clearInterval(loopTimer);
    }
    if(hittest(pacman, blueGhost)) {
        clearInterval(loopTimer);
    }
}

function hitWall(element) {
    var hit = false;
    
    for(var i=0; i<walls.length; i++) {
        if(hittest(walls[i], element)) hit = true;
    }
    
    return hit;
}

function tryToChangeDirection() {
    var originalLeft = pacman.style.left;
    var originalTop = pacman.style.top;
    
    if(leftArrowDown) {
        pacman.style.left = parseInt(pacman.style.left) - PACMAN_SPEED + 'px';
        if(!hitWall(pacman)) {
            direction = 'left';
            pacman.className = "flip-horizontal";
        }
    }
    if(upArrowDown) {
        pacman.style.top = parseInt(pacman.style.top) - PACMAN_SPEED + 'px';
        if(!hitWall(pacman)) {
            direction = 'up';
            pacman.className = "rotate270";
        }
    }
    if(rightArrowDown) { 
        pacman.style.left = parseInt(pacman.style.left) + PACMAN_SPEED + 'px';
        if(!hitWall(pacman)) {
            direction = 'right';
            pacman.className = "";
        }
    }
    if(downArrowDown) {
        pacman.style.top = parseInt(pacman.style.top) + PACMAN_SPEED + 'px';
        if(!hitWall(pacman)) {
           direction = 'down';
            pacman.className = "rotate90"; 
        }
    }
    
    pacman.style.left = originalLeft;
    pacman.style.top = originalTop;
}

function moveRedGhost() {
    // Move Red Ghost
    // Assumption that there are no dead ends in the maze
    // Rules: never go in the opposite direction
    // Randomly choose a sirection every move (excluding the opposite direction)
    var rgX = parseInt(redGhost.style.left);
    var rgY = parseInt(redGhost.style.top);
    
    var rgNewDirection;
    
    var rgOppositeDirection;
    if(rgDirection == 'left') rgOppositeDirection = 'right';
    else if(rgDirection == 'right') rgOppositeDirection = 'left';
    else if(rgDirection == 'down') rgOppositeDirection = 'up';
    else if(rgDirection == 'up') rgOppositeDirection = 'down';
    
    do { 
        redGhost.style.left = rgX + 'px';
        redGhost.style.top = rgY + 'px';
        
        do {
            var r = Math.floor(Math.random()*4);
            if(r == 0) rgNewDirection = 'right';
            else if(r == 1) rgNewDirection = 'left';
            else if(r == 2) rgNewDirection = 'down';
            else if(r == 3) rgNewDirection = 'up';
        } while(rgNewDirection == rgOppositeDirection);
        
        if(rgNewDirection == 'right') {
            if(rgX > 590) rgX = -30;
            redGhost.style.left = rgX + GHOST_SPEED + 'px';
        }
        else if(rgNewDirection == 'left') {
            if(rgX < -30) rgX = 590;
            redGhost.style.left = rgX - GHOST_SPEED + 'px';
        }
        else if(rgNewDirection == 'down') {
            if(rgY > 390) rgY = -30;
            redGhost.style.top = rgY + GHOST_SPEED + 'px';
        }
        else if(rgNewDirection == 'up') {
            if(rgY < -30) rgY = 390;
            redGhost.style.top = rgY - GHOST_SPEED + 'px';
        }
    
    } while(hitWall(redGhost));    
    
    rgDirection = rgNewDirection;
}

function movePinkGhost() {
    // Move Pink Ghost
    // Assumption that there are no dead ends in the maze
    // Rules: never go in the opposite direction
    // Randomly choose a sirection every move (excluding the opposite direction)
    var pgX = parseInt(pinkGhost.style.left);
    var pgY = parseInt(pinkGhost.style.top);
    
    var pgNewDirection;
    
    var pgOppositeDirection;
    if(pgDirection == 'left') pgOppositeDirection = 'right';
    else if(pgDirection == 'right') pgOppositeDirection = 'left';
    else if(pgDirection == 'down') pgOppositeDirection = 'up';
    else if(pgDirection == 'up') pgOppositeDirection = 'down';
    
    do { 
        pinkGhost.style.left = pgX + 'px';
        pinkGhost.style.top = pgY + 'px';
        
        do {
            var r = Math.floor(Math.random()*4);
            if(r == 0) pgNewDirection = 'right';
            else if(r == 1) pgNewDirection = 'left';
            else if(r == 2) pgNewDirection = 'down';
            else if(r == 3) pgNewDirection = 'up';
        } while(pgNewDirection == pgOppositeDirection);
        
        if(pgNewDirection == 'right') {
            if(pgX > 590) pgX = -30;
            pinkGhost.style.left = pgX + GHOST_SPEED + 'px';
        }
        else if(pgNewDirection == 'left') {
            if(pgX < -30) pgX = 590;
            pinkGhost.style.left = pgX - GHOST_SPEED + 'px';
        }
        else if(pgNewDirection == 'down') {
            if(pgY > 390) pgY = -30;
            pinkGhost.style.top = pgY + GHOST_SPEED + 'px';
        }
        else if(pgNewDirection == 'up') {
            if(pgY < -30) pgY = 390;
            pinkGhost.style.top = pgY - GHOST_SPEED + 'px';
        }
    
    } while(hitWall(pinkGhost));    
    
    pgDirection = pgNewDirection;
}

function moveGreenGhost() {
    // Move Green Ghost
    // Assumption that there are no dead ends in the maze
    // Rules: never go in the opposite direction
    // Randomly choose a sirection every move (excluding the opposite direction)
    var ggX = parseInt(greenGhost.style.left);
    var ggY = parseInt(greenGhost.style.top);
    
    var ggNewDirection;
    
    var ggOppositeDirection;
    if(ggDirection == 'left') ggOppositeDirection = 'right';
    else if(ggDirection == 'right') ggOppositeDirection = 'left';
    else if(ggDirection == 'down') ggOppositeDirection = 'up';
    else if(ggDirection == 'up') ggOppositeDirection = 'down';
    
    do { 
        greenGhost.style.left = ggX + 'px';
        greenGhost.style.top = ggY + 'px';
        
        do {
            var r = Math.floor(Math.random()*4);
            if(r == 0) ggNewDirection = 'right';
            else if(r == 1) ggNewDirection = 'left';
            else if(r == 2) ggNewDirection = 'down';
            else if(r == 3) ggNewDirection = 'up';
        } while(ggNewDirection == ggOppositeDirection);
        
        if(ggNewDirection == 'right') {
            if(ggX > 590) ggX = -30;
            greenGhost.style.left = ggX + GHOST_SPEED + 'px';
        }
        else if(ggNewDirection == 'left') {
            if(ggX < -30) ggX = 590;
            greenGhost.style.left = ggX - GHOST_SPEED + 'px';
        }
        else if(ggNewDirection == 'down') {
            if(ggY > 390) ggY = -30;
            greenGhost.style.top = ggY + GHOST_SPEED + 'px';
        }
        else if(ggNewDirection == 'up') {
            if(ggY < -30) ggY = 390;
            greenGhost.style.top = ggY - GHOST_SPEED + 'px';
        }
    
    } while(hitWall(greenGhost));    
    
    ggDirection = ggNewDirection;
}

function moveBlueGhost() {
    // Move Blue Ghost
    // Assumption that there are no dead ends in the maze
    // Rules: never go in the opposite direction
    // Randomly choose a sirection every move (excluding the opposite direction)
    var bgX = parseInt(blueGhost.style.left);
    var bgY = parseInt(blueGhost.style.top);
    
    var bgNewDirection;
    
    var bgOppositeDirection;
    if(bgDirection == 'left') bgOppositeDirection = 'right';
    else if(bgDirection == 'right') bgOppositeDirection = 'left';
    else if(bgDirection == 'down') bgOppositeDirection = 'up';
    else if(bgDirection == 'up') bgOppositeDirection = 'down';
    
    do { 
        blueGhost.style.left = bgX + 'px';
        blueGhost.style.top = bgY + 'px';
        
        do {
            var r = Math.floor(Math.random()*4);
            if(r == 0) bgNewDirection = 'right';
            else if(r == 1) bgNewDirection = 'left';
            else if(r == 2) bgNewDirection = 'down';
            else if(r == 3) bgNewDirection = 'up';
        } while(bgNewDirection == bgOppositeDirection);
        
        if(bgNewDirection == 'right') {
            if(bgX > 590)bgX = -30;
            blueGhost.style.left = bgX + GHOST_SPEED + 'px';
        }
        else if(bgNewDirection == 'left') {
            if(bgX < -30) bgX = 590;
            blueGhost.style.left = bgX - GHOST_SPEED + 'px';
        }
        else if(bgNewDirection == 'down') {
            if(bgY > 390) bgY = -30;
            blueGhost.style.top = bgY + GHOST_SPEED + 'px';
        }
        else if(bgNewDirection == 'up') {
            if(bgY < -30) bgY = 390;
            blueGhost.style.top = bgY - GHOST_SPEED + 'px';
        }
    
    } while(hitWall(blueGhost));    
    
    bgDirection = bgNewDirection;
}