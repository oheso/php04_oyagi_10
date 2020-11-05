<?php
session_start();
require_once ('functions.php');
sessionCheck();

//1. POSTデータ取得
$user_name = $_POST["user_name"];
$lid = $_POST["lid"];
$lpw = $_POST["lpw"];
if (isset($_POST['kanri_flg'])){
    $kanri_flg = 1;
    $kanri_flg_str = '管理者';    
} else {
    $kanri_flg = 0;
    $kanri_flg_str = '一般';
}
if (isset($_POST['life_flg'])){
    $life_flg = 1;
    $life_flg_str = '有効';
} else {
    $life_flg = 0;
    $life_flg_str = '無効';
}
$user_id = $_POST["user_id"];
$user_pdo = user_db_conn();

//３．データ登録SQL作成
$user_stmt = $user_pdo->prepare("UPDATE gs_user_table SET user_name=:user_name,lid=:lid,lpw=:lpw,kanri_flg=:kanri_flg,life_flg=:life_flg WHERE user_id=:user_id;");
$user_stmt->bindValue(':user_name', $user_name, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$user_stmt->bindValue(':lid', $lid, PDO::PARAM_STR);    //Integer（数値の場合 PDO::PARAM_INT)
$user_stmt->bindValue(':lpw', $lpw, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$user_stmt->bindValue(':kanri_flg', $kanri_flg, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$user_stmt->bindValue(':life_flg', $life_flg, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$user_stmt->bindValue(':user_id', $user_id, PDO::PARAM_INT);      //Integer（数値の場合 PDO::PARAM_INT)
$user_status = $user_stmt->execute(); //実行

//４．データ登録処理後
if ($user_status == false) {
    user_sql_error($user_stmt);
} else {
    $user_stmt = $user_pdo->prepare("SELECT * FROM gs_user_table WHERE user_id=".$user_id);
    $user_status = $user_stmt->execute();
    $user_result = $user_stmt->fetch();
}
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ユーザー情報編集結果</title>
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

    <!-- Main[Start] -->
    <form method="POST" action="update.php">
    <div class="jumbotron">
    <fieldset>
        <legend>ユーザー情報編集結果</legend>
        <label>ユーザー名：<?php print ($user_result["user_name"]) ?></label><br>
        <label>ログインID：<?= $user_result["lid"] ?></label><br>
        <label>パスワード：<?= $user_result["lpw"] ?></label><br>
        <label>管理者/一般：<?= $kanri_flg_str ?></label><br>
        <label>有効/無効：<?= $life_flg_str ?></label><br>
        <input type="hidden" name="user_id" value=<?= $user_result["user_id"] ?>>
        </fieldset>
    </div>
    </form>
    <!-- Main[End] -->

</body>

</html>