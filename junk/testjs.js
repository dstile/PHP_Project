var topicnumber = 8;//the evaluation below is anything less than 8 and zero counts so it iterrates 8 times as desired
var topicorder = new Array(topicnumber);



//Function for creating an array with a random sequence of unique Topic Indexes

function randtopic()
{
var topicindex = 0;//Used to make sure all topics have been defined in sequence
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
	document.write(topicorder[topicindex]);
	topicindex++;
	}
}


//Function for Generating the Highlight Boxes

function GenerateHighlightBox()
{

for(i=0;i<=((Math.round(topicnumber/2))-1);i++)
{





}



<div class="highlight-right">
				
					<div class="layer1"> <!--user photo-->
						<img src="images/pics/photo-2.jpg" alt="Profile Pic" />
					</div>
					
					<div class="layer2"><!--background text box-->
						<img src="images/pics/text-box.jpg" alt="Standard Text Box" />
					</div>
					
					<div class="layer3"><!--project Content-->
							<div class="topic-type">
							<h2>Writing</h2>
							</div>
						
							<div class="product-info">
						
							<?php
								include("dbinfo.inc.php");
								$result=mysql_query("SELECT id, title, artist, description, productpic FROM Projects");
								$myrow = mysql_fetch_array($result);
								echo "<b>Title: </b>".$myrow["title"]."<br />";
								echo "<b>Artist: </b>".$myrow["artist"]."<br />";
								echo '<img src= "'.$myrow["productpic"].'" class="project-pic" alt="Project Picture"/>';
								echo "<br><h3>Description: </h3> ".$myrow["description"];
								mysql_free_result($result);
								mysql_close()
							?>
							</div>
							
							
					</div>
				
				
				</div>
				
				<div class="highlight-left">
					
					<div class="layer1"> 
						<img src="images/pics/photo-1.jpg" alt="Profile Pic" />
					</div>
					
					<div class="layer2">
						<img src="images/pics/text-box.jpg" alt="Standard Text Box" />
					</div>
					
					<div class="layer3">
						<div class="topic-type">
							<h2>Craft</h2>
						</div>
						
						<div class="product-info">
						
						<?php
							include("dbinfo.inc.php");
							$result=mysql_query("SELECT id, title, artist, description, productpic FROM Projects");
							$myrow = mysql_fetch_array($result);
							echo "<b>Title: </b>".$myrow["title"]."<br />";
							echo "<b>Artist: </b>".$myrow["artist"]."<br />";
							echo '<img src= "'.$myrow["productpic"].'" class="project-pic" alt="Project Picture"/>';
							echo "<br><h3>Description: </h3> ".$myrow["description"];
			
							
							/*The section below creates a loop that outputs all of specific columns designated for the all of the rows(Tested and Functional)*/
							
							/*
							while ($row = mysql_fetch_array($result,MYSQL_ASSOC)) {
							printf ("ID: %s Title: %s Artist: %s Description: %s", $row[id], $row[title], $row[artist], $row[description]);
							}
							
							*/
						
						
							mysql_free_result($result);
							mysql_close()
							?>
							
							<!--$i=0;
							while ($i<1){
								$title=mysql_result($result,$i,"title");
								$artist=mysql_result($result,$i,"artist");
								$description=mysql_result($result,$i,"description");
								$product_picture=mysql_result($result,$i,"product_picture");
							}
							?>
						
						
							<body><?php/* echo $description; */?></body>-->
						<?php
							/*$i++;
							}
								mysql_close();*/
							?>
						
						</div>
						
					</div>
				
				
				</div>	





}





