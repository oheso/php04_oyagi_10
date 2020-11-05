<?php
// XSS対策：エスケープ処理
function h($str){
    return htmlspecialchars($str, ENT_QUOTES, 'utf-8');
}

//DB接続関数：db_conn()
function db_conn(){
    try {
        $db_name = "gs_bm";    //データベース名
        $db_id   = "root";      //アカウント名
        $db_pw   = "root";      //パスワード：XAMPPはパスワード無しに修正してください。
        $db_host = "localhost"; //DBホスト
        $pdo = new PDO('mysql:dbname='.$db_name.';charset=utf8;host='.$db_host, $db_id, $db_pw);
        return $pdo;
    } catch (PDOException $e) {
        exit('DB Connection Error:'.$e->getMessage());
    }
}

//DB接続関数：user_db_conn()
function user_db_conn(){
    try {
        $db_name = "gs_db";    //データベース名
        $db_id   = "root";      //アカウント名
        $db_pw   = "root";      //パスワード：XAMPPはパスワード無しに修正してください。
        $db_host = "localhost"; //DBホスト
        $user_pdo = new PDO('mysql:dbname='.$db_name.';charset=utf8mb4;host='.$db_host, $db_id, $db_pw);
        return $user_pdo;
    } catch (PDOException $e) {
        exit('DB Connection Error:'.$e->getMessage());
    }
}

//SQLエラー関数：sql_error($stmt)
function sql_error($stmt){
    $error = $stmt->errorInfo();
    exit("SQLError:".$error[2]);
}

function user_sql_error($user_stmt){
    $error = $user_stmt->errorInfo();
    exit("SQLError:".$error[2]);
}

//リダイレクト関数: redirect($file_name)
function redirect($file_name){
    header("Location:".$file_name);
    exit();
}

// ログインチェク処理
function sessionCheck(){
    if (!isset($_SESSION['chk_ssid']) || $_SESSION['chk_ssid'] != session_id()){
        // ログインに異常があった場合
        exit('LOGIN Error');
    } else {
        // 正しくログインできた場合、セッションIDを更新
        session_regenerate_id(true);
        $_SESSION['chk_ssid'] = session_id();
    }
}

?>