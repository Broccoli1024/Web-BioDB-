<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>Webページ</title>
  <link rel="stylesheet" type="text/css" href="search_form.css">

<title>Database games</title>
</head>
<body bgcolor="white">
<header class="header-nav">
  <nav><a href="#first-block">検索</a></nav>
  <nav><a href="#second-block">一覧</a></nav>
  <nav><a href="#third-block">追加</a></nav>
</header>
<section id="first-block">
    <div class="title-container">
    <h2>Search Games</h2>
    </div>
  </section>
<form action="./search_get.php" method="get"> 
<table>
<tr><td valign="top">gameID:</td>
    <td>
      <input type="text" name="gameID" size="10">
    </td>
</tr>
<tr><td valign="top">tytle:</td>
    <td>
      <input type="text" name="tytle" size="10">
    </td>
</tr>
<tr><td valign="top">releasedate:</td>
    <td>
      <input type="text" name="releasedate" size="10">
    </td>
</tr>
<tr><td valign="top">maker:</td>
  <td>
    <input type="text" name="maker" size="10">
  </td>
</tr>
<tr><td valign="top">establish<= </td>
    <td>
      <input type="text" name="establish" size="10">
    </td>
</tr>
<tr><td valign="top">CERO:</td>
    <td>
      <select name="cero">
         <option value="">Any
	  <option value="A">A
	  <option value="B">B
	  <option value="C">C
    <option value="D">D
    <option value="Z">Z
    </select>
    </td>
</tr>
</table>
<input type="submit" value="search">
</form>
<section id="second-block">
<table border="2">
<div class = show>
<?php
header('Content-Type:text/html; charset=UTF-8');

require('login.php');

if (isset($_GET["tytle"]) && $_GET["tytle"] != "") {
        $tytle = $_GET["tytle"];
}
else {
        $tytle = "%";
}

if (isset($_GET["img"]) && $_GET["img"] != "") {
        $img = $_GET["img"];
}
else {
        $img = "%";
}

$sql = "
select tytle,img
from GAME
where (tytle like :tytle)
and (img like :img)
";

try{

        $stmh=$pdo->prepare($sql);
	      $stmh->bindvalue(":tytle","%{$tytle}%",PDO::PARAM_STR);
        $stmh->bindvalue(":img","{$img}",PDO::PARAM_STR);
	
        $stmh->execute();

        $count=$stmh->rowCount();

        print "全部で{$count}件です。<br><br>";

} catch(PDOException $Exception){
        die("DB検索エラー:".$Exception->getMessage());

}
$result=$stmh->fetchAll(PDO::FETCH_ASSOC);
$i = 0;
foreach($result as $row) {
        /*search_get.phpとここだけ異なる
	<a>タグを入れてリンクを貼っている*/
	//
  if($i % 3 == 0){
  print "<tr>";
  print "<td wigth=100>";
  print"<h4>";
  print "<a href='./link2pdb.php?tytle=".htmlspecialchars($row["tytle"],ENT_QUOTES)."'>";
	print htmlspecialchars($row["tytle"],ENT_QUOTES);
  print"</h4>";
  print "<br>";
  print "<img src='images/".htmlspecialchars ($row["img"],ENT_QUOTES)."' width=100% height=100%>";
  print "<br><br><br></td>";
  }else if($i % 3 == 1) {
  print"<td>";
  print"<h4>";
  print "<a href='./link2pdb.php?tytle=".htmlspecialchars($row["tytle"],ENT_QUOTES)."'>";
	print htmlspecialchars($row["tytle"],ENT_QUOTES);
  print"</h4>";
  print "<br>";
  print "<img src='images/".htmlspecialchars ($row["img"],ENT_QUOTES)."' width=100% height=100%>";
  print "<br><br><br></td>";
  }else if($i % 3 == 2) {
  print"<td>";
  print"<h4>";
  print "<a href='./link2pdb.php?tytle=".htmlspecialchars($row["tytle"],ENT_QUOTES)."'>";
	print htmlspecialchars($row["tytle"],ENT_QUOTES);
  print"</h4>";
  print "<br>";
  print "<img src='images/".htmlspecialchars ($row["img"],ENT_QUOTES)."' width=100% height=100%>";
  print "<br><br><br></td></tr>";
  }
  $i++;
}
?>

<table border="2">
<section id="third-block">
<p class="insert">
<h4><a href="game_insert_form.html" target="_blank">ゲームを追加</a></h4>
<h4><a href="company_insert_form.html" target="_blank">企業を追加</a></h4>
</section>
<footer>
    <small>© 2024 前田陸</small>
</footer>
</body>
</html>
