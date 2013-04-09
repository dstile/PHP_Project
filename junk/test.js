
var topicnumber=8;



function randtopic()
{
var topicorder = new Array(topicnumber);
var topicindex = 0;//Used to make sure all topics have been defined in sequence
var topicorder = new Array(topicnumber);
var random; //Will always be a random value between 0 and topicnumber
var randomfactor = 10;//if topic number exceeds 10 ever this factor needs to change
var topiccounter;//Used to check that each value is unique for each iterration

while(topicindex < topicnumber)
	{
	random = Math.floor((Math.random()*randomfactor)*(topicnumber/randomfactor));//Need to confirm that math.random generates two competes different numbers in this case
	topiccounter = 0;
	
	while(topiccounter < topicnumber)
		{
	
		if(topicorder[topiccounter] == random)
			{
			random = Math.floor((Math.random()*randomfactor)*(topicnumber/randomfactor));//resets random and goes through for loop again with a topiccounter reset to 0
			topiccounter = 0;
			}
		else
			{
			
			topiccounter++;
			}		
		}	
		
	topicorder[topicindex] = random;
	topicindex++;
	}

	return(topicorder);
}


function gen_all_boxes(topicnumber){

var topicgen_all = randtopic();
var topicgen_right = new Array(topicnumber/2); 
var topicgen_left = new Array(topicnumber/2);

for (i=0; i<(Math.round((topicgen_all.length/2))-1); i++)
{
topicgen_right[i]=topicgen_all[i];
topicgen_left[i]=topicgen_all[(topicgen_all.length/2) + i];
}

for(i=0;i<=((Math.round(topicnumber/2))-1);i++)
{

gen_highlight_box('highlight-right', topicgen_right[i]); 
gen_highlight_box('highlight-left', topicgen_left[i]);
}





function gen_highlight_box(divName, toparrayvalue){
	var topsum = document.getElementById('topic-sum');
	var divNew1 = document.createElement('div');
	var divNew2 = document.createElement('div');
	var divNew3 = document.createElement('div');
	var divNew4 = document.createElement('div');
	var divNew5 = document.createElement('div');
	var divNew6 = document.createElement('div');

	
	
	
	divNew1.className = divName;
	topsum.appendChild(divNew1);
	
	
		divNew2.className = 'layer1';//DivNew2-5 adds the three layers to the newly created highlight class (box).  
		divNew2.innerHTML = 'test2';
		divNew1.appendChild (divNew2);
		
		divNew3.className = 'layer2';
		divNew3.innerHTML = 'test2';
		divNew1.appendChild (divNew3);
		
		divNew4.className = 'layer3';
		divNew4.innerHTML = 'test4';
		divNew1.appendChild (divNew4);
		
			divNew5.className = 'topic-type';
			divNew5.innerHTML = '<?php
								include("dbinfo.inc.php");
								$result=mysql_query("SELECT topic FROM topics WHERE id ="'.toparrayvalue.');
								$myrow = mysql_fetch_array($result);
								echo $myrow["topic"]."<br />";
								mysql_free_result($result);
								mysql_close()
							?>' 
			
			//'WRITING';
			divNew4.appendChild (divNew5);
			
			divNew6.className = 'product-info';
			divNew6.innerHTML = '<?php
								include("dbinfo.inc.php");
								$result=mysql_query("SELECT id, title, artist, description, productpic FROM Projects");
								$myrow = mysql_fetch_array($result);
								echo "<b>Title: </b>".$myrow["title"]."<br />";
								echo "<b>Artist: </b>".$myrow["artist"]."<br />";
								echo '<img src= "'.$myrow["productpic"].'" class="project-pic" alt="Project Picture"/>';
								echo "<br><h3>Description: </h3> ".$myrow["description"];
								mysql_free_result($result);
								mysql_close()
							?>'
			divNew4.appendChild (divNew6);				
	}
</script>