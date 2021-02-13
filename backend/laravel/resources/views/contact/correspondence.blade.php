<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>お問い合わせ内容一覧</title>
  <style>
    .contact-correspond {
      width: 600px;
      margin: 0 auto;
    }
    .contact-correspond table {
      width: 100%;
    }
    .contact-correspond th,
    .contact-correspond td {
      padding: 1rem 0;
      width: 30%;
    }
    .contact-correspond td {
      text-align: left;
    }
    .contact-correspond a {
      display: block;
      margin: 0 auto;
      text-align: center;
    }
  </style>
</head>

<body>
  <div class="contact-correspond">
    <table>
      <tr>
        <th>氏名</th>
        <td>{{ $data->name }}</td>
      </tr>
      <tr>
        <th>お問い合わせ内容</th>
        <td>{{ $data->item }}</td>
      </tr>
      <tr>
        <th>Facebookアカウント名</th>
        <td>{{ $data->facebook_name }}</td>
      </tr>
      <tr>
        <th>ユーザーID</th>
        <td>{{ $data->user_uid }}</td>
      </tr>
      <tr>
        <th>説明・詳細</th>
        <td>{{ $data->detail }}</td>
      </tr>
    </table>
    <a href="mailto:{{$data->email}}">メールを送信する</a>
  </div>
</body>

</html>