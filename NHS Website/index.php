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

			/*if(isset($_POST['title'])){
				$pTitle = str_replace("'","''",$_POST['title']);
				$pDate = $_POST['date'];
				$pAnn = str_replace("'","''",$_POST['ann']);
				$pSig = $_SESSION['sig'];
				$pID = rand(100000000,999999999);
				//str_replace
				//$cmd = "INSERT INTO `posts`(`atitle`, `date`, `atext`, `signature`, `ID`) VALUES ('".$pTitle."','{$pDate}',.".$pAnn.",'{$pSig}',{$pID})";
				$addPost = $conn->prepare("INSERT INTO `posts`(`atitle`, `date`, `atext`, `signature`, `ID`) VALUES ('{$pTitle}','{$pDate}','{$pAnn}','{$pSig}',{$pID})");
				$addPost->execute();
			}*/
			$annArr = $conn->prepare("SELECT * FROM `posts` WHERE `committee` = 13");
			$annArr->execute();


		?>
		<style>
			.cal{
				width:530px;
				height:600px;
				border:none;
				left:-5px;
				position: relative;
			}
			.annp,.calp{
				display: inline-block;
				position: absolute;
				top:-20px;
			}
			.calp{
				right:3px;
				/*font-family: arial;*/
				font-size:16pt;
				text-align: center;
				margin-bottom:0px;
			}
			.annp{
				left:10px;
				font-size:16pt;
				height:630px;
				text-align: center;
				width:350px;
				border-right:2px solid grey;
				top:0px;
				left:0px;
				position: relative;
			}
			h1{
				position: relative;
				margin:0px;
				padding:0px;
				height:650px;
				width:898px;
				top:0px;

			}
			.annc{
				display: inline-block;
				border-radius:20px;
				height:570px;
				width:320px;
				position: relative;
				top:10px;
				left:0px;
				padding:10px;
				font-weight: normal;
				overflow: auto;
			}
			.title{
				font-size:15pt;
				margin:0px;
				padding:0px;
				text-decoration: underline;
				word-wrap:break-word;
			}
			.date{
				font-size:11pt;
				font-style: italic;
			}
			.atext{
				font-size:13pt;	
				text-align: left;
				word-wrap: break-word;		
			}
			pre{
				display: inline;
				white-space: pre-wrap;
				margin:0;
			}
			.author{
				font-size:12pt;
				margin-top: 5px;
				font-style: italic;
			}
			.ann{
				border-bottom:2px solid navy;
			}
			.dbut{
				
			}
			.sec{
				font-weight: bold;
				font-size:19pt;
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
			.footer{
				width:897px;
			}
			form{
				display: inline;
			}
			.postb{
				position: absolute;
				top:180px;
				left:360px;
				height:400px;
				width:520px;
				z-index: 10;
				background-color: grey;
				border:2px solid black;
				border-radius:20px;
				padding:5px;
			}
		</style>
		<script>
			function initialize(){
				logInPrompt = document.getElementById("lprompt");
				pageBody = document.getElementById("h1");
				annoucementContainer = document.getElementById("annc");

				<?php
					if(isset($_SESSION['code']) && $_SESSION['code']==13){
						echo "annTitle = document.getElementById('title');
						annDate = document.getElementById('date');
						annText = document.getElementById('ann');";
					}
				?>
				annArr = eval(<?php echo json_encode($annArr->fetchAll(PDO::FETCH_ASSOC)); ?>);
				
				constructAnnouncements();
			}
			<?php
				if(isset($_SESSION['code']) && $_SESSION['code']==13){
					echo"function newAnnouncement(){
						var req1 = new XMLHttpRequest();
						var url1='nhsphp.php?title='+annTitle.value+'&date='+annDate.value+'&ann='+annText.value+'&com=13';
						req1.onreadystatechange=function(){
							if(req1.readyState == 4){			
								location.reload();
							}
						}
						req1.open('GET',url1,true);
						req1.send(null);
						}";	
					}
				
			?>
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
						if(isset($_SESSION['code']) && $_SESSION['code']==13){
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
			function modifyLogIn (opt){
				if(opt){
					logInPrompt.style.display = "block";
					pageBody.style.height= "630px";
				}
				else{
					logInPrompt.style.display = "none";
					pageBody.style.height= "650px";
				}
			}

			function deleteMe(pID){
				var req2 = new XMLHttpRequest();
				var url2="nhsphp.php?postID="+pID;
				req2.onreadystatechange=function(){
					if(req2.readyState == 4){	
						location.reload();
					}
				}
				req2.open("GET",url2,true);
				req2.send(null);
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
						<a href="committees.php?c=0">Committees</a>
					</div>
					<div class="opt4">
						<a href="points.php">Check My Points</a>
					</div>
				</div>
				<h1 id="h1">
					<div class="annp">
						<span class="sec">Announcements 
							<?php 
								if(isset($_SESSION['code']) && $_SESSION['code']==13)
									echo "<button onclick='modifyNewPost(true)'style='position:absolute;float:right; margin-top:5px;'>Add Post</button>"
							?>
						</span><br/>
						<div id="annc"class="annc">
						</div>
					</div>
					<p class="calp">	
						<span class="sec">Events</span><br/>
						<iframe class="cal"src="https://calendar.google.com/calendar/embed?showTitle=0&amp;showPrint=0&amp;showTabs=0&amp;showCalendars=0&amp;showTz=0&amp;height=600&amp;wkst=1&amp;bgcolor=%23FFFFFF&amp;src=59k2agv4c6aj36on60aroic26g%40group.calendar.google.com&amp;color=%23000000&amp;ctz=America%2FNew_York"></iframe>
					</p>
				</h1>
				<div class="log" id="lprompt">
					<form method = "post" action = "index.php">
						<input name="uname" type="text" placeholder="Username" required/> <input name="pword" type="password" placeholder="Password" required/> <input type="submit"/>
						<?php
							if($errorLogin){
								echo "<span style='color:red; font-style:italic;'>Invalid input</span>";
							}
						?>
					</form>
					<button style="float: right;"class="cbutton" onclick="modifyLogIn(false);">Close</button>
				</div>
				<div class="footer">
					Brooklyn Technical High School National Honor Society 2016-2017
					<?php
						if(isset($_SESSION['name'])){
							echo "<span class='lbut'>Signed in as ".$_SESSION['name']. "<form method = 'post' action = 'index.php'><input name='logout' type='hidden'/> <input value='Log out'type='submit'/></form></span>";
						}
						else{
							echo "<button class='lbut' onclick='modifyLogIn(true);''>Executive Login</button>";
						}
					?>
					
				</div>
				<?php
					if(isset($_SESSION['code']) && $_SESSION['code']==13){
						echo"<div style='display:none' id='np' class='postb'><div style='text-align:center; font-size:18pt; font-weight:bold;'>New Post</div><br/>
							<input id='title' type='text' placeholder='Title'/><br/>
							<input id='date' type='text' placeholder='Date (MM/DD/YY)'/><br/>
							<textarea maxlength='600'id='ann'style='height:250px; width:400px; max-height:250px; max-width:400px' placeholder='Annoucement (Max 600 characters)'></textarea><br/>
							<button onclick='newAnnouncement();'>Submit</button>
							<button onclick='modifyNewPost(false)'>Cancel</button>
						</div>";
					}
				?>
			</div>
		</div>
	</body>
</html>