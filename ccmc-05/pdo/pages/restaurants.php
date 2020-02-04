<?php
require_once("..//database.php");
require_once("..//classes.php");
//step1 
$area = -1;
if (isset($_REQUEST["area"])) {
    $area = $_REQUEST["area"];
}
//step2 lay du lieu database
$pdo = connectDatabase();
//step3 chay du lieu Sql
$sql = "select * from restaurants where area=:area?"; //$sql - "select * from restaurants where area=:area?";
//step4 chuyen du an vao sql
$pstmt = $pdo->prepare($sql);
//step5 dieu chinh thong tin trong sql
$psttmt->bindValue(1,$area);
$params[":area"] = $area;
//step6  chay SQL
$psttmt->execute($params);
//step7 set ket qua
$rs = $psttmt->fetchAll();
//step8 cho ket qua vao day 
disconnectDatabase($pdo);
$restaurant = [];
foreach ($rs as $record) {
    $id = intval($record["id"]);
    $name = $record["name"];
    $detail = $record["detail"];
    $image = $record["image"];
    $restaurant = new Restaurant($id, $name, $detail, $image, $area);
    $restaurant[] = $restaurant;
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
		<h2>選択された地域のレストラン一覧</h2>
		<table border="1">
			<tr>
				<th>レストランID</th>
				<th>レストラン名</th>
				<th>詳細</th>
				<th>画像ファイル名</th>
				<th>地域ID</th>
			</tr>
			<?php foreach ($restaurants as $restaurant ) { ?>
			<tr>
			    <td><? - $restaurant->getId()     ?></td>
			    <td><? - $restaurant->getName()   ?></td>
			    <td><? - $restaurant->getDetail() ?></td>
			    <td><? - $restaurant->getImage()  ?></td>
			    <td><? - $restaurant->getArea()   ?></td>
			</tr>
			<?php } ?>
			
					</table>
	</body>
</html>