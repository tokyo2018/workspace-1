<?php
require_once("..//database.php");
require_once("..//classes.php");
//step1 

//step2
$pdo = connectDatabase();
$sql = "select * from areas ";
//step4
$psttmt = $pdo->prepare($sql);

//step5

//step6
$psttmt->execute();
//step7
$rs = $psttmt->fetchAll();
//step8
disconnectDatabase($pdo);

$area = [];
foreach ($rs as $record){
    $id = intval($record["id"]);
    $name = $record["name"];
    $area = new Area($id, $name);
    $areas[] = $area;
}
//echo "2020-020-04 tue.";
//exit(0);
?>
<!DOCTYPE html>
<html lang="ja">
	<head>
		<meta charset="utf-8" />
		<title>PDOを使ってみる</title>
	</head>
	<body>
		<h1>PDOを使ってみる</h1>
		<h2>地域を選択する</h2>
		<form action="restaurants.php" method="get">
		<select name="area">
			<option value="0">-- 選択してください --</option>
			<?php foreach ($areas as $area){ ?>
			<option value="<?= $area->getId() ?>"><?= $area->getName()?></option>
			<?php } ?>
		
		</select>
		<input type="submit" value="選択" />
		</form>
	</body>
</html>
