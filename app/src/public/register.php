<?php
session_start();
require_once '../classes/UserLogic.php';

$err = [];

$token = filter_input(INPUT_POST, 'csrf_token');
// トークンがない、もしくは一致しない場合、処理を中止
if (!isset($_SESSION['csrf_token']) || $token !== $_SESSION['csrf_token']) {

  exit('不正なリクエストです');
}

// 2重送信の防止
unset($_SESSION['csrf_token']);

if (!$username = filter_input(INPUT_POST, 'username')) {
  $err[] = 'ユーザー名を記入してください';
}
if (!$username = filter_input(INPUT_POST, 'email')) {
  $err[] = 'メールアドレスを記入してください';
}

$password = $username = filter_input(INPUT_POST, 'password');

if (!preg_match("/\A[a-z\d]{8,100}\z/i", $password)) {
  $err[] = "パスワードは英数字8文字以上100文字以下にしてください";
}

$password_conf = $username = filter_input(INPUT_POST, 'password_conf');
if (!$password === $password_conf) {
  $err[] = "確認用パスワードと異なっています";
}

if (count($err) === 0) {
  // ユーザーを登録する処理
  $hasCreated = UserLogic::createUser($_POST);

  if (!$hasCreated) {
    $err[] = '登録に失敗しました';
  }
}

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