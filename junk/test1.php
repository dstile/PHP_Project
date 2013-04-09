<!--Dynamic_generator-->


<!--DOCTYPE html PUBLIC "-//STILELOG HOMEPAGE-->
	
<html>
<head>
    <meta http-equiv="Content-type" content="text/html; charset=UTF-8" />
    <title>StileLog Home</title>
    <meta http-equiv="Content-Language" content="en-us" />

    <meta http-equiv="imagetoolbar" content="no" />
    <meta name="MSSmartTagsPreventParsing" content="true" />
     
    <meta name="description" content="Description" />
    <meta name="keywords" content="Keywords" />
     
    <meta name="David Stile" content="StileLog" />
     
    <style type="text/css" media="all">@import "css/master.css";</style>  

	<script type="text/javascript" src="jquery.js" src="functions.js"></script>
	<!--Functions

		<script type="text/javascript" src="script.js"></script>

	//-->
<script type="text/javascript">



function gen_all_boxes(totalboxes)
{
var topicgen_all = new Array();
var topicgen_all = randtopic(topicnumber);
var topicgen_right = new Array(totalboxes/2); 
var topicgen_left = new Array(totalboxes/2);


i=0;	
while(i<(Math.round(totalboxes)))
	{
	gen_highlight_box('highlight-right'); 
	i++;
	gen_highlight_box('highlight-left');
	i++;
	}	
j=0;	


while(j<(Math.round(totalboxes)))	
{	
topicreturn(j, topicgen_all[j]);
j++;	
}
}
function topicreturn(box, str)//passes in topic_database_index and returns topic name from database
{
	var xmlhttp;
	var url="topicgenajax.php";
	var params = "t="+str;
	
	
	if (window.XMLHttpRequest)
		{// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp=new XMLHttpRequest();
		}
		else
		{// code for IE6, IE5
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		}
	
	xmlhttp.onreadystatechange=function()
	{
		if (xmlhttp.readyState==4 && xmlhttp.status==200)
		{
		//  need to add this back in once connection works
		x=document.getElementById("topic-sum").getElementsByClassName('topic-type');
		x[box].innerHTML=xmlhttp.responseText;
		}
	}
	xmlhttp.open("POST",url,true);
	xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xmlhttp.setRequestHeader("Content-length", params.length);
	xmlhttp.setRequestHeader("Connection", "close");
	xmlhttp.send(params);
}





function gen_highlight_box(divName)
{
	var topsum = document.getElementById('topic-sum');
	var divNew1 = document.createElement('div');
	var divNew2 = document.createElement('div');
	var divNew3 = document.createElement('div');
	var divNew4 = document.createElement('div');
	var divNew5 = document.createElement('div');
	var divNew6 = document.createElement('div');
	
	
	divNew1.className = divName;
	divNew1.innerHTML = 'test1';
	topsum.appendChild(divNew1);
	
	divNew2.className = 'layer1';
	divNew2.innerHTML = 'test2';
	divNew1.appendChild (divNew2);
		
	divNew3.className = 'layer2';
	divNew3.innerHTML = 'test2';
	divNew1.appendChild (divNew3);
		
	divNew4.className = 'layer3';
	divNew4.innerHTML = 'test4';
	divNew1.appendChild (divNew4);	
	
		divNew5.className = 'topic-type';
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
							?>';
		divNew4.appendChild (divNew6);		
	
}
	
function randtopic(amount)
{
var topicorder = new Array(amount);
var topicindex = 0;//Used to make sure all topics have been defined in sequence
var random; //Will always be a random value between 0 and topicnumber
var randomfactor = 10;//if topic number exceeds 10 ever this factor needs to change
var topiccounter;//Used to check that each value is unique for each iterration

while(topicindex < amount)
	{
	random = Math.floor((Math.random()*randomfactor)*(amount/randomfactor));//Need to confirm that math.random generates two competes different numbers in this case
	topiccounter = 0;
	
	while(topiccounter < amount)
		{
		if(topicorder[topiccounter] == random)
			{
			random = Math.floor((Math.random()*randomfactor)*(amount/randomfactor));//resets random and goes through for loop again with a topiccounter reset to 0
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
	
	
	
</script>
</head>

<body>
<div id = "topic-sum">
</div>
<script type="text/javascript">
document.show(gen_all_boxes(topicnumber));
</script>


</body>
</html>