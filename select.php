<?php
session_start();
require_once ('functions.php');
sessionCheck();
$pdo = db_conn();
$user_pdo = user_db_conn();

//２．データ取得SQL作成
$stmt = $pdo->prepare("SELECT * FROM gs_bm_table");
$status = $stmt->execute();

//３．データ表示
$view="";
if ($status == false) {
    //execute（SQL実行時にエラーがある場合）
  $error = $stmt->errorInfo();
  exit("ErrorQuery:".$error[2]);
} else {
  //Selectデータの数だけ自動でループしてくれる
  //FETCH_ASSOC=http://php.net/manual/ja/pdostatement.fetch.php
  while( $result = $stmt->fetch(PDO::FETCH_ASSOC)){//←一つずつ取ってくるという定型文
    $view .= '<tr>';
    $view .= '<td>'.$result['indate'].'</td>';
    $view .= '<td><a href="'.$result['url'].'" target=”_blank”>'.$result['name'].'</a>'.'</td>';
    $view .= '<td>'.$result['text'].'</td>';
    $view .= '<td><a href="detail.php?id='.$result["id"].'">編集</a>';
    $view .= '<br>';
    $view .= '<a href="delete.php?id='.$result["id"].'">削除</a></td>';
    $view .= '</tr>';
  }
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>お薦め書籍一覧</title>
<link rel="stylesheet" href="css/range.css">
<link href="css/bootstrap.min.css" rel="stylesheet">
<style>div{padding: 10px;font-size:16px;}</style>
</head>
<body id="main">
<!-- Head[Start] -->
<header>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
      <div class="navbar-header">
      <a class="navbar-brand" href="bookmark_form.php">お薦め書籍新規登録へ</a>
      <br>
      <a  class="navbar-brand" href="user_mgr.php">ユーザー管理画面へ</a>
      </div>
    </div>
  </nav>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
  <div>
    <div class="container jumbotron">
      <table border="1">
          <tr>
              <th>最終編集日時</th>
              <th>書籍名</th>
              <th>お薦め理由</th>
              <th>編集<br>削除</th>
          </tr>
          <?= $view ?>
      </table>
    </div>
    <div class="navbar-header"><a class="navbar-brand" href="logout.php">ログアウト</a></div>

<!-- Main[End] -->

</body>
</html>
