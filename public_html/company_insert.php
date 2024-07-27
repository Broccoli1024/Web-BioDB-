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

if (isset($_GET["Company.url"]) && $_GET["Company.url"] != "") {
    $curl = $_GET["Compnay.url"];
}
else {
    $curl = "%";
}

$sql_in_company="insert into Company(maker,establish,area,Company.url) values (:maker,:establish,:area,:curl)"; 

try{

    $stmh=$pdo->prepare($sql_in_company);

    $stmh->bindvalue(":maker","{$maker}",PDO::PARAM_STR);
    $stmh->bindvalue(":area","{$area}",PDO::PARAM_STR);
    $stmh->bindvalue(":curl","{$curl}",PDO::PARAM_STR);
    if(isset($establish)) {
        $stmh->bindvalue(":establish","$establish",PDO::PARAM_INT);
    }

    $stmh->execute();

    $count=$stmh->rowCount();

    print "データを{$count}件追加しました。<br><br>";

} catch(PDOException $Exception){
    die("エラー:".$Exception->getMessage());

}


##Companyテーブル確認

try{
        $sql = "select * from Company";
        
        $stmh=$pdo->prepare($sql);
        $stmh->execute();

} catch(PDOException $Exception){
        die("DB検索エラー:".$Exception->getMessage());

}
?>

<table border='1' cellpadding='2' cellspacing='0'>
<thead>
<tr bgcolor="#00CCCC"><th>maker</th><th>establish</th><th>area</th><th>CompanyURL</th></tr>
</thead>
<tbody>

<?php


$result=$stmh->fetchAll(PDO::FETCH_ASSOC);

foreach($result as $row){
    print "<tr><td>"; 
    print htmlspecialchars($row["maker"],ENT_QUOTES);
	print "</td><td>";
    print htmlspecialchars($row["establish"],ENT_QUOTES);
	print "</td><td>";
    print htmlspecialchars($row["area"],ENT_QUOTES);
	print "</td><td>";
	print htmlspecialchars($row["url"],ENT_QUOTES);
	print "</td></tr>\n";
}



?>
</body>
</html>