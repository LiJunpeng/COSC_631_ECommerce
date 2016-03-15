


<html>
	<head>
		<title>Ex</title>
     <script type="text/javascript" src="../../js/jquery-2.1.4.min.js"></script>
		   <style type="text/css">
                   #car {
                       width:40px;
                       height:70px;
                       background:red;
                       top:680;
                       left:510;
                       position:absolute;
                       z-index:1;
                   }

                   #line1,#line2,#line3,#line4,#line5 {
                       width:20px;
                       height:70px;
                       background:white;
                       top:20;
                       left:475;
                       position:absolute;
                   }      

                   #line1{
                       top:20;
                   }  

                   #line2 {
                       top:160;
                   }  

                  #line3 {
                       top:300;
                   }  

                   #line4{
                      top:440;
                   }  

                   #line5 {
                      top:580;
                  }              


		   </style>

   <script language="javascript">


<?php
  session_start(); $name = $_SESSION["user_id"]; echo "var username="."'$name'";
?>


var tank_height = 170;
var tank_width = 70;
var car_height = 70;
var car_width = 40;


var num = 20;

var time_Counter = 0;
var element = 0;
var line = 0;

var score = 0;
var win = false;


function run_Star(){

   time_Counter++;

   if(time_Counter == 200)  {createElement("star" , element); element++ ; time_Counter = 0; score += 10;}

   for(var i = 0 ; i < element ; i++)
   {


    var star = document.getElementById("star" + i);
    var car = document.getElementById("car");

    if(star != null)
    {
      if(star.offsetTop >= 620) 
      {
         star.style.opacity = 0;
         star.remove();
       }
      else 
      {
         star.style.top= (star.offsetTop + 2); 
  

        var tank_left = star.offsetLeft; var tank_right = star.offsetLeft + tank_width;
        var tank_head = star.offsetTop + 70; var tank_tail = star.offsetTop + tank_height;

        var car_left = car.offsetLeft; var car_right = car.offsetLeft + car_width;
        var car_head = car.offsetTop; var car_tail = car.offsetTop + car_height;


        if( (((car_left <= tank_right) && (car_left >= tank_left)) || ((car_right >= tank_left)&&(car_right <= tank_right))) && (((car_head >= tank_head)&&( car_head <= tank_tail))||((car_tail >= tank_head)&&(car_tail<=tank_tail)))) 
        {
           star.style.background="red";
           if(score < 100) {
            win = false;
           }
           else{
            win = true;
           }

           if(!win)
           {
            alert("Win! " + username + "! Your score is " + score);
            //window.location.href = "../../bin/win.php?data="+username+"_" + score;
            }
            else{
              alert("Lose! " + username + "! Your score is " + score);
            }




           //window.location.href = "../../GameMenu.php";
        }
      }
    }

   } 

   for(var j = 1 ; j <= 5 ; j++)
   {
      var line_n = document.getElementById("line" + j);
      if(line_n.offsetTop >= 700) 
         line_n.style.top = 0;
      else 
         line_n.style.top= (line_n.offsetTop + 10); 
   }


   setTimeout(run_Star,10);
}


function make_Star() {

run_Star();
}

function createElement(name ,index){ 
var createDiv = document.createElement("div"); 
createDiv.id = name + index;
createDiv.style.position="absolute"; 
createDiv.style.background="black";  
createDiv.style.width=tank_width;  
createDiv.style.height= tank_height; 
createDiv.style.left=300 * Math.random() + 310;   
createDiv.style.top=-170;  
createDiv.innerHTML="<img src='tank2.jpg'  width='70' height='170'>"; 

 
document.body.appendChild(createDiv);  
}




		document.onkeydown = function moveIt(evt) {
			evt = evt || document.event 
			//alert("hi -> " + evt.keyCode);
			
			switch(evt.keyCode) {
				case 38: posDiv(0,-10); break; 
				case 40: posDiv(0,10); break; 
				case 37: posDiv(-10,0); break; 
				case 39: posDiv(10,0); break; 
			}
		}

		function posDiv(dx, dy) {
			var dv = document.getElementById("car");
			// http://help.dottoro.com/ljuxqbfx.php
			var h = dv.offsetHeight; // offsetHeight -- height and border 
			var w = dv.offsetWidth; // offsetWidth -- width and border

			// dv.style.top is undefined since there is no 'top:' in CSS
			// has to use offsetTop
			var top = dv.offsetTop;
			var left = dv.offsetLeft;

			// skip --> you fill them later --> make sure that the div is within the window
			left += dx;	
			top += dy;
			dv.style.left = left + "px";
			dv.style.top = top + "px";
		}


		</script>
	</head>
<body onload="make_Star()" background="road.jpg" >

<div id="car"><img src='car.jpg' width='40' height='70'></div>


<div id="line1"></div>
<div id="line2"></div>
<div id="line3"></div>
<div id="line4"></div>
<div id="line5"></div>

</body>
</html>