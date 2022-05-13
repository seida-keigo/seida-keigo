<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>スーパーグローバル変数使用例</title>
</head>
<body>
  <?php
    for($i=1;$i<=9;$i++){
      for($j=1;$j<=9;$j++){
        echo$i.'*'.$j.'='.$i*$j.' ';
      }
      echo'<br>';
    }
  ?>
</body>
</html>