<?php
	$myName = "Urmas Riis";
	$datetime = date("d.m.Y H:i:s");
	//<p>Lehe avamise hetkel oli: <strong> 31.01.2020 11:26:12</strong><p>
	$timeHTML = "<p>Lehe avamise hetkel oli: <strong>".$datetime."</strong></p> \n";
	$hour = date("H");
	$partofday = "Hägune aeg";
	if ($hour < 10) {
		$partofday = "hommik";
	}
	if ($hour >= 10 and $hour <18){
		$partofday = "aeg aktiivsel tegutseda";
	}
	$partofdayHTML = "<p>Käes on ".$partofday."!</p> \n";
	$semesterStart = new DateTime("2020-01-27");
	$semesterEnd = new DateTime("2020-06-22");
	$semesterDuration = $semesterStart->diff($semesterEnd);
	//echo $semesterDuration;
	//var_dump($semesterDuration);
	
	$today = new DateTime("now");
	$fromSemesterStart = $semesterStart->diff($today);
	
	//<p>Semester on hoos: <meter value="" min="0" max=""></meter></p>
	$semesterProgressHTML = '<p>Semester on hoos: <meter min="0" max="'.$semesterDuration->format("%r%a").'" value="'.$fromSemesterStart->format("%r%a").'"></meter>.</p>'."\n";
	
	//loen etteantud kataloogist pildifailid (/img)
	$picsDir = "../../img/";
	$photoTypesAllowed = ["image/jpeg", "image/png"];
	$photoList = [];
	$allFiles = array_slice(scanDir($picsDir),2);
	//var_dump($allFiles);
	foreach($allFiles as $file) {
		$fileInfo = getimagesize($picsDir .$file);
		if (in_array($fileInfo["mime"], $photoTypesAllowed)){
			array_push($photoList,$file);
		}
	}
	$photoCount = count($photoList);
	$photoNum = mt_rand(0,$photoCount-1);
	$randomImageHTML = '<img src="'.$picsDir .$photoList[$photoNum] .'" alt = "ggpiltipole">' ."\n";
?>

<!DOCTYPE html>
<html lang="et">
<head>
	<meta charset="utf-8">
	<title>Veebirakendused ja nende loomine 2020</title>
	<p><?php echo $datetime ?></p>
</head>
<body>
	<h1><?php echo $myName ?></h1>
	<p>See leht on valminud õppetöö raames!</p>
	<?php
		echo $timeHTML;
		echo $partofdayHTML;
		echo $semesterProgressHTML;
		echo $randomImageHTML;
	?>
</body>
</html>