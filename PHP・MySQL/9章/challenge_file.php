<?php
  if(isset($_POST['comment'])&&$_POST['comment']!==''){
    fwrite($file=fopen('challenge_log.txt','a'),date('m月d日')."\t".date('H:i:s')."\t".htmlspecialchars($_POST['comment'],ENT_QUOTES,'UTF-8')."\n");
  }
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>課題</title>
</head>
<body>
  <h1>課題</h1>
  <form method="post">
    発言: <input type="text" name="comment">
    <input type="submit" name="submit" value="送信">
  </form>
  <p>発言一覧</p>
  <?php
    foreach(file('challenge_log.txt')as$read){
      echo'<p>'.$read.'</p>';
    }
  ?>
</body>
</html>