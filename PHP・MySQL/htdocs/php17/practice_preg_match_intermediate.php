<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>課題</title>
</head>
<body>
  <form method="post">
    メールアドレス<br>
    <input type="text" name="mail"><br>
    パスワード<br>
    <input type="password" name="passwd"><br>
    <?php
      if(preg_match('/.+@.+/',htmlspecialchars($_POST['mail'],ENT_QUOTES,'UTF-8'))===0){
        echo'メールアドレスの形式が正しくありません<br>';
      }
      $pwlen=mb_strlen(htmlspecialchars($_POST['mail'],ENT_QUOTES,'UTF-8'));
      if($pwlen==0){
        echo'パスワードを入力してください<br>';
      }
      elseif($pwlen<6||18<$pwlen){
        echo'パスワードは半角英数記号6文字以上18文字以下で入力してください<br>';
      }
    ?>
    <button type="submit">登録</button>
  </form>
</body>
</html>