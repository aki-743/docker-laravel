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
  消去しました
  <button class="back">戻る</button>
  </div>
</body>
<script>
  const button = document.querySelector('.back')
  button.addEventListener('click', function(event) {
    event.preventDefault()

    location.assign('/contact')
  })
</script>
</html>
