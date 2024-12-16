## PHP Doc

コメントを書く時の共通形式(クラスやメソッドの役割を書く)

```php
/***
 * IDを取得する -> 説明を書く
 * @params int $id -> 引数を書く
 * @return int $id -> 返り値を書く
 * /
public function getId($id) {
  return $id;
}
```

## SQL のプレースホルダ

- SQL 文を組み立てる時に、値を後から当てはめるために確保する仮の場所のこと
- SELECT カラム名 FROM テーブル名 WHERE id = ? (?部分がプレースホルダ)
- ユーザから入力があった値をエスケープするために使う(SQL インジェクション対策)

## 処理わけ

- PHP は html と一緒にかけるけど、ビジネスロジックは別ファイルに分けて書くことが多い
- 例えばユーザ登録は専用の Class を作って、そこにビジネスロジックを集約させる

## PHP の関数

### session_start()

- ※ Cookie にセッション ID を入れる
- ※ セッションファイルを作成
- ※ セッションファイルに自由に値を保存可能

### session_destroy()

- ※ セッションファイルを削除

### $\_SESSION

- ※ セッションへデータを連想配列で保村

### password_hash

- hash 化

### password_verify

- hash の検証

### is_set

- 値があるか確認
