<!DOCTYPE HTML>
<!--Hans Montero-->
<html>
	<head>
		<title>BTHS National Honor Society</title>
		<link rel="stylesheet" href="style.css">
		<style>
			.submenu{
				background-color: grey;
				width:900px;
				height:30px;
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
			.contentcontainer{
				text-align:center;
				position: relative;
				top:5px;
			}
			.title{
				font-size:20pt;
				display: inline-block;
				margin-bottom:20px;
			}
			.elist{
				font-size:14pt;
			}
			.officers{
				position: relative;
				float: left;
				left:5px;
				border-right:2px solid grey;
				padding-right:5px;
				z-index: 4;
			}
			.chairs{
				position: relative;
				display: inline-block;
				left:4px;
			}
			.bcontainer{
				height:950px;
			}
			.footer{
				text-align: left;
				top:950px;
			}
			.coln{
				display: inline-block;
				font-size:16pt;
				text-decoration: underline;
				margin-bottom: 5px;
			}
			.col1,.col2{
				display: inline-block;
				width:250px;
				font-size:14pt;
				position: absolute;
			}
			.col1{
				left:-160px;
			}
			.col2{
				right:-140px;
			}
			.mparac{
				position: relative;
				top:-40px;
				padding:30px;
			}
			.missionpara{
				text-align:left;
				font-size:13pt;
			}
			.faqc{
				position: relative;
				display: inline-block;
				width: 850px;
				height:950px;
				overflow: auto;
				text-align: left;
				font-size:14pt;
			}

		</style>

		<script>
			function initialize(){
				pageContent = document.getElementById("ccon");
				whiteBack = document.getElementById("whiteb");
				pageFooter = document.getElementById("foot");
				
				subOptArr= [document.getElementById("s0"),document.getElementById("s1"),document.getElementById("s2")];

				contentArr = ["<span id='ctitle' class='title'>NHS Executive Board (2016-2017)</span><br/><div class='elist'> <div class='officers'> <span class='coln'>Officers</span><br/> <b>Co-Presidents</b><br/>Husna Ellis & Kiran Javaid <br/><i>hellis.nhs@gmail.com & kjavaid.nhs@gmail.com</i><br/><br/> <b>Vice President of Committees</b><br/>Hans Montero<br/> <i>hmontero.nhs@gmail.com</i><br/><br/> <b>Vice President of College Services</b><br/>Angie Yu<br/><i>angieyu.nhs@gmail.com</i><br/><br/> <b>Secretary</b><br/>Nicole Gendler<br/> <i>ngendler.nhs@gmail.com</i><br/><br/> <b>Treasurer</b><br/>Jasur Abdurazzakov<br/><i>jabdurazzakov0272@bths.edu</i><br/><br/> <b>Parliamentarian</b><br/>Chloe Wong<br/> <i>cwong0456@bths.edu</i><br/><br/> <b>Historian</b><br/>Sarah Flynn<br/><i>sflynn7519@bths.edu</i><br/><br/> </div> <div class='chairs'> <span class='coln'>Committee Chairpeople</span><br/> <div class='col1'> <b>Academic Recognition</b><br/>Tanzina Islam<br/><i>tislam4599@bths.edu</i><br/><br/> <b>Alumni Services</b><br/>Tiffany Voon<br/> <i>tvoon1410@bths.edu</i><br/><br/> <b>Club Team Council</b><br/>Laura Chen<br/><i>lchen1733@bths.edu</i><br/><br/> <b>College Services</b><br/>Joey Jiemjitpolchai<br/> <i>jjiemjitpolchai9540@bths.edu</i><br/><br/> <b>Community Services</b><br/>Michelle Wong<br/><i>mwong9708@bths.edu</i><br/><br/> <b>Fundraising</b><br/>Nabila Basar<br/><i>nbasar3600@bths.edu</i><br/><br/> <b>Induction</b><br/>Mei Lin Zheng<br/><i>mzheng7988@bths.edu</i><br/><br/> </div> <div class='col2'> <b>Mentoring</b><br/>Ekok Soubir & Carmen Chen<br/> <i>esoubir6205@bths.edu & cchen5239@bths.edu</i><br/><br/> <b>Parent Services</b><br/>Nour Haredy<br/><i>nharedy9977@bths.edu</i><br/><br/> <b>Recycling</b><br/>Doruntina Fida<br/> <i>dfida6514@bths.edu</i><br/><br/> <b>School Environment</b><br/>Vivian Su<br/><i>vsu0170@bths.edu</i><br/><br/> <b>Tours</b><br/>Helal Chowdhury<br/><i>hchowdhury3273@bths.edu</i><br/><br/> <b>Tutoring</b><br/>Jin Ming Lin<br/><i>jlin3291@bths.edu</i><br/><br/> </div> </div> </div>",
				"<span id='ctitle' class='title'>NHS Mission Statement</span><br/> <div class='mparac'> <div class='missionpara'>The National Honor Society (NHS) is one of the nation's leading organizations established to identify outstanding high school students. More than just an honor roll, NHS serves to recognize those students who have demonstrated excellence in the 4 NHS pillars of Scholarship, Leadership, Service, and Character. With a history of many outstanding and successful members, the Brooklyn Technical High School National Honor Society is dedicated to continuing this longstanding NHS tradition. Its purpose is to provide services to the school community as well as the local community, whether it is through volunteering at local organizations, tutoring students, mentoring, assisting school faculty, or helping out during major school events. If help is needed within Brooklyn Technical High School, we have always been there and will always be there to help with some of the best students that the school has to offer.</div><br/> <div class='missionpara'>As a student run organization (with the leadership and advice of our advisor, Mr. Joseph Kaelin, and our committee advisors), the Brooklyn Technical High School National Honor Society aims to reach out to exemplary students at Brooklyn Technical High School. To us, exemplary means those who are able to maintain their GPA and keep up with their extracurricular activities while performing benevolent services to their peers and to the community.</div><br/> <div class='missionpara'>With close to 600 members currently in the Brooklyn Technical High School National Honor Society, each member participates in one of 13 different committees, each with a special delegated task in order to better assist the students, staff and faculty of the school as well as the local community. These 13 committees are Academic Recognition, Alumni, Club Team Council, College Services, Community Services, Fundraising, Induction, Mentoring, Parent Services, Recycling, School Environment, Tours, and Tutoring.</div><br/> <div class='missionpara'>Although all members are already leaders in their own respect, they are also invited to become leaders within the Brooklyn Technical High School National Honor Society as well as in the school community in order to build leadership qualities. For instance, junior members can apply to become Junior Chairpersons of their respective committees, and senior members can apply to become Senior Chairpersons or Officers.</div><br/> <div class='missionpara'>For more information on what the Brooklyn Technical High School National Honor Society does or to learn about how to become a member, please feel free to visit the other pages on our website or to contact us by emailing an NHS Officer or by placing a letter in our mailboxes in room 7C1. For information about NHS responsibilites and structure, consult the Constitution.</div> </div>",
				"<span id='ctitle' class='title'>Frequently Asked Questions</span><br/> <div class='faqc'> <b>How do I join the Brooklyn Technical High School National Honor Society?</b><br/> Students attending Brooklyn Technical High School who are entering their sophomore, junior, and senior years are welcome to complete an application to apply for membership. Applications will go out to students sometime near the end of the academic year around the month of May and will be evaluated over the summer. A second round of applications is usually released at the beginning of an academic year. One must have a GPA of 85 or higher, submit a completed application, and satisfy the point requirements for membership (more information about the point requirements can be found on the application).<br/><br/> <b>How much credit do I earn from being a member of NHS?</b><br/> Members earn 16 club credits per semester. However, members must have accumulated 150 General and 100 Committee Points by the end of the school year in order to receive credits.<br/><br/> <b>Brooklyn Technical High School is a challenge. Will I be able to keep up with my studies as a member of the Brooklyn Technical High School National Honor Society?</b><br/> We understand that Brooklyn Technical High School is a great academic challenge and that all students have a lot of work to complete. But with proper time management, being a member of the Brooklyn Technical High School National Honor Society will not be a significant tax on a member’s workload. As long as members work hard, they will be fine. Being a member is supposed to be a fun and memorable experience.<br/><br/> <b>What is a committee and how do I pick one?</b><br/> Each committee within the Brooklyn Technical High School National Honor Society specializes in different areas of service to the school community or local community. To decide on a committee, please read the descriptions for what each committee does and determine the one that is most interesting. Before the committee selection process, an e-mail will be sent out in warning for the release of a sign up page where one will choose a desired committee; whether or not one gets their first choice is based on one's responsibility and timing.<br/><br/> <b>How often does the Brooklyn Technical High School National Honor Society meet?</b><br/> Our general meetings are once a month, and our committees operate on their own respective schedules.<br/><br/> <b>How can I become a Junior Chairperson/Senior Chairperson/Officer?</b><br/> To be selected as Junior Chairperson/Senior Chairperson/Officer, a member must possess leadership qualities as well as be able to work well with other individuals. Junior members interested in becoming Junior Chairpersons of their respective committees should complete the Junior Chairperson application that goes out sometime in the beginning of the academic year around the month of October. Senior members interested in becoming Senior Chairpersons/Officers should complete the Senior Chairperson/Officer application that goes out some time towards the end of the academic year around the month of April and will have to undergo an interview process.<br/><br/> <b>I still have questions regarding the Brooklyn Technical High School National Honor Society. Who should I contact?</b><br/> If there are any additional questions, please feel free to visit the other pages on our website or to contact us by emailing an Officer or by placing a letter in our mailboxes in room 7C1. </div>"
				];
			}
		function changeContent(num){
			pageContent.innerHTML = contentArr[num];
			for(i=0;i<subOptArr.length;i++){
				subOptArr[i].style.borderBottom = "none";
			}
			subOptArr[num].style.borderBottom = "2px solid white";
			if(num==2){
				whiteBack.style.height="1250px";
				pageFooter.style.top="1250px";
			}
			else{
				whiteBack.style.height="950px";
				pageFooter.style.top="950px";
			}
		}
		</script>
	</head>
	<body onload="initialize();">
		<div class="maincontainer">
			<div id="whiteb" class="bcontainer">
				<img class="banner" src="nhsheader3.png"/>
				<div class="menu">
					<div class="opt1"><a href="index.php">Home</a></div>
					<div class="opt2"><a href="information.php">General Information</a></div>
					<div class="opt3">
						<a href="committees.php">Committees</a>
					</div>
					<div class="opt4">
						<a href="">Check My Points</a>
					</div>
				</div>
				<div class="submenu">
					<div id="s0"style="border-bottom:2px solid white" onclick="changeContent(0);"class="subopt">Executive Board</div>
					<div id="s1" onclick="changeContent(1);" class="subopt">Mission Statement</div>
					<div id="s2" onclick="changeContent(2);" class="subopt">Frequently Asked Questions</div>
					<!--<div class="subopt">Constitution</div>-->
				</div>
				<div id="ccon"class="contentcontainer">
					<span id='ctitle' class='title'>NHS Executive Board (2016-2017)</span><br/>
					<div class='elist'>
						<div class='officers'>
							<span class='coln'>Officers</span><br/>
							<b>Co-Presidents</b><br/>Husna Ellis & Kiran Javaid <br/><i>hellis.nhs@gmail.com & kjavaid.nhs@gmail.com</i><br/><br/>
							<b>Vice President of Committees</b><br/>Hans Montero<br/> <i>hmontero.nhs@gmail.com</i><br/><br/>
							<b>Vice President of College Services</b><br/>Angie Yu<br/><i>angieyu.nhs@gmail.com</i><br/><br/>
							<b>Secretary</b><br/>Nicole Gendler<br/> <i>ngendler.nhs@gmail.com</i><br/><br/>
							<b>Treasurer</b><br/>Jasur Abdurazzakov<br/><i>jabdurazzakov0272@bths.edu</i><br/><br/>
							<b>Parliamentarian</b><br/>Chloe Wong<br/> <i>cwong0456@bths.edu</i><br/><br/>
							<b>Historian</b><br/>Sarah Flynn<br/><i>sflynn7519@bths.edu</i><br/><br/>
						</div>
						<div class='chairs'>
							<span class='coln'>Committee Chairpeople</span><br/>
							<div class='col1'>
								<b>Academic Recognition</b><br/>Tanzina Islam<br/><i>tislam4599@bths.edu</i><br/><br/>
								<b>Alumni Services</b><br/>Tiffany Voon<br/> <i>tvoon1410@bths.edu</i><br/><br/>
								<b>Club Team Council</b><br/>Laura Chen<br/><i>lchen1733@bths.edu</i><br/><br/>
								<b>College Services</b><br/>Joey Jiemjitpolchai<br/> <i>jjiemjitpolchai9540@bths.edu</i><br/><br/>
								<b>Community Services</b><br/>Michelle Wong<br/><i>mwong9708@bths.edu</i><br/><br/>
								<b>Fundraising</b><br/>Nabila Basar<br/><i>nbasar3600@bths.edu</i><br/><br/>
								<b>Induction</b><br/>Mei Lin Zheng<br/><i>mzheng7988@bths.edu</i><br/><br/>
							</div>
							<div class='col2'>
								<b>Mentoring</b><br/>Ekok Soubir & Carmen Chen<br/> <i>esoubir6205@bths.edu & cchen5239@bths.edu</i><br/><br/>
								<b>Parent Services</b><br/>Nour Haredy<br/><i>nharedy9977@bths.edu</i><br/><br/>
								<b>Recycling</b><br/>Doruntina Fida<br/> <i>dfida6514@bths.edu</i><br/><br/>
								<b>School Environment</b><br/>Vivian Su<br/><i>vsu0170@bths.edu</i><br/><br/>
								<b>Tutoring</b><br/>Jin Ming Lin<br/><i>jlin3291@bths.edu</i><br/><br/>
							</div>
						</div>
					</div>
				</div>
				<div id="foot" class="footer">Brooklyn Technical High School National Honor Society 2016-2017</div>
			</div>
		</div>
	</body>
</html>