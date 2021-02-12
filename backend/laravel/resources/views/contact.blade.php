<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>お問い合わせ内容一覧</title>
  <style>
    th,td {
    border: solid 1px;          /* 枠線指定 */
    }
    
    table {
        border-collapse:  collapse; /* セルの線を重ねる */
        width:  100%;               /* 幅指定 */
    }
    
    th {
        width:  100px;              /* 幅指定 */
        text-align: center;           /* 文字の揃え位置指定 */
    }
    
    td {
        text-align:  center;        /* 文字の揃え位置指定 */
    }
  </style>
</head>

<body>
  <h1>お問い合わせ一覧</h1>
  <table>
    <tr>
      <th>id</th>
      <th>名前</th>
      <th>メールアドレス</th>
      <th>お問い合わせ内容</th>
      <th>Facebookの名前</th>
      <th>ユーザーID</th>
      <th>詳細・説明</th>
    </tr>
    @foreach ($data as $contact)
        <tr>
          <td>{{$contact->id}}</td>
          <td>{{$contact->name}}</td>
          <td>{{$contact->email}}</td>
          <td>{{$contact->item}}</td>
          <td>{{$contact->facebook_name}}</td>
          <td>{{$contact->user_uid}}</td>
          <td>{{$contact->detail}}</td>
        </tr>
        <button>対応する</button>
    @endforeach
  </table>
</body>

</html>