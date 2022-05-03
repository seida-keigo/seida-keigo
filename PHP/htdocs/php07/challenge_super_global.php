<?php
  if(isset($_GET['my_name'])&&isset($_GET['gender'])&&isset($_GET['mail'])){
    $my_name=htmlspecialchars($_GET['my_name'],ENT_QUOTES,'UTF-8');
    $gender=htmlspecialchars($_GET['gender'],ENT_QUOTES,'UTF-8');
    $mail=htmlspecialchars($_GET['mail'],ENT_QUOTES,'UTF-8');
  }
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>スーパーグローバル変数使用例</title>
</head>
<body>
  <?php
    if(isset($my_name)&&isset($gender)&&isset($mail)){
      ?>
        <div>ここに入力したお名前を表示: <?php print$my_name;?><br>
        ここに入力した性別を表示: <?php print$gender;?><br>
        ここにメールを受け取るかを表示: <?php print$mail;?></div>
      <?php
    }
  ?>
  <h1>課題</h1>
  <form method="get">
    お名前: <input id="my_name" type="text" name="my_name" value=""><br>
    性別: <input type="radio" name="gender" value="man">男 <input type="radio" name="gender" value="woman">女<br>
    <input type="checkbox" name="mail" value="OK">お知らせメールを受け取る<br>
    <input type="submit" value="送信">
  </form>
</body>
</html>