<?php
session_start();
require_once ('functions.php');
sessionCheck();
$user_pdo = user_db_conn();
var_dump ($_SESSION["kanri_flg"]);
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>お薦め書籍新規登録</title>
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <style>div{padding: 10px;font-size:16px;}</style>
</head>
<body>

<!-- Head[Start] -->
<header>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
    <div class="navbar-header"><a class="navbar-brand" href="select0.php">メイン画面へ戻る</a></div>
    </div>
  </nav>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<form method="POST" action="insert0.php">
  <div class="jumbotron">
   <fieldset>
    <legend>あなたのお薦め書籍を登録してください♪</legend>
     <label>書籍名：<input type="text" name="name"></label><br>
     <label>URL：<input type="url" name="url"></label><br>
     <label>お薦め理由：<textArea name="text" rows="4" cols="40"></textArea></label><br>
     <input type="submit" value="登録">
    </fieldset>
  </div>
</form>
<!-- Main[End] -->


</body>
</html>
