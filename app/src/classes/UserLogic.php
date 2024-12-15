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
}
