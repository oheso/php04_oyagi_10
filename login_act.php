<?php
//最初にSESSIONを開始！！ココ大事！！
session_start();

//POST値
$lid = $_POST['lid'];
$lpw = $_POST['lpw'];

//1.  DB接続します
include("functions.php");
$user_pdo = user_db_conn();

//2. データ登録SQL作成
$user_stmt = $user_pdo->prepare("SELECT * FROM gs_user_table WHERE lid=:id");
$user_stmt->bindValue(':id', $lid, PDO::PARAM_STR);
$user_status = $user_stmt->execute(); // 実行する

//3. SQL実行時にエラーがある場合STOP
if($user_status==false){
    user_sql_error($user_stmt);
}

//4. 抽出データ数を取得
$val = $user_stmt->fetch();  //1レコードだけ取得する方法
//$count = $stmt->fetchColumn(); //SELECT COUNT(*)で使用可能()

//5. 該当レコードがあれば$_SESSIONに値を代入
if(password_verify($lpw, $val["lpw"]) && $val["kanri_flg"] == 0 && $val["life_flg"] == 1){ //* PasswordがHash化の場合はこっちのIFを使う
// if( $val["user_id"] != "" && $val["kanri_flg"] == 0 ){
    //Login成功時
    $_SESSION["chk_ssid"]  = session_id();
    $_SESSION["kanri_flg"] = $val['kanri_flg'];
    $_SESSION["life_flg"] = $val['life_flg'];
    $_SESSION["user_name"] = $val['user_name'];
    header('Location: select0.php');
    // echo 1;
// } elseif ( $val["user_id"] != "" && $val["kanri_flg"] == 1 ) {
} elseif (password_verify($lpw, $val["lpw"]) && $val["kanri_flg"] == 1 && $val["life_flg"] == 1) {
    $_SESSION["chk_ssid"]  = session_id();
    $_SESSION["kanri_flg"] = $val['kanri_flg'];
    $_SESSION["life_flg"] = $val['life_flg'];
    $_SESSION["user_name"] = $val['user_name'];
    header('Location: select.php');
    // echo 2;
} else {
    //Login失敗時(Logout経由)
    // header('Location: login.php');
    $err = '<h3>ログインできませんでした</h3>';
    echo $err;
    echo '<a class="navbar-brand" href="login.php">ログイン画面へ戻る</a>';
    // echo 3;
}
exit();
?>