<?php
session_start();
require_once '../classes/UserLogic.php';

$err = [];

if (!$email = filter_input(INPUT_POST, 'email')) {
  $err['email'] = 'ユーザー名を記入してください';
}

if (! $password = filter_input(INPUT_POST, 'password')) {
  $err['password'] = 'パスワードを入力してください';
}

if (count($err) > 0) {
  // エラーがあった場合は戻す
  $_SESSION = $err;
  header('Location: login_form.php');
  return;
}
// ログイン成功時の処理
$result = UserLogic::login($email, $password);

// ログイン失敗時の処理
if (!$result) {
  header('Location: login.php');
  return;
}
echo 'ログイン成功です';

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>

<body>
  <?php if (count($err) > 0) : ?>
    <?php foreach ($err as $e) : ?>
      <p><?php echo $e ?></p>
    <?php endforeach ?>
  <?php endif ?>
  <p>ユーザ登録が完了しました</p>
  <a href="./signup_form.php">戻る</a>
</body>

</html>