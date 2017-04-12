<!DOCTYPE HTML>
<!--Hans Montero-->
<html>
	<head>
		<title>BTHS National Honor Society</title>
		<link rel="stylesheet" href="style.css">
		<?php
			$conn = new PDO("mysql:hostname=localhost;dbname=nhs", "root", "");
			session_start();
			$errorLogin = false;

			if(isset($_POST['logout'])){
				session_unset(); 
				session_destroy(); 
			}

			if(isset($_POST['uname'])){
				$inputUser = $_POST['uname'];
				$inputPass = $_POST['pword'];
				$dataResult = $conn->prepare("SELECT * FROM `accounts` WHERE `username` = '{$inputUser}'");
				$dataResult->execute();
				$user = $dataResult->fetch(PDO::FETCH_ASSOC);

				if($dataResult->rowCount() == 0 || $user['password'] != $inputPass){
					$errorLogin = true;
				}
				else{
					$_SESSION['name']=$user['username'];
					$_SESSION['sig'] = $user['signature'];
					$_SESSION['code']=$user['access'];
				}
				
			}
			if(!isset($_GET['c']) || $_GET['c']>12 || $_GET['c']<0 || !is_numeric($_GET['c'])){
				$_GET['c'] = 0;
			}
			$cIndex = $_GET['c'];

			$annArr = $conn->prepare("SELECT * FROM `posts` WHERE `committee` = {$cIndex}");
			$annArr->execute();

			$memArr = $conn->prepare("SELECT * FROM `cpoints` WHERE `committee` = {$cIndex}");
			$memArr->execute();
		?>
		<style>

			.bcontainer{
			
			}
			.submenu{
				background-color: grey;
				width:900px;
				height:50px;
				position: relative;
				top:-5px;
				text-align: center;
			}
			.subopt{
				display: inline-block;
				margin-left:10px;
				margin-right:10px;
				margin-top: 2px;
				cursor:pointer;
			}
			.cname{
				margin-top: 5px;
				font-size:20pt;
				font-weight: bold;		
				text-align: center;
			}
			.comcon{
				padding:20px;
			}
			.cinfo{
				display: inline-block;
				font-size: 13.5pt;
				padding-bottom: 20px;
				border-bottom:2px solid grey;
			}
			.cannc{
				left:0px;
				font-size:16pt;
				text-align: center;
				width:350px;
				border-right:2px solid grey;
				display: inline-block;
				position: relative;
				padding-right:20px;
				top:-18px;
				margin-top:25px;

			}
			.coln1,.coln2{
				font-size: 18pt;
				font-weight: bold;
			}
			.coln1{
				position: relative;
				left:20px;
			}
			.cann{
				display: inline-block;
				border-radius:20px;
				height:480px;
				width:320px;
				position: relative;
				top:0px;
				left:20px;
				padding:10px;
				font-weight: normal;
				overflow: auto;
			}
			.calcon{
				display: inline-block;
				width:490px;
				height:540px;
				position: relative;
				text-align: center;
				padding-top:5px;
				top:-8px;
				left:10px;
			}
			.cal{
				width: 500px;
				height: 510px;
				border: none;
				
			}
			.con2{
				position: relative;
				width:898px;
				top:-15px;
				border-bottom: 2px solid grey;
			}
			.title{
				font-size:15pt;
				margin:0px;
				padding:0px;
				text-decoration: underline;
			}
			.date{
				font-size:11pt;
			}
			.atext{
				font-size:13pt;	
				text-align: left;		
			}
			.author{
				font-size:12pt;
				margin-top: 5px;
				font-style: italic;
			}
			.ann{
				border-bottom:2px solid navy;
			}
			.lbut{
				float:right;
				padding:1px;
			}
			.log{
				background-color: grey;
				width:897px;
				height:43px;
				z-index: 10;
				padding:2px;
				<?php
					if($errorLogin){
						echo "display: block;";
					}
					else{
						echo "display: none;";
					}
				?>
			}
			form{
				display: inline;
			}
			.postb{
				position: absolute;
				left:380px;
				height:500px;
				width:500px;
				z-index: 10;
				background-color: grey;
				border:2px solid black;
				border-radius:20px;
				padding:5px;
				text-align: left;
			}
			.editp{
				height:400px;
				width:850px;
				background-color: lightgrey;
				margin-left:auto;
				margin-right: auto;
				border:2px solid black;
				position: relative;
				display: none;
				z-index: 5;
				
				
			}
			.fcon{
				padding-top: 50px;
			}
			.log{
				margin-top:-40px;
			}
			table{
				margin: auto;
				border-spacing: 0;
			}
			td{
				width:20%;
				padding:5px;
				border:2px solid darkgrey;

			}
			.hc{
				text-align: center;
				border-bottom:2px solid darkgrey;
				font-weight: bold;
			}
			.tcon{
				height:360px;
				overflow: auto;
			}
			.rc{
				width:400px;
				height:160px;
				overflow: auto;
				display: inline-block;
				margin-left:5px;
				border-right:2px solid darkgrey;
				padding-right:19px;
				
			}
			.toadd{
				display: inline-block;
				float: right;
				width:400px;
				text-align: center;
				height:180px;
				overflow: auto;
			}
			.searchr{
				border-bottom:2px solid darkgrey;
				padding:5px;
				text-align: left;
				margin-right:5px;
			}
			.searchr:hover{
				background-color: grey;
				cursor:pointer;
			}
			.meth2{
				display: inline-block;
				width:100%;
			}
			label{
				display: block;
			}
			.mopts{
				display: inline-block;
				margin:auto;
				width:418px;
				text-align: center;
				color:black;
				background-color: gold;
				cursor: pointer;
				padding:3px;
				height:20px;
			}
			.mopts:hover{
				background-color: goldenrod;
			}
			hr{
				margin-top: 0;
			}
			.ubut{
				margin-left:5px;
				margin-top: 10px;

			}
			.closemod{
				position: absolute;
				z-index:5;
				right:5px;
			}
			.openmod{
				position: absolute;
				bottom:4px;
				right:30px;
			}
			.psearch{
				width:850px;
				
				margin:auto;
				text-align: center;
			}
			.scon{
				margin-top:-5px;
			}
		</style>
		<script>
			function initialize(){
				comName = document.getElementById("cname");
				comChair = document.getElementById("chair");
				comDesc = document.getElementById("cdesc");
				comAnnBox = document.getElementById("abox");
				comCalBox = document.getElementById("cal");

				subMenu = document.getElementById("smenu");
				subOptArr = subMenu.getElementsByTagName("div");

				logInPrompt = document.getElementById("lprompt");

				pointSearchBox = document.getElementById('ps');

				annoucementContainer = document.getElementById("abox");
				<?php
					if(isset($_SESSION['code']) && $_SESSION['code']==13 || isset($_SESSION['code']) &&  $_SESSION['code']== $_GET['c']){
						echo"annTitle = document.getElementById('title');
						annDate = document.getElementById('date');
						annText = document.getElementById('ann');";
					}
					
				?>
				
				annArr = eval(<?php echo json_encode($annArr->fetchAll(PDO::FETCH_ASSOC)); ?>);

				<?php
					if(isset($_SESSION['code']) && $_SESSION['code']==13 || isset($_SESSION['code']) &&  $_SESSION['code']== $_GET['c']){
						echo"memArr = eval(".json_encode($memArr->fetchAll(PDO::FETCH_ASSOC)).");
						memTable = document.getElementById('memt');
						memTableContainer = document.getElementById('allm');
						configurePointsContainer = document.getElementById('confp');
						loading1 = document.getElementById('l1');
						loading2 = document.getElementById('l2');
						searchResultsCon = document.getElementById('resultsCon');
						selectedMembersCon = document.getElementById('toa');
						pointModification = document.getElementById('pmod');
						osStringIn = document.getElementById('os');
						osStringBox = document.getElementById('osbox');
						osMethodCheck = document.getElementById('om');
						meth2Box = document.getElementById('m2');
						nameBox = document.getElementById('nb');
						manageBox = document.getElementById('manmem');
						parOsisArr=[];
						for(var o=0;o<memArr.length;o++){
							parOsisArr.push(memArr[o].osis);
						}
						toUpdateArr=[];
						constructMemberTable(false);";
					}
				?>

				contentArr=[
					['Academic Recognition','Tanzina Islam - <i>tislam4599@bths.edu</i>','The Academic Recognition committee serves to recognize and reward the individuals who go above and beyond in their studies at Tech. We work on several projects throughout the school year in order to meet this goal, such as updating the honor roll board and recognizing former NHS members on special occasions such as Alumni Homecoming.','<iframe class="cal"src="https://calendar.google.com/calendar/embed?showTitle=0&amp;showPrint=0&amp;showTabs=0&amp;showCalendars=0&amp;showTz=0&amp;height=600&amp;wkst=1&amp;bgcolor=%23FFFFFF&amp;src=3bjmnjo2rt0vjl61g2i1tfjdpo%40group.calendar.google.com&amp;color=%236B3304&amp;ctz=America%2FNew_York"></iframe>'],
					['Alumni Services','Tiffany Voon - <i>tvoon1410@bths.edu</i>','The Brooklyn Tech Alumni Foundation plays a tremendous role shaping in the Tech environment. The staff of the alumni office, located on the first floor, organizes events like Career Day and Homecoming. NHS members in the Alumni Committee will help the Alumni Foundation by dropping by the office during their lunch periods once or twice a week. Many times the staff at the office will not need help, in which case NHS members can go back to lunch. The Alumni Foundation impacts our lives both in Tech and beyond, and joining the Alumni Committee is a great way to become familiar with the organization and the amazing people behind it. It also exposes current Tech students to an incredible array of past graduates.','<iframe class="cal"src="https://calendar.google.com/calendar/embed?showTitle=0&amp;showPrint=0&amp;showTabs=0&amp;showCalendars=0&amp;showTz=0&amp;height=600&amp;wkst=1&amp;bgcolor=%23FFFFFF&amp;src=lq5fkhtcqd4ile0qp8kq8gkads%40group.calendar.google.com&amp;color=%23691426&amp;ctz=America%2FNew_York"></iframe>'],
					['Club Team Council','Laura Chen - <i>lchen1733@bths.edu</i>',"Club Team Council tracks clubs' attendances, evaluates clubs' performances, and helps out with club related events. Members would use either an online or physical copy of the rubric, which asks for attendance, productivity, and advisor's signature. These would be collected during monthly meetings. CTC helps the Student Government to monitor the activities and attendance of clubs and teams.",'<iframe class="cal" src="https://calendar.google.com/calendar/embed?showTitle=0&amp;showPrint=0&amp;showTabs=0&amp;showCalendars=0&amp;showTz=0&amp;height=600&amp;wkst=1&amp;bgcolor=%23FFFFFF&amp;src=3hmd2h4otg6vfu1eq83fdteoqo%40group.calendar.google.com&amp;color=%23711616&amp;ctz=America%2FNew_York"></iframe>'],
					['College Services','Joey Jiemjitpolchai - <i>jjiemjitpolchai9540@bths.edu</i>','The College Services committee is responsible for helping the entire senior class with their college process. The committee works mostly during their lunch periods at either the guidance office or college office. This year, to be a member of this committee, you are required to have either a lunch period or a free period (9th period is acceptable). You will be working 3 times a week. The committee also holds major events such as College Information Night, Financial Aid Night, and the BTHS College Fair. By working in the college office, you will be well informed of the college process.','<iframe class="cal"src="https://calendar.google.com/calendar/embed?showTitle=0&amp;showPrint=0&amp;showTabs=0&amp;showCalendars=0&amp;showTz=0&amp;height=600&amp;wkst=1&amp;bgcolor=%23FFFFFF&amp;src=g4kk1k24367692mclv7s53vml0%40group.calendar.google.com&amp;color=%23B1440E&amp;ctz=America%2FNew_York"></iframe>'],
					['Community Services','Michelle Wong - <i>mwong9708@bths.edu</i>','The Community Service Committee provides service opportunities throughout New York City. We participate in various community service events including: park-clean ups, neighborhood restorations, and charity walks. The committee will be collaborating with other community service organizations throughout the upcoming year.','<iframe class="cal" src="https://calendar.google.com/calendar/embed?showTitle=0&amp;showPrint=0&amp;showTabs=0&amp;showCalendars=0&amp;showTz=0&amp;height=600&amp;wkst=1&amp;bgcolor=%23FFFFFF&amp;src=qgrm3ron2h5f3bdklptqjjifa8%40group.calendar.google.com&amp;color=%23B1440E&amp;ctz=America%2FNew_York" style="border-width:0"></iframe>'],
					['Fundraising','Nabila Basar - <i>nbasar3600@bths.edu</i>','The Fundraising committee raises money for the NHS so that we can have amazing events which include induction and any other new events that we can think of. The members of the fundraising committee must be charismatic and friendly when selling items to people from the school. Joining the fundraising committee will teach you how to speak elegantly like a salesperson. Members will have to sell during selected lunch periods, after school and during special weekend events.','<iframe class="cal" src="https://calendar.google.com/calendar/embed?showTitle=0&amp;showPrint=0&amp;showTabs=0&amp;showCalendars=0&amp;showTz=0&amp;height=600&amp;wkst=1&amp;bgcolor=%23FFFFFF&amp;src=jei6oo5g9lpmvsg01kd8ts4gak%40group.calendar.google.com&amp;color=%23853104&amp;ctz=America%2FNew_York"></iframe>'],
					['Induction','Mei Lin Zheng - <i>mzheng7988@bths.edu</i>',"The Induction Committee is in charge of two prominent events: the Fall Induction Ceremony and the Spring Installation Dinner. The Fall Induction takes place in late November, when we welcome and introduce our new members to NHS. The Spring Installation Dinner takes places in early June, when we celebrate the end of another year and welcome the new Executive Board. Unlike that of other committees, most of the Induction Committee's work will be concentrated at the beginning and towards the end of the school year. As members of this committee, we are all expected to come and help plan these two events.",'<iframe class="cal" src="https://calendar.google.com/calendar/embed?showTitle=0&amp;showPrint=0&amp;showTabs=0&amp;showCalendars=0&amp;showTz=0&amp;height=600&amp;wkst=1&amp;bgcolor=%23FFFFFF&amp;src=bk5tbl31eu8q2ktrv91v98i92k%40group.calendar.google.com&amp;color=%238C500B&amp;ctz=America%2FNew_York"></iframe>'],
					['Mentoring','Ekok Soubir & Carmen Chen - <i>esoubir6205@bths.edu & cchen5239@bths.edu</i>','The Mentoring committee provides mentors to incoming freshman students. With the launch of Brooklyn Tech Big Sibs, this committee will guide freshman and sophomore students and provide advice.','<iframe class="cal" src="https://calendar.google.com/calendar/embed?showTitle=0&amp;showPrint=0&amp;showTabs=0&amp;showCalendars=0&amp;showTz=0&amp;height=600&amp;wkst=1&amp;bgcolor=%23FFFFFF&amp;src=j129cnc6ndskvrgapui85g11oc%40group.calendar.google.com&amp;color=%230F4B38&amp;ctz=America%2FNew_York"></iframe>'],
					['Parent Services','Nour Haredy - <i>nharedy9977@bths.edu</i>',"The Committee of Parent Services deals with all events held in Brooklyn Tech in which parents are involved (hence the name). Members of this committee will help in monthly PTA meetings or will put in weekly hours at the Parent Services Office helping whoever will be next year's parent coordinator. Furthermore there will be NHS events that involve parents, namely parent teacher conferences, in which this committee will also be involved. If you're good at communicating with people, or want a career in service, this may be good training. Also you're encouraged to join this committee if you know a second language. Parents sometimes need translating which is one of the main services we provide in this committee. As of this year, the committee might be getting involved in more events such as the PTA auctions.If you have fresh ideas for how to run events, they will be heard.",'<iframe class="cal" src="https://calendar.google.com/calendar/embed?showTitle=0&amp;showPrint=0&amp;showTabs=0&amp;showCalendars=0&amp;showTz=0&amp;height=600&amp;wkst=1&amp;bgcolor=%23FFFFFF&amp;src=lvk6ftqt959pkhklacdinkmtpk%40group.calendar.google.com&amp;color=%23125A12&amp;ctz=America%2FNew_York"></iframe>'],
					['Recycling','Doruntina Fida - <i>dfida6514@bths.edu</i>','Our goal is not only to promote recycling but a general environmental awareness within the school as well. Committee chairperson should work with janitors and advisors to ensure all recycling bins are in each classroom. There shall be a day when differentiating the blue, green, and black bins become second nature. Committee chairperson must also keep an outlook to volunteer in any park clean-up or outside environmental events.','<iframe class="cal" src="https://calendar.google.com/calendar/embed?showTitle=0&amp;showPrint=0&amp;showTabs=0&amp;showCalendars=0&amp;showTz=0&amp;height=600&amp;wkst=1&amp;bgcolor=%23FFFFFF&amp;src=eoj9mojsf1150cq2soub2j1te0%40group.calendar.google.com&amp;color=%232F6309&amp;ctz=America%2FNew_York"></iframe>'],
					['School Environment','Vivian Su - <i>vsu0170@bths.edu</i>','The School Environment committee is in charge of keeping all the bulletin boards updated and organized. In addition, members of this committee will be asked to design posters and signs for school events. Each member will be assigned to tour the school and observe for any changes that need updating during 10th period. The Tours committee will work alongside with this committee with touring the school. The ultimate goal of this committee is to make Tech a more home-like place where students and faculty members can enjoy themselves while also being kept informed about any changes within the school environment','<iframe class="cal" src="https://calendar.google.com/calendar/embed?showTitle=0&amp;showPrint=0&amp;showTabs=0&amp;showCalendars=0&amp;showTz=0&amp;height=600&amp;wkst=1&amp;bgcolor=%23FFFFFF&amp;src=68q5jpqfcvmpfhuc949d8odtjs%40group.calendar.google.com&amp;color=%2329527A&amp;ctz=America%2FNew_York"></iframe>'],
					['Tours','Helal Chowdhury - <i>hchowdhury3273@bths.edu</i>',"As part of the Tours Committee, you will assist Mr. Kaelin and the Tours and Parents services advisers both during and after school hours. You will be guiding incoming freshman, parents, and other students throughout the school, informing each person of our school's significant aspects and details that make our school stand out.",'<iframe class="cal" src="https://calendar.google.com/calendar/embed?showTitle=0&amp;showPrint=0&amp;showTabs=0&amp;showCalendars=0&amp;showTz=0&amp;height=600&amp;wkst=1&amp;bgcolor=%23FFFFFF&amp;src=9pmlg3e5vp2a7vmc0qeavsg1d8%40group.calendar.google.com&amp;color=%2323164E&amp;ctz=America%2FNew_York"></iframe>'],
					['Tutoring','Jin Ming Lin - <i>jlin3291@bths.edu</i>',"The tutoring committee is as simple as it sounds. As NHS members, your grades are all above average. This committee enables you to help students who do not fall under that category. Do not worry if you're not up to par with every subject. You will only be assigned to a subject you're comfortable with.",'<iframe class="cal" src="https://calendar.google.com/calendar/embed?showTitle=0&amp;showPrint=0&amp;showTabs=0&amp;showCalendars=0&amp;showTz=0&amp;height=600&amp;wkst=1&amp;bgcolor=%23FFFFFF&amp;src=r19upb4vl6b8u55jfl55f49pp8%40group.calendar.google.com&amp;color=%23B1365F&amp;ctz=America%2FNew_York"></iframe>']
				]

				<?php
					echo"changePageContent(".round($_GET['c']).");";
				?>

				searchOsisBox = document.getElementById("ossearch");
				searchResultDiv = document.getElementById("sr");
				constructAnnouncements();
			}		

			function changePageContent(num){
				for(i=0;i<subOptArr.length;i++){
					subOptArr[i].style.borderBottom = "none";
				}
				subOptArr[num].style.borderBottom = "2px solid white";

				comName.innerHTML = contentArr[num][0];
				comChair.innerHTML = contentArr[num][1];
				comDesc.innerHTML = contentArr[num][2];
				comCalBox.innerHTML = contentArr[num][3];

			}	
			function modifyLogIn (opt){
				if(opt){
					logInPrompt.style.display = "block";
					//pageBody.style.height= "630px";
				}
				else{
					logInPrompt.style.display = "none";
					//pageBody.style.height= "650px";
				}
			}
			function newAnnouncement(){
				var req2 = new XMLHttpRequest();
				var url2='nhsphp.php?title='+annTitle.value+'&date='+annDate.value+'&ann='+annText.value+'&com=<?php echo $_GET["c"]; ?>';
				req2.onreadystatechange=function(){
					if(req2.readyState == 4){			
						location.reload();
					}
				}
				req2.open('GET',url2,true);
				req2.send(null);
			}
			function constructAnnouncements(){
				for(a=annArr.length-1;a>=0;a--){
					tempDiv1 = document.createElement("div");
					tempDiv2 = document.createElement("div");
					tempDiv3 = document.createElement("div");
					tempSpan1 = document.createElement("span");
					tempSpan2 = document.createElement("span");			
					tempDiv1.className = "ann";
					tempDiv2.className ="atext";
					tempDiv2.innerHTML = annArr[a].atext;
					tempDiv3.className = "author";
					tempDiv3.innerHTML = annArr[a].signature+"<br/>";
					<?php
						if(isset($_SESSION['code']) && $_SESSION['code']==13 || isset($_SESSION['code']) && $_SESSION['code']== $_GET['c']){	
							echo"deleteButton = document.createElement('button');
							deleteButton.innerHTML = 'Delete Post';
							deleteButton.postID = annArr[a].ID;
							deleteButton.setAttribute('onclick','deleteMe(this.postID);');
							deleteButton.className = 'dbut';
							tempDiv3.appendChild(deleteButton);";
						}
						
					?>
					tempSpan1.className = "title";
					tempSpan1.innerHTML = annArr[a].atitle;
					tempSpan2.className ="date";
					tempSpan2.innerHTML = annArr[a].date;
					tempDiv1.appendChild(tempSpan1);
					tempDiv1.innerHTML+= "<br/>";
					tempDiv1.appendChild(tempSpan2);
					tempDiv1.appendChild(tempDiv2);
					tempDiv1.appendChild(tempDiv3);

					annoucementContainer.appendChild(tempDiv1);
				}
			}
			function modifyNewPost(opt){
				postMenu = document.getElementById("np");
				if(opt){
					postMenu.style.display="block";
				}
				else{
					postMenu.style.display="none";
				}
			}
			function deleteMe(pID){
				var req3 = new XMLHttpRequest();
				var url3="nhsphp.php?postID="+pID;
				req3.onreadystatechange=function(){
					if(req3.readyState == 4){	
						location.reload();
					}
				}
				req3.open("GET",url3,true);
				req3.send(null);
			}

			<?php
				if(isset($_SESSION['code']) && $_SESSION['code']==13 || isset($_SESSION['code']) &&  $_SESSION['code']== $_GET['c']){
					echo "function constructMemberTable(needUp){
						if(needUp){
							inputArr = memTable.getElementsByTagName('input');
							for(k=0;k<inputArr.length;k++){
								inputArr[k].value = memArr[k].points;
							}
						}
						else{
							for(m=0;m<memArr.length;m++){
								newRow = memTable.insertRow();
								newCell1 = newRow.insertCell();
								newCell1.innerHTML = memArr[m].fname + ' ' + memArr[m].lname;
								newCell2 = newRow.insertCell();
								newCell2.innerHTML = memArr[m].email;
								newCell3 = newRow.insertCell();
								newCell3.innerHTML = memArr[m].osis;
								newCell4 = newRow.insertCell(); 
								pointInput = document.createElement('input');
								pointInput.type = 'number';
								pointInput.value = memArr[m].points;
								pointInput.style.width = '80px';
								pointBut = document.createElement('button');
								pointBut.innerHTML = 'Update Points';
								pointBut.pVal = pointInput;
								pointBut.pOsis = memArr[m].osis;
								loadingGIF = document.createElement('img');
								loadingGIF.setAttribute('src','loading.gif')
								loadingGIF.style.width='30px';
								loadingGIF.style.display='none';
								pointBut.lGIF = loadingGIF;
								pointBut.setAttribute('onclick','updateMemPoints(this.pOsis,this.pVal,this.lGIF);');
								newCell4.appendChild(pointInput);
								newCell4.appendChild(pointBut);
								newCell4.appendChild(loadingGIF);
							}
						}
					}
					function showAllMembers(){
						memTableContainer.style.display = 'block';
						configurePointsContainer.style.display = 'none';
						updateMemArr(true);
					}
					function showModPoints(){
						configurePointsContainer.style.display = 'block';
						memTableContainer.style.display = 'none';
						updateMemArr(true);
						toUpdateArr=[];
						toEraseArr=selectedMembersCon.getElementsByTagName('div');
						for(e=toEraseArr.length-1;e>=0;e--){
							toEraseArr[e].parentNode.removeChild(toEraseArr[e]);			
						}
						nameBox.value='';
						searchByName('');
					}

					function updateMemPoints(mOsis,mVal,loadingG){
						loadingG.style.display='inline';
						var req4 = new XMLHttpRequest();
						var url4='nhsphp.php?mOsis='+mOsis+'&mVal='+mVal.value;
						req4.onreadystatechange=function(){
							if(req4.readyState == 4){	
								loadingG.style.display='none';
							}
						}
						req4.open('GET',url4,true);
						req4.send(null);
					}

					function showMethod(nameM){
						toUpdateArr=[];
						if(nameM){
							meth2Box.style.display='inline-block';
							osStringBox.style.display='none';
						}
						else{
							toEraseArr=selectedMembersCon.getElementsByTagName('div');
							for(e=toEraseArr.length-1;e>=0;e--){
								toEraseArr[e].parentNode.removeChild(toEraseArr[e]);			
							}
							nameBox.value='';
							searchByName('');
							osStringBox.style.display='inline-block';
							meth2Box.style.display='none';
						}
					}

					function searchByName(nameStr){
						loading1.style.display='inline';
						resultsArr=[];
						searchResultsCon.innerHTML='';
						if(nameStr.length > 1){
							resultsArr=[];
							for(s=0;s<memArr.length;s++){
								memName = memArr[s].fname + ' ' + memArr[s].lname;
								if(memName.toUpperCase().indexOf(nameStr.toUpperCase()) >= 0){
									resultsArr.push(memArr[s]);
									//searchResultsCon.innerHTML+=memName+'<br/>';
									nameDiv = document.createElement('div');
									nameDiv.className='searchr';
									nameDiv.memOb = memArr[s];
									nameDiv.setAttribute('onclick','addToList(this.innerHTML,this.memOb)')
									nameDiv.innerHTML='<span style=\"font-size:15pt;\">'+memName+'</span><br/>'+memArr[s].osis;
									searchResultsCon.appendChild(nameDiv);
								}
							}
						}
						
						loading1.style.display='none';
					}
					function addToList(memInfo,ob){
						if(toUpdateArr.indexOf(ob) == -1){
							toUpdateArr.push(ob);
							selectedDiv = document.createElement('div');
							selectedDiv.className='searchr';
							selectedDiv.innerHTML=memInfo;
							removeBut = document.createElement('button');
							removeBut.memberOb = ob;
							removeBut.setAttribute('onclick','destroyMe(this.parentNode,this.memberOb)');
							removeBut.innerHTML = 'Delete';
							removeBut.style.float='right';
							selectedDiv.appendChild(removeBut);
							selectedMembersCon.appendChild(selectedDiv);
						}
					}
					function destroyMe(divOb,divMemOb){
						toUpdateArr.splice(toUpdateArr.indexOf(divMemOb),1);
						selectedMembersCon.removeChild(divOb);
					}
					function updatePoints(){
						loading2.style.display='inline';
						if(osMethodCheck.checked){
							toUpdateArr=[];
							inputOsisNums = osStringIn.value.split(';');
							for(var r=0;r<inputOsisNums.length;r++){
								toUpdateArr.push(memArr[parOsisArr.indexOf(inputOsisNums[r])]);
							}
						}
						var req5 = new XMLHttpRequest();
						var url5='nhsphp.php?mArr='+JSON.stringify(toUpdateArr)+'&uPoints='+pointModification.value;
						req5.onreadystatechange=function(){
							if(req5.readyState == 4){	
								loading2.style.display='none';
								toEraseArr=selectedMembersCon.getElementsByTagName('div');
								for(e=toEraseArr.length-1;e>=0;e--){
									toEraseArr[e].parentNode.removeChild(toEraseArr[e]);			
								}
								toUpdateArr=[];
								nameBox.value='';
								searchByName('');
							}
						}
						req5.open('GET',url5,true);
						req5.send(null);
						//add loading
					}

					function updateMemArr(tableC){
						var req6 = new XMLHttpRequest();
						var url6='nhsphp.php?mReq=y&mC=".$cIndex."';
						req6.onreadystatechange=function(){
							if(req6.readyState == 4){	
								memArr = eval(req6.responseText);
								for(var o=0;o<memArr.length;o++){
									parOsisArr.push(memArr[o].osis);
								}		
								constructMemberTable(tableC);
							}
						}
						req6.open('GET',url6,true);
						req6.send(null);
					}

					function showManager(toggle){
						if(toggle){
							manageBox.style.display='block';
							pointSearchBox.style.display='none';
							showAllMembers();
						}
						else{
							manageBox.style.display='none';
							pointSearchBox.style.display='block';
						}
					}";
				}
			?>

			function getCommitteePoints(){
				var req7 = new XMLHttpRequest();
				var url7="nhsphp.php?sosis="+searchOsisBox.value+"&comn=<?php echo $cIndex; ?>";
				req7.onreadystatechange=function(){
					if(req7.readyState == 4){	
						searchResultDiv.innerHTML = req7.responseText +"<br/><i style='font-size:13pt;'>If you believe this is an error, please contact your chairperson.</i>";
					}
				}
				req7.open("GET",url7,true);
				req7.send(null);
			}

		</script>
	</head>
	<body onload="initialize();">
		<div class="maincontainer">
			<div class="bcontainer">
				<img class="banner" src="nhsheader3.png"/>
				<div class="menu">
					<div class="opt1"><a href="index.php">Home</a></div>
					<div class="opt2"><a href="information.php">General Information</a></div>
					<div class="opt3">
						<a href="committees.php">Committees</a>
					</div>
					<div class="opt4">
						<a href="points.php">Check My Points</a>
					</div>
				</div>
				<div id="smenu" class="submenu">
					<div onclick="location.href='committees.php?c=0'" style="border-bottom:2px solid white" class="subopt">Academic Recognition</div>
					<div onclick="location.href='committees.php?c=1'"  class="subopt">Alumni Services</div>
					<div onclick="location.href='committees.php?c=2'"  class="subopt">Club Team Council</div>
					<div onclick="location.href='committees.php?c=3'"  class="subopt">College Services</div>
					<div onclick="location.href='committees.php?c=4'"  class="subopt">Community Services</div>
					<div onclick="location.href='committees.php?c=5'" class="subopt">Fundraising</div>
					<div onclick="location.href='committees.php?c=6'"  class="subopt">Induction</div>
					<div onclick="location.href='committees.php?c=7'"  class="subopt">Mentoring</div>
					<div onclick="location.href='committees.php?c=8'"  class="subopt">Parent Services</div>
					<div onclick="location.href='committees.php?c=9'" class="subopt">Recycling</div>
					<div onclick="location.href='committees.php?c=10'" class="subopt">School Environment</div>
					<div onclick="location.href='committees.php?c=11'"  class="subopt">Tours</div>
					<div onclick="location.href='committees.php?c=12'"  class="subopt">Tutoring</div>
				</div>
				<div id="cname" class="cname"></div>
				<div class="comcon">
					<div class="cinfo">
						<u>Chairperson:</u> <span id="chair"></span><br/>
						<span id="cdesc"></span>
					</div>
				</div>
				<div class="con2">
					<div class="cannc">
							<?php
								if(isset($_SESSION['code']) && $_SESSION['code']==13 || isset($_SESSION['code']) && $_SESSION['code']== $_GET['c']){
									echo"<div style='display:none' id='np' class='postb'><div style='text-align:center; font-size:18pt; font-weight:bold;'>New Post</div>
									<input id='title' type='text' placeholder='Title'/><br/>
									<input id='date' type='text' placeholder='Date (MM/DD/YY)'/><br/>
									<textarea maxlength='600'id='ann'style='height:250px; width:400px; max-height:250px; max-width:400px' placeholder='Annoucement (Max 600 characters)'></textarea><br/>
									<button onclick='newAnnouncement();'>Submit</button>
									<button onclick='modifyNewPost(false);'>Cancel</button>
								</div>";
								}
							?>
							<span class="coln1">Announcements
								<?php
									if(isset($_SESSION['code']) && $_SESSION['code']==13 || isset($_SESSION['code']) && $_SESSION['code']== $_GET['c']){
										echo"<button onclick='modifyNewPost(true)'style='position:absolute; width:70px; margin-top:5px; margin-left:20px;'>Add Post</button>";
									}
								?>
							</span><br/>
							<div id="abox" class="cann">
							</div>
					</div>
					<div class="calcon">
						<span class="coln2">Events</span><br/>
						<div id="cal">
						</div>
					</div>
				</div>
				<div class="pcon">
					<div style="position:relative; top:-12px"class="cname">
						Committee Points
						<?php
							if(isset($_SESSION['code']) && $_SESSION['code']==13 || isset($_SESSION['code']) &&  $_SESSION['code']== $_GET['c']){
								echo"<button onclick='showManager(true);'class='openmod'>Manage Committee Members</button>";
							}
						?>
					</div>
					<?php
						if(isset($_SESSION['code']) && $_SESSION['code']==13 || isset($_SESSION['code']) &&  $_SESSION['code']== $_GET['c']){	
							echo"<div id='manmem'class='editp'>
								<div style='border-right:2px solid black'class='mopts'onclick='showAllMembers();'>Committee Members</div><div class='mopts'onclick='showModPoints();'>Change Member Points <button onclick='showManager(false);' class='closemod'>Close window</button></div><hr style='border-color:black'/>
								<div style='display:block;'id='allm' class='tcon'>
									<table style = 'padding:5px'id='memt'>
										<tr>
											<td class='hc'>Name</td>
											<td class='hc'>BTHS Email</td>
											<td class='hc'>OSIS</td>
											<td class='hc'>Committee Points</td>
										</tr>
									</table>
								</div>
								<div style='display:none;' id='confp'>
									<span style='font-size:14pt; margin-left:5px; font-weight:bold;'>Choose method for selecting members:</span><br/>
									<label><input checked onclick='showMethod(true);'type='radio' name='opt'/> Enter Names</label>
										<div id='m2'class='meth2'>
											<input id='nb'type='text' style='margin-left:5px; width:390px' placeholder='Search members' oninput='searchByName(this.value)'/>
											<div class='toadd' id='toa'><span style='font-size:14pt; text-decoration:underline;'>Selected Members</span><br/></div>
											<br/>
											<img style='display:none'width='30px'id='l1'src='loading.gif'/>
											<div class='rc'id='resultsCon'></div>
										</div>
									<label><input id='om'onclick='showMethod(false);'type='radio' name='opt'/> Enter OSIS Numbers</label>
										<div id='osbox'style='display:none;'>
											<input id='os'type='text' style='margin-left:5px; width:250px;' placeholder='Enter OSIS string'/><br/>
											<i style='margin-left:5px;'>Enter each osis number separated by a semicolon. No spaces.<br/><span style='margin-left:5px'>ex. 206371205;254384517;293627274;295462748</span></i>
										</div>
									<hr style='border-color:darkgrey'/>
									<span style='font-weight:bold; margin-left:5px; font-size:14pt;'>Points to add/subtract:</span><br/><input value='0' style='margin-left:5px'type='number' id='pmod'/><br/>
									<button class='ubut' onclick='updatePoints();'>Update Points!</button><img style='display:none'width='30px'id='l2'src='loading.gif'/>
								</div>
							</div>";
						}
					?>
					<div id='ps'class='psearch'>
						<div class='scon'>
							<input style='height:20px;width:200px;'id='ossearch'type='text' placeholder='OSIS Number'/><br/>
							<button onclick="getCommitteePoints();">Check Points!</button><br/>
							<div style="font-size:16pt; margin-top:5px;"id="sr"></div>
						</div>
					</div>
				</div>
				<div class="fcon">
					<div class="log" id="lprompt">
						<form method = "post" action = "committees.php?c=<?php echo $_GET['c']?>">
							<input name="uname" type="text" placeholder="Username" required/> <input name="pword" type="password" placeholder="Password" required/> <input type="submit"/>
							<?php
								if($errorLogin){
									echo "<span style='color:red; font-style:italic;'>Invalid input</span>";
								}
							?>
						</form>
						<button style="float: right;"class="cbutton" onclick="modifyLogIn(false);">Close</button>


					</div>
					<div id="foot" class="footer">
						Brooklyn Technical High School National Honor Society 2016-2017
						<?php
							if(isset($_SESSION['name'])){
								echo "<span class='lbut'>Signed in as ".$_SESSION['name']."<form method = 'post' action = 'committees.php?c=".$_GET['c']."'><input name='logout' type='hidden'/> <input value='Log out'type='submit'/></form></span>";
							}
							else{
								echo "<button class='lbut' onclick='modifyLogIn(true);''>Executive Login</button>";
							}
						?>
					</div>
				</div>

			</div>
		</div>
	</body>
</html>