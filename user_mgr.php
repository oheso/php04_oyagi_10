<?php
session_start();
require_once ('functions.php');
sessionCheck();
$user_pdo = user_db_conn();

//２．データ取得SQL作成
$user_stmt = $user_pdo->prepare("SELECT * FROM gs_user_table");
$user_status = $user_stmt->execute();

//３．データ表示
$user_view="";
if ($user_status == false) {
    //execute（SQL実行時にエラーがある場合）
  $error = $user_stmt->errorInfo();
  exit("ErrorQuery:".$error[2]);
} else {
  //Selectデータの数だけ自動でループしてくれる
  //FETCH_ASSOC=http://php.net/manual/ja/pdostatement.fetch.php
  while( $user_result = $user_stmt->fetch(PDO::FETCH_ASSOC)){//←一つずつ取ってくるという定型文
    if (($user_result['kanri_flg']) == 0){
      $kanri_flg = '一般';
    } else {
      $kanri_flg = '管理者';
    }
    if (($user_result['life_flg']) == 0){
      $life_flg = '無効';
    } else {
      $life_flg = '有効';
    }
    $user_view .= '<tr>';
    $user_view .= '<td>'.$user_result['user_name'].'</td>';
    $user_view .= '<td>'.$user_result['lid'].'</td>';
    $user_view .= '<td>'.$kanri_flg.'</td>';
    $user_view .= '<td>'.$life_flg.'</td>';
    $user_view .= '<td><a href="user_detail.php?user_id='.$user_result["user_id"].'">編集</a>';
    $user_view .= '<br>';
    $user_view .= '<a href="user_delete.php?user_id='.$user_result["user_id"].'">削除</a></td>';
    $user_view .= '</tr>';
  }
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>ユーザー管理</title>
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
      <a class="navbar-brand" href="select.php">メイン画面へ戻る</a>
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
              <th>ユーザー名</th>
              <th>ログインID</th>
              <th>管理者/一般</th>
              <th>有効/無効</th>
              <th>編集<br>削除</th>
          </tr>
          <?= $user_view ?>
      </table>
    </div>
  </div>
<!-- Main[End] -->

</body>
</html>
