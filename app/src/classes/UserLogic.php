<?php
require_once '../dbconnect.php';

class UserLogic
{
  /**
   * ユーザーを登録する
   * @param array $userData
   * @return bool $result
   */
  static function createUser($userData)
  {
    // SQLの準備
    // SQLの実行
    // SQLの結果を返す
    $result = false;
    $sql = 'INSERT INTO users (name, email, password) VALUES (?, ?, ?)';

    // ユーザデータを配列に入れる
    $arr = [];
    $arr[] = $userData['username'];
    $arr[] = $userData['email'];
    $arr[] = password_hash($userData['password'], PASSWORD_DEFAULT);
    try {
      $stmt = connect()->prepare($sql);
      // 準備した$sqlの???に対して$arrの内容が入る
      // 成功したらTrueを返す
      $result = $stmt->execute($arr);
      return $result;
    } catch (\Exception $e) {
      return $result;
    }
  }

  /**
   * ログイン処理
   * @param string $email
   * @param string $password
   * @return bool $result
   */
  static function login($email, $password)
  {
    // 結果
    $result = false;
    // ユーザーをemailから検索して取得
    $user = self::getUserByEmail($email);

    if (!$user) {
      $_SESSION['msg'] = 'emailが一致しません。';
      return $result;
    }

    // パスワードの紹介
    if (password_verify($password, $user['password'])) {
      // ログイン成功
      // 古いSessionを破棄して、新しいSessionを作成する
      session_regenerate_id(true);
      $_SESSION['login_user'] = $user;
      $result = true;
      return $result;
    }

    $_SESSION['msg'] = 'パスワードが一致しません';
    return $result;
  }

  /**
   * emailからユーザーを取得
   * @param string $email
   * @return array|false $user|false
   */
  public static function getUserByEmail($email)
  {
    // SQLの準備
    // SQLの実行
    // SQLの結果を返す
    $sql = 'SELECT * FROM users WHERE email = ?';

    // emailを配列に入れる
    $arr = [];
    $arr[] = $email;

    try {
      $stmt = connect()->prepare($sql);
      $stmt->execute($arr);
      // SQLの結果を返す
      $user = $stmt->fetch();
      return $user;
    } catch (\Exception $e) {
      return false;
    }
  }

  /**
   * ログインチェック
   * @param void
   * @return bool $result
   */
  public static function checkLogin()
  {
    $result = false;

    // セッションにログインユーザーが入っていなかったらfalse
    if (isset($_SESSION['login_user']) && $_SESSION['login_user']['id'] > 0) {
      return $result = true;
    }

    return $result;
  }

  /**
   * ログアウト処理
   */
  public static function logout()
  {
    $_SESSION = array();
    session_destroy();
  }
}
