<!DOCTYPE html>
<html lang="ja">

<head>
<meta charset="UTF-8">
<title>PDB Info.</title>
</head>
<body>

<?php
header('Content-Type:text/html; charset=UTF-8');
require('login.php');


if (isset($_GET["tytle"]) && $_GET["tytle"] != "") {
        $tytle = $_GET["tytle"];
}
else {
        $tytle = "%";
}


$sql = "
select gameID, tytle, releasedate, CERO, GAME.maker, img, GAME.url as gameurl, establish, area, Company.url as comurl
from GAME,Company
where (GAME.maker = Company.maker)
and(tytle like :tytle)
";


try{

        $stmh=$pdo->prepare($sql);

	$stmh->bindvalue(":tytle","%{$tytle}%",PDO::PARAM_STR);
	
        $stmh->execute();

} catch(PDOException $Exception){
        die("DB検索エラー:".$Exception->getMessage());

}

 
$result=$stmh->fetchAll(PDO::FETCH_ASSOC);

$count=count($result);



?>
<head>
<title><?=$result[0]["gameID"]?></title>
</head>
<body>

<h1><?=$result[0]["tytle"]?></h1>
<img src="images/<?=$result[0]["img"]?>" width=30% height=30%>
<p><b>CERO:</b> <?=$result[0]["CERO"]?></br>
<b>releasedate:</b> <?=$result[0]["releasedate"]?> </p>

<h3><a href="<?=$result[0]["gameurl"]?>" target="_blank">購入はこちら</a></h3>
<?php

print "<ul><li><b>maker:</b> ".$result[0]["maker"]."</li>";
print "<li><b>establish:</b> ".$result[0]["establish"]."</li>";
print "<li><b>area:</b> ".$result[0]["area"]."</li>";
?>

<h3>企業URL: <a href="<?=$result[0]["comurl"]?>" target="_blank">link</a></h3>

<h4><a href="search_form.php" target="_blank">検索ページに戻る</a></h4>

</body>
</html>
