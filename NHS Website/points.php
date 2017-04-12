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

			$memArr = $conn->prepare("SELECT * FROM `gpoints`");
			$memArr->execute();
		?>
		<style>
			.log{
				background-color: grey;
				width:897px;
				height:43px;
				z-index: 10;
				padding:2px;
				margin-top:-40px;
				<?php
					if($errorLogin){
						echo "display: block;";
					}
					else{
						echo "display: none;";
					}
				?>
			}
			.lbut{
				float:right;
				padding:1px;
			}
			form{
				display: inline;
			}
			.fcon{
				padding-top: 50px;
			}
			.ptit{
				margin-top: 5px;
				font-size:20pt;
				font-weight: bold;		
				text-align: center;
				position: relative;
			}
			.gpcon{
				margin:auto;
			}
			.editp{
				height:500px;
				width:890px;
				background-color: lightgrey;
				margin-left:auto;
				margin-right: auto;
				border:2px solid black;
				position: relative;
				display: none;
				z-index: 5;		
			}
			table{
				margin: auto;
				border-spacing: 0;
			}
			td{
				width:180px;
				padding:5px;
				border:2px solid darkgrey;

			}
			.hc{
				text-align: center;
				border-bottom:2px solid darkgrey;
				font-weight: bold;
			}
			.tcon{
				height:460px;
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
				width:438px;
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
				top:3px;
				right:30px;
			}
			.psearch{
				width:850px;
				
				margin:auto;
				text-align: center;
			}
			.scon{
				margin-top:5px;
			}
		</style>
		<script>
			function initialize(){
				logInPrompt = document.getElementById("lprompt");
				searchOsisBox = document.getElementById("ossearch");
				searchResultDiv = document.getElementById("sr");
				pointTotalBox = document.getElementById('pt');
				pointSearchBox = document.getElementById('ps');

				<?php
					if(isset($_SESSION['code']) && $_SESSION['code']==13){
					
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
						pointSearchBox = document.getElementById('ps');
						parOsisArr=[];
						for(var o=0;o<memArr.length;o++){
							parOsisArr.push(memArr[o].osis);
						}
						toUpdateArr=[];
						constructMemberTable(false);
						eventSelect = document.getElementById('es');
						newEventInput = document.getElementById('ne');
						getEventOpts(true);";
					}
				?>
			}
					function modifyLogIn (opt){
						if(opt){
							logInPrompt.style.display = "block";
						}
						else{
							logInPrompt.style.display = "none";
						}
					}
				<?php
					if(isset($_SESSION['code']) && $_SESSION['code']==13){
						echo"function constructMemberTable(needUp){
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
										newCell4.innerHTML = memArr[m].committee;
										newCell5 = newRow.insertCell(); 
										newCell5.innerHTML = memArr[m].points;
										/*pointInput = document.createElement('input');
										pointInput.type = 'number';
										pointInput.value = memArr[m].points;
										pointInput.style.width = '40px';
										pointBut = document.createElement('button');
										pointBut.innerHTML = 'Update';
										pointBut.pVal = pointInput;
										pointBut.pOsis = memArr[m].osis;
										loadingGIF = document.createElement('img');
										loadingGIF.setAttribute('src','loading.gif')
										loadingGIF.style.width='30px';
										loadingGIF.style.display='none';
										pointBut.lGIF = loadingGIF;
										pointBut.setAttribute('onclick','updateMemPoints(this.pOsis,this.pVal,this.lGIF);');
										newCell5.appendChild(pointInput);
										newCell5.appendChild(pointBut);
										newCell5.appendChild(loadingGIF);*/
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
								//getEventOpts(f);
							}

							function updateMemPoints(mOsis,mVal,loadingG){
								loadingG.style.display='inline';
								var req4 = new XMLHttpRequest();
								var url4='nhsphp.php?mOsis2='+mOsis+'&mVal='+mVal.value;
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
								//console.log(toUpdateArr.indexOf(divMemOb));
								toUpdateArr.splice(toUpdateArr.indexOf(divMemOb),1);
								//console.log(toUpdateArr);
								selectedMembersCon.removeChild(divOb);
							}
							function updatePoints(){
								if(eventSelect.value!='Choose Event' || newEventInput.style.display == 'block' ){
									loading2.style.display='inline';
									newColn = false;
									if(osMethodCheck.checked){
										toUpdateArr=[];
										inputOsisNums = osStringIn.value.split(';');
										for(var r=0;r<inputOsisNums.length;r++){
											toUpdateArr.push(memArr[parOsisArr.indexOf(inputOsisNums[r])]);
										}

									}
									if (newEventInput.style.display=='block'){
										if(eventNamesArr.indexOf(newEventInput.value.toUpperCase()) != -1){
											inEventName = parColNamesArr[eventNamesArr.indexOf(newEventInput.value.toUpperCase())];
										}
										else{
											inEventName = newEventInput.value;
											while(inEventName.indexOf(' ') > -1){
												inEventName =  inEventName.replace(' ','_');
											}
											newColn = true;
											updateEventSelections(newEventInput.value,inEventName);
											
										}
									}
									else{
										inEventName = eventSelect.value;
										//console.log(eventSelect.value);
									}
									var req5 = new XMLHttpRequest();
									var url5='nhsphp.php?mArrG='+JSON.stringify(toUpdateArr)+'&uPoints='+pointModification.value+'&evName='+inEventName+'&needNew='+newColn;
									req5.onreadystatechange=function(){
										if(req5.readyState == 4){	
											loading2.style.display='none';
											newEventInput.value='';
											newEventInput.innerHTML='';
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
								}
							}
							function updateEventSelections(evN,colN){
								var newerOpt = document.createElement('option');
								newerOpt.value = colN;
								newerOpt.innerHTML = evN;
								eventNamesArr.push(evN.toUpperCase());
								parColNamesArr.push(colN);
								eventSelect.appendChild(newerOpt);
							}

							function updateMemArr(tableC){
								var req6 = new XMLHttpRequest();
								var url6='nhsphp.php?mReq2=y';
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
							}

							function getEventOpts(needUpd){
								if(needUpd){
									var req11 = new XMLHttpRequest();
									var url11='nhsphp.php?optReq=y';
									req11.onreadystatechange=function(){
										if(req11.readyState == 4){	
											eventNamesArr=[];
											parColNamesArr=[];
											eventArr = eval(req11.responseText);
											for(eName in eventArr[0]){
												//var correctFound = false;
												//var cF = 0;
												if(eName != 'osis'){
													var newOpt = document.createElement('option');
													newOpt.value = eName;
													eNameStr = eName
													while (eNameStr.indexOf('_') > -1){
														eNameStr = eNameStr.replace('_',' ');
													}
													eventNamesArr.push(eNameStr.toUpperCase());
													parColNamesArr.push(eName);
													newOpt.innerHTML = eNameStr;
													eventSelect.appendChild(newOpt);
												}
											}
										}
									}
									req11.open('GET',url11,true);
									req11.send(null);
								}
							}
							

							function changeEventOpt (tog){
								if(tog){
									eventSelect.style.display='inline';
									newEventInput.style.display='none';
								}
								else{
									eventSelect.style.display='none';
									newEventInput.style.display='block';
								}
							}";
				}
			?>
			function getGeneralPoints(){
				var reqGen = new XMLHttpRequest();
				var urlGen="nhsphp.php?sosisG="+searchOsisBox.value;
				reqGen.onreadystatechange=function(){
					if(reqGen.readyState == 4){	
						memEventsArr = eval(reqGen.responseText);
						//console.log(memEventsArr);
						if(memEventsArr.length == 0){
							pointTotalBox.innerHTML="";
							searchResultDiv.innerHTML = "OSIS Number not recognized.";
							//alert(memEventsArr);
						}
						else{
							pointTotal = 0;
							newTableGen = document.createElement("table");
							newRowGen = newTableGen.insertRow();
							newCellE = newRowGen.insertCell();
							newCellE.innerHTML = "Event Name";
							newCellE.className = 'hc';
							newCellP = newRowGen.insertCell();
							newCellP.innerHTML = "Points Awarded";
							newCellP.className = 'hc';
							for(eventNameC in memEventsArr[0]){
								eventString = eventNameC;
								while (eventString.indexOf('_') != -1){
									eventString = eventString.replace("_"," ");
								}
								if(eventNameC != 'osis' && memEventsArr[0][eventNameC] != 0 && memEventsArr[0][eventNameC] != ""){
									console.log(memEventsArr[0]);
									console.log(eventNameC);
									var tempRow = newTableGen.insertRow();
									var tempCell1 = tempRow.insertCell();
									tempCell1.style.width = "350px";
									tempCell1.style.textAlign = 'left';
									tempCell1.innerHTML = eventString;
									var tempCell2 = tempRow.insertCell();
									tempCell2.style.textAlign='left';
									tempCell2.innerHTML = memEventsArr[0][eventNameC];
									pointTotal+=parseInt(memEventsArr[0][eventNameC]);
									console.log(memEventsArr[0][eventNameC]);
								}
							}
							searchResultDiv.innerHTML="";
							pointTotalBox.innerHTML="";
							searchResultDiv.appendChild(newTableGen);
							pointTotalBox.innerHTML = "Total Points: "+pointTotal;
						}
						searchResultDiv.innerHTML += "<br/><i style='font-size:12pt;''>If you believe there is an error, please contact Nicole at ngendler.nhs@gmail.com</i>";

					}
				}
				reqGen.open("GET",urlGen,true);
				reqGen.send(null);
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
		
				<div class='gpcon'>
					<div class='ptit'>
						General Points
						<?php
							if(isset($_SESSION['code']) && $_SESSION['code']==13){
								echo"<button onclick='showManager(true);'class='openmod'>Manage NHS Members</button>";
							}
						?>
					</div>
				<?php
					if(isset($_SESSION['code']) && $_SESSION['code']==13){
						echo"<div id='manmem'class='editp'>
							<div style='border-right:2px solid black'class='mopts'onclick='showAllMembers();'>Members</div><div class='mopts'onclick='showModPoints();'>Change Member Points <button onclick='showManager(false);' class='closemod'>Close window</button></div><hr style='border-color:black'/>
							<div style='display:block;'id='allm' class='tcon'>
								<table style = 'padding:5px'id='memt'>
									<tr>
										<td class='hc'>Name</td>
										<td class='hc'>BTHS Email</td>
										<td class='hc'>OSIS</td>
										<td class='hc'>Committee</td>
										<td class='hc'>Points</td>
									</tr>
								</table>
							</div>
							<div style='display:none;' id='confp'>
								<span style='font-size:14pt; margin-left:5px; font-weight:bold;'>Choose Event:</span><br/>
								<label><input checked onclick='changeEventOpt(true);'type='radio' name='eopt'/> Select Preexisting Event</label>
										<select style='width:150px; margin-left:5px;'placeholder='Choose Event'id='es'>
											<option id='dopt'disabled selected='selected'>Choose Event</option>
										</select>
								<label><input id=''onclick='changeEventOpt(false);'type='radio' name='eopt'/> New Event</label>
										<input style='width:150px; margin-left:5px; display:none;'type='text' id='ne'placeholder='Event Name'/>
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
								<span style='font-weight:bold; margin-left:5px; font-size:14pt;'>Points to add/subtract for event:</span><br/><input value='0' style='margin-left:5px'type='number' id='pmod'/><br/>
								<button class='ubut' onclick='updatePoints();'>Update Points!</button><img style='display:none'width='30px'id='l2'src='loading.gif'/>
							</div>
						</div>";
					}
				?>
				<div id='ps'class='psearch'>
						<div class='scon'>
							<input style='height:20px;width:200px;'id='ossearch'type='text' placeholder='OSIS Number'/><br/>
							<button onclick="getGeneralPoints();">Check Points!</button><br/>
							<div id='pt'style='font-size:16pt; margin-top:5px;'></div>
							<div style="font-size:16pt; margin-top:5px;"id="sr"></div>
						</div>
					</div>
				</div>

				<div class="fcon">
					<div class="log" id="lprompt">
						<form method = "post" action = "points.php">
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
								echo "<span class='lbut'>Signed in as ".$_SESSION['name']."<form method = 'post' action = 'points.php'><input name='logout' type='hidden'/> <input value='Log out'type='submit'/></form></span>";
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