<?php
// require_once 'login_act.php';
// $err = $_SESSION;
// $_SESSION = array();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ログイン画面</title>
</head>
<body>
    <h2>ログインフォーム</h2>
    <form name="form1" action="login_act.php" method="POST">
        <p>
            <label for="lid">ログインID：</label>
            <input type="text" name="lid">
        </p>
        <p>
            <label for="lpw">パスワード：</label>
            <input type="password" name="lpw">
        </p>
        <h2>
            <!-- <?php if(isset($err['msg'])): ?> -->
                <!-- <p><?php echo $err['msg']; ?></p> -->
            <!-- <?php endif; ?> -->
        </h2>
        <p>
            <input type="submit" value="ログイン">
        </p>
    </form>
    <a href="signup_form.php">新規登録はこちら</a><br>
    <a href="index.php">戻る</a><br>
</body>
</html>