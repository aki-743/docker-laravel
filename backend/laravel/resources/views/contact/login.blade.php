<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>ログイン</title>
        <style>
          label {
            display: block;
          }
        </style>
    </head>
    <body>
        <form action='/logged' method="POST">
          @csrf
          <label>ユーザーID</label>
          <input type="name" name="name" autocomplete="name" placeholder="ユーザーID">
          <label>パスワード</label>
          <input type="password" name="password" autocomplete="password" placeholder="パスワード">
          <br>
          <button type="submit">ログインする</button>
        </form>
    </body>
</html>
