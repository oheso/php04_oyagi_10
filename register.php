<?php
require_once ('functions.php');
$user_pdo = user_db_conn();

$user_name = $_POST['user_name'];
$lid = $_POST['lid'];
$lpw = password_hash($_POST['lpw'], PASSWORD_DEFAULT);

$user_stmt = $user_pdo->prepare("INSERT INTO gs_user_table(user_id,user_name,lid,lpw)VALUES(NULL,:user_name,:lid,:lpw)");
$user_stmt->bindValue(':user_name', $user_name, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$user_stmt->bindValue(':lid', $lid, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$user_stmt->bindValue(':lpw', $lpw, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$user_status = $user_stmt->execute();
if($user_status==false){
    $error = $user_stmt->errorInfo();
    exit("エラーメッセージ:".$error[2]);
}else{
    echo '<p>ユーザー登録が完了しました。</p>';
}
// var_dump ($name);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ユーザー登録完了画面</title>
</head>
<body>
    <a href="index.php">ログイン画面へ戻る</a>
</body>
</html>