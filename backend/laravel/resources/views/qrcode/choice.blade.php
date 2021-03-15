<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>プラン選択</title>
  <style>
    form {
      padding-bottom:20px;
    }
  </style>
</head>

<body>
  <h1>QRコード生成画面</h1>
  <h2>・新規入会</h2>
  <form action="generate?plan=3months_plan&month=3&settlement_amount=9900" method="POST">
    @csrf
    ・3ヶ月プラン（10,350円）→
    <button type="submit">QRコードを表示する</button>
  </form>
  <form action="generate?plan=6months_plan&month=6&settlement_amount=19800" method="POST">
    @csrf
    ・6ヶ月プラン（20,700円）→
    <button type="submit">QRコードを表示する</button>
  </form>
  <form action="generate?plan=12months_plan&month=12&settlement_amount=39600" method="POST">
    @csrf
    ・12ヶ月プラン（41,400円）→
    <button type="submit">QRコードを表示する</button>
  </form>
  <h2>・更新</h2>
  <form action="generate?plan=3months_plan&month=3&settlement_amount=9900&update=true" method="POST">
    @csrf
    ・3ヶ月プラン（10,350円）→
    <button type="submit">QRコードを表示する</button>
  </form>
  <form action="generate?plan=6months_plan&month=6&settlement_amount=19800&update=true" method="POST">
    @csrf
    ・6ヶ月プラン（20,700円）→
    <button type="submit">QRコードを表示する</button>
  </form>
  <form action="generate?plan=12months_plan&month=12&settlement_amount=39600&update=true" method="POST">
    @csrf
    ・12ヶ月プラン（41,400円）→
    <button type="submit">QRコードを表示する</button>
  </form>
</body>
<script>
  const buttons = document.querySelectorAll('.delete')
  const length = Object.keys(buttons).length
  for(let i = 0; i < length; i++) {
    buttons[i].addEventListener('click', function(event) {
    
    let answer = window.confirm('本当に消去しますか？')
    if(answer) {
      let form = document.getElementById('form');
      form.action = '/contact/delete';
      form.method = 'POST';
    } else {
      return false
    }
  })
  }
</script>
</html>
