<!DOCTYPE html>
<html lang="ja">

<head>
<meta charset="UTF-8">
<title>result</title>
</head>
<body>

<?php
header('Content-Type:text/html; charset=UTF-8');

require('login.php');

if (isset($_GET["gameID"]) && $_GET["gameID"] != "") {
        $id = $_GET["gameID"];
}
else {
        $id = "%";
}
if (isset($_GET["releasedate"]) && $_GET["releasedate"] != "") {
        $releasedate = $_GET["releasedate"];
} else {
        $releasedate = "%";
}


if (isset($_GET["tytle"]) && $_GET["tytle"] != "") {
        $tytle = $_GET["tytle"];
}
else {
        $tytle = "%";
}

if (isset($_GET["maker"]) && $_GET["maker"] != "") {
        $maker = $_GET["maker"];
}
else {
        $maker = "%";
}

if (isset($_GET["establish"]) && $_GET["establish"] != "") {
        $establish = $_GET["establish"];
}

if (isset($_GET["area"]) && $_GET["area"] != "") {
        $area = $_GET["area"];
}
else {
        $area = "%";
} 

if (isset($_GET["cero"]) && $_GET["cero"] != "") {
        $cero = $_GET["cero"];
}
else {
        $cero = "%";
}

if (isset($_GET["img"]) && $_GET["img"] != "") {
        $img = $_GET["img"];
}
else {
        $img = "%";
}




$sql = "
select gameID, tytle, releasedate, CERO, GAME.maker, img, GAME.url as gameurl, establish, area, Company.url as comurl
from GAME,Company
where (GAME.maker = Company.maker)
and(gameID like :id)
and (GAME.maker like :maker) 
and (tytle like :tytle) 
and (area like :area) 
and (CERO like :cero) 
and (releasedate like :releasedate) 
and (img like :img) 
";


if(isset($establish)) {
  $sql = "$sql and (establish <= :establish)";
}

try{

        $stmh=$pdo->prepare($sql);

	$stmh->bindvalue(":id","{$id}",PDO::PARAM_STR);
        $stmh->bindvalue(":maker","%{$maker}%",PDO::PARAM_STR);
	$stmh->bindvalue(":tytle","%{$tytle}%",PDO::PARAM_STR);
        $stmh->bindvalue(":releasedate","%{$releasedate}%",PDO::PARAM_STR);
	$stmh->bindvalue(":area","%{$area}%",PDO::PARAM_STR);
        $stmh->bindvalue(":cero","{$cero}",PDO::PARAM_STR);
        $stmh->bindvalue(":img","{$img}",PDO::PARAM_STR);

        if(isset($establish)) {
                $stmh->bindvalue(":establish","$establish",PDO::PARAM_INT);
        }
	
        $stmh->execute();

        $count=$stmh->rowCount();

        print "検索結果は{$count}件です。<br><br>";

} catch(PDOException $Exception){
        die("DB検索エラー:".$Exception->getMessage());

}

?>

<table border='1' cellpadding='1' cellspacing='1'>
<thead>
<tr bgcolor="#00CCCC"><th>gameID</th><th>tytle</th><th>releasedate</th><th>CERO</th>
<th>image</th><th>GameURL</th><th>maker</th><th>establish</th><th>area</th><th>CompanyURL</th><th>テーブルの削除</th></tr>
</thead>
<tbody>

<?php
 
$result=$stmh->fetchAll(PDO::FETCH_ASSOC);

foreach($result as $row) {
        /*search_get.phpとここだけ異なる
	<a>タグを入れてリンクを貼っている*/
	//
        print "<tr><td>"; 
        print htmlspecialchars($row["gameID"],ENT_QUOTES);
	print "</td><td>";
        print "<a href='./link2pdb.php?tytle=".htmlspecialchars($row["tytle"],ENT_QUOTES)."'>";
	print htmlspecialchars($row["tytle"],ENT_QUOTES);
	print "</a>";
        print "</td><td>";
        print htmlspecialchars($row["releasedate"],ENT_QUOTES);
	print "</td><td>";
	print htmlspecialchars($row["CERO"],ENT_QUOTES);
	print "</td><td>";
        print "<img src='images/".htmlspecialchars ($row["img"],ENT_QUOTES)."' width=100% height=100%>";
	print "</td><td>";
        print htmlspecialchars($row["gameurl"],ENT_QUOTES);
	print "</td><td>";
        print htmlspecialchars($row["maker"],ENT_QUOTES);
	print "</td><td>";
        print htmlspecialchars($row["establish"],ENT_QUOTES);
	print "</td><td>";
        print htmlspecialchars($row["area"],ENT_QUOTES);
	print "</td><td>";
	print htmlspecialchars($row["comurl"],ENT_QUOTES);
        print "</td><td>";
        print "<a href='./pro_delete.php?tytle=".$row["tytle"]."'>削除する</a>";
        print "</td></tr>\n";
}
?>

</tbody></table>
<h4><a href="search_form.php" target="_blank">検索ページに戻る</a></h4>
</body>
</html>
