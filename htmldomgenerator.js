/*PROJECT HIGHLIGHT GENERATOR
/*Generates all of the highlight boxes and pulls information based on mySQL returns via PHP functions*/
		//loops the printing of the html according to the number of topics
		function gen_all_boxes(totalboxes, topicgen_all, topicnameArrayjs, projinfoArrayjs, artistpicArrayjs)
			{
			
			var topicgen_right = new Array(totalboxes/2); 
			var topicgen_left = new Array(totalboxes/2);	

			//Calls gen_highlight_box function that generates all of the classes for each highlight box
			i=0;	
			while(i<(Math.round(totalboxes)))
				{
				gen_highlight_box('highlight-right'); 
				i++;
				gen_highlight_box('highlight-left');
				i++;
				}	
				
			
			/*calls the topicreturn for each highlight box to return topic type for each*/
			/*also call projcontentgen and attaches it to each box*/
			j=0;
			while(j<(Math.round(totalboxes)))	
				{	
				projcontentgen(j, topicnameArrayjs[topicgen_all[j]], projinfoArrayjs[topicgen_all[j]], artistpicArrayjs[topicgen_all[j]]);
				j++;
				}
			}
		
		
		//Creates the structure in the DOM for the content to be placed for each box
		function gen_highlight_box(divName)
			{
			var topsum = document.getElementById('topic-sum');
			var divNew1 = document.createElement('div');
			//class = Profile picture
			var divNew2 = document.createElement('div');
			//class = layer2 (Text Box)
			var divNew3 = document.createElement('div');
			//class = layer3 (Project Content)
			var divNew4 = document.createElement('div');
			var projtypetag = document.createElement('ProjTitle');
			var contenttag = document.createElement('ProjContent');
			var artistpic = document.createElement('ArtistPic');
			var textbox = document.createElement('img');
			
			
			divNew1.className = divName;
			divNew1.innerHTML = '';
			topsum.appendChild(divNew1);
			
			<!--Profile Imge-->
			divNew2.className = 'layer1';
			divNew1.appendChild (divNew2);
			//adding artistpic tag allows us to attach the picture from dB later using DOM
			divNew2.appendChild (artistpic);

			<!-- Text Box Image Layer -->	
			divNew3.className = 'layer2';
			divNew1.appendChild (divNew3);
			textbox.src = 'images/pics/text-box.png';
			textbox.alt  = 'standard text box';
			divNew3.appendChild (textbox);
				
			
			<!--Project Content-->
			divNew4.className = 'layer3';
			divNew4.innerHTML = '';
			divNew1.appendChild (divNew4);	
			
				projtypetag.className = 'topic-type';
				divNew4.appendChild (projtypetag);
					
				contenttag.className = 'product-info';
				divNew4.appendChild (contenttag);		
			
			}
		
		//Converts project information to HTML for posting on site for each text box
		function projcontentgen(box, topictitle, projinfo, artistpic)
			{
			//Topic insertion for each box
			x=document.getElementById("topic-sum").getElementsByTagName("ProjTitle");//getElemetsByClassName does not work in IE.  Need a workaround
			x[box].innerHTML="<b>"+topictitle+"</b><br />";
			//project details insertion for each box
			x=document.getElementById("topic-sum").getElementsByTagName("ProjContent");
			x[box].innerHTML=projinfo;
			
			//Artist Picture insertion for each box
			x=document.getElementById("topic-sum").getElementsByTagName("ArtistPic");
			x[box].innerHTML=artistpic;
			}		