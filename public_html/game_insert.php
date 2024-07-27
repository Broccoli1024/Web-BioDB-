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

if (isset($_GET["url"]) && $_GET["url"] != "") {
    $gurl = $_GET["url"];
}
else {
    $gurl = "%";
}


$sql_in_game="insert into GAME(tytle,releasedate,img,cero,GAME.url,maker) values (:tytle,:releasedate,:img,:cero,:gurl,:maker)";


try{

        $stmh=$pdo->prepare($sql_in_game);

        $stmh->bindvalue(":maker","{$maker}",PDO::PARAM_STR);
	    $stmh->bindvalue(":tytle","{$tytle}",PDO::PARAM_STR);
        $stmh->bindvalue(":releasedate","{$releasedate}",PDO::PARAM_STR);
        $stmh->bindvalue(":cero","{$cero}",PDO::PARAM_STR);
        $stmh->bindvalue(":img","{$img}",PDO::PARAM_STR);
        $stmh->bindvalue(":gurl","{$gurl}",PDO::PARAM_STR);

        $stmh->execute();

        $count=$stmh->rowCount();

        print "データを{$count}件追加しました。<br><br>";

} catch(PDOException $Exception){
        die("エラー:".$Exception->getMessage());

}


##GAMEテーブル確認

try{
        $sql = "select * from GAME";
        
        $stmh=$pdo->prepare($sql);
        $stmh->execute();

} catch(PDOException $Exception){
        die("DB検索エラー:".$Exception->getMessage());

}
?>

<table border='1' cellpadding='2' cellspacing='0'>
<thead>
<tr bgcolor="#00CCCC"><th>gameID</th><th>tytle</th><th>releasedate</th><th>CERO</th>
<th>image</th><th>GameURL</th><th>maker</th></tr>
</thead>
<tbody>

<?php


$result=$stmh->fetchAll(PDO::FETCH_ASSOC);

foreach($result as $row){
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
    print htmlspecialchars($row["url"],ENT_QUOTES);
	print "</td><td>";
    print htmlspecialchars($row["maker"],ENT_QUOTES);
	print "</td></tr>\n";

}



?>
</body>
</html>