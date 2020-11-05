<?php
session_start();
require_once ('functions.php');
sessionCheck();

$user_id = $_GET['user_id'];
$user_pdo = user_db_conn();
$user_stmt = $user_pdo->prepare('DELETE FROM gs_user_table WHERE user_id=:user_id');
$user_stmt->bindValue(':user_id', $user_id, PDO::PARAM_INT);
$user_status = $user_stmt->execute(); //実行

//４．データ登録処理後
if ($user_status == false) {
    user_sql_error($user_stmt);
} else {
    $user_result = '削除成功';
}
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ユーザーデータ削除</title>
    <link rel="stylesheet" href="css/range.css">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <style>
        div {
            padding: 10px;
            font-size: 16px;
        }
    </style>
</head>

<body id="main">
    <!-- Head[Start] -->
    <header>
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand" href="user_mgr.php">ユーザー管理へ戻る</a>
                </div>
            </div>
        </nav>
    </header>
    <!-- Head[End] -->
    <h2><?= $user_result ?></h2>
</body>

</html>