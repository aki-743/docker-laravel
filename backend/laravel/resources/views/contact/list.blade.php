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
    .contact-list button {
      margin: 10px;
    }
    .contact-list input {
      position: absolute;
      top: -1000000px;
    }
    tr td:last-child {
      width: 70px;
    }
  </style>
</head>

<body>
  <div class="contact-list">
  <h1>お問い合わせ一覧</h1>
  <table>
    <tr>
      <th>名前</th>
      <th>メールアドレス</th>
      <th>お問い合わせ内容</th>
      <th>Facebookの名前</th>
      <th>ユーザーID</th>
      <th>詳細・説明</th>
    </tr>
    @foreach ($data as $contact)
      <form id="form" action="/correspond" method="GET">
        @csrf
        <input name="id" value="{{$contact->id}}"/>
        <tr>
          <td>{{$contact->name}}</td>
          <td>{{$contact->email}}</td>
          <td>{{$contact->item}}</td>
          <td>{{$contact->facebook_name}}</td>
          <td>{{$contact->user_uid}}</td>
          <td>{{$contact->detail}}</td>
          <td>
            <button type="submit">対応する</button>
            <button id="delete">消去する</button>
          </td>
        </tr>
      </form>
    @endforeach
  </table>
  <form action="/logout" method="POST">
    @csrf
    <button type="submit">ログアウト</button>
  </form>
  </div>
</body>
<script>
  const button = document.getElementById('delete')
  button.addEventListener('click', function(event) {
    
    let answer = window.confirm('本当に消去しますか？')
    if(answer) {
      let form = document.getElementById('form');
      form.action = '/contact/delete';
      form.method = 'POST';
    } else {
      return false
    }
  })
</script>
</html>
