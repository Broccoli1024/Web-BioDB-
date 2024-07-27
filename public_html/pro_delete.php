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


if (isset($_GET["tytle"]) && $_GET["tytle"] != "") {
        $tytle = $_GET["tytle"];
}

if(isset($tytle)){


	$sql_in="delete from GAME where (tytle = :tytle)";


	try{

		$stmh=$pdo->prepare($sql_in);

		$stmh->bindvalue(":tytle","$tytle",PDO::PARAM_STR);

		$stmh->execute();

		print "[tytle:{$tytle}]のレコードを削除しました<br><br>";

	} catch(PDOException $Exception){
		die("エラー:".$Exception->getMessage());

	}
}

##データベース確認+削除する自身のphpへのリンク

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
<tr bgcolor="#00CCCC"><th>gameID</th><th>tytle</th><th>image</th><th>maker</th><th></th></tr>
</thead>
<tbody>

<?php


$result=$stmh->fetchAll(PDO::FETCH_ASSOC);

foreach($result as $row){
	print "<tr><td>"; 
	print htmlspecialchars($row["gameID"],ENT_QUOTES);
	print "</td><td>";
	print htmlspecialchars($row["tytle"],ENT_QUOTES);
	print "</td><td>";
	print htmlspecialchars($row["img"],ENT_QUOTES);
	print "</td><td>";
	print htmlspecialchars($row["maker"],ENT_QUOTES);
	print "</td><td>";
	print "<a href='./pro_delete.php?tytle=".$row["tytle"]."' onclick=\"return confirm('tytle=".$row["tytle"]."を削除してもよろしいですか?')\">削除する</a>";
	print "</td><tr>\n";

}

?>
<h4><a href="search_form.php" target="_blank">検索ページに戻る</a></h4>
</body>
</html>