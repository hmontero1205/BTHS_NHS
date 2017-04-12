<?php
	session_start();
	$conn = new PDO("mysql:hostname=localhost;dbname=nhs", "root", "");

	if(isset($_GET['title'])){
		$pTitle = str_replace("'","''",$_GET['title']);
		$pDate = $_GET['date'];
		$pAnn = str_replace("'","''",$_GET['ann']);
		$pSig = $_SESSION['sig'];
		$pID = rand(100000000,999999999);
		$pCom = $_GET['com'];
		$addPost = $conn->prepare("INSERT INTO `posts`(`atitle`, `date`, `atext`, `signature`, `ID`, `committee`) VALUES ('{$pTitle}','{$pDate}','{$pAnn}','{$pSig}',{$pID},{$pCom})");
		$addPost->execute();
	}			
	if(isset($_GET['postID'])){
		$pNum = $_GET['postID'];
		$deletePost = $conn->prepare("DELETE FROM `posts` WHERE `ID` = {$pNum}");
		$deletePost->execute();
	}

	if(isset($_GET['mOsis'])){
		$memO = $_GET['mOsis'];
		$memV = $_GET['mVal'];
		$updateMemberCP1 = $conn->prepare("UPDATE `cpoints` SET `points` = {$memV} WHERE `osis` = {$memO}");
		$updateMemberCP1->execute();
	}
	if(isset($_GET['mOsis2'])){
		$memO2 = $_GET['mOsis2'];
		$memV2 = $_GET['mVal'];
		$updateMemberGP = $conn->prepare("UPDATE `gpoints` SET `points` = {$memV2} WHERE `osis` = {$memO2}");
		$updateMemberGP->execute();
	}


	if(isset($_GET['mArr'])) {
		$toUpdateArr = json_decode($_GET['mArr']);
		foreach ($toUpdateArr as $upMem){
			$upMem->points += $_GET['uPoints'];
			$updateMemberCP2 = $conn->prepare("UPDATE `cpoints` SET `points` = {$upMem->points} WHERE `osis` = {$upMem->osis}");
			$updateMemberCP2 ->execute();
		}

	}

	if(isset($_GET['mArrG'])){
		$toUpdateArrG = json_decode($_GET['mArrG']);
		$eventName = $_GET['evName'];
		$ePoints = $_GET['uPoints'];
		if($_GET['needNew']){
			echo $_GET['needNew'];
			$newEventCol = $conn->prepare("ALTER TABLE `gevents` ADD COLUMN {$eventName} INT(30) AFTER `osis` ");
			$newEventCol->execute();
		}
		foreach ($toUpdateArrG as $upMemG){
			$upMemG->points += $ePoints;
			$updateMemberGP2 = $conn->prepare("UPDATE `gpoints` SET `points` = {$upMemG->points} WHERE `osis` = {$upMemG->osis}");
			$updateMemberGP2 ->execute();
			$updateGPEvents = $conn->prepare("UPDATE `gevents` SET `{$eventName}` = {$ePoints} WHERE `osis` = {$upMemG->osis}");
			$updateGPEvents->execute();
		}
	}
	if(isset($_GET['mReq'])){
		$cNum = $_GET['mC'];
		$memArr2 = $conn->prepare("SELECT * FROM `cpoints` WHERE `committee` = {$cNum}");
		$memArr2->execute();
		echo json_encode($memArr2->fetchAll(PDO::FETCH_ASSOC));
	}

	if(isset($_GET['mReq2'])){
		$memArr3 = $conn->prepare("SELECT * FROM `gpoints`");
		$memArr3->execute();
		echo json_encode($memArr3->fetchAll(PDO::FETCH_ASSOC));
	}

	if(isset($_GET['sosis'])){
		$searchOsis = $_GET['sosis'];
		$searchCom =  $_GET['comn'];
		$getComPoints= $conn->prepare("SELECT * FROM `cpoints` WHERE `osis` = {$searchOsis}");
		$getComPoints->execute();
		$comPointsResult = $getComPoints->fetch(PDO::FETCH_ASSOC);
		if($getComPoints->rowCount() == 0 || $searchCom != $comPointsResult['committee']){
			echo "OSIS Number not recognized.";
		}
		else{
			echo  $comPointsResult['fname'].", you have ".$comPointsResult['points']." Committee Points.";
		}
	}
	if(isset($_GET['optReq'])){
		$getEvents = $conn->prepare("SELECT * FROM `gevents`");
		$getEvents->execute();
		echo json_encode($getEvents->fetchAll(PDO::FETCH_ASSOC));
	}
	if(isset($_GET['sosisG'])){
		$genOsis = $_GET['sosisG'];
		$getGenPoints = $conn->prepare("SELECT * FROM `gevents` WHERE `osis` = {$genOsis}");
		$getGenPoints->execute();
		echo json_encode($getGenPoints->fetchAll(PDO::FETCH_ASSOC));

	}
?>