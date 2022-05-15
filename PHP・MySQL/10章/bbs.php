<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>ひとこと掲示板</title>
  <style>
    #alert{
      color:#f00;
    }
  </style>
</head>
<body>
  <h1>ひとこと掲示板</h1>
  <form method="post">
    名前: <input type="text" name="name" placeholder="20字以内">
    発言: <input type="text" name="comment" placeholder="100字以内">
    <button type="submit">送信</button>
    <?php
      $name=htmlspecialchars($_POST['name'],ENT_QUOTES,'UTF-8');
      $comment=htmlspecialchars($_POST['comment'],ENT_QUOTES,'UTF-8');
      if(isset($_POST['name']) && $name!=='' && mb_strlen($name)<=20 && isset($_POST['comment']) && $comment!=='' && mb_strlen($comment)<=100){
        $file=fopen('log.txt','a');
        fwrite($file,date('Y/n/j G:i').' <b>'.$name.'</b> '.$comment."\n");
        fclose($file);
      }
      else{
        echo'<span id="alert">名前かコメントが無効です。</span>';
      }
    ?>
  </form>
  <p>発言一覧</p>
  <?php
    foreach(file('log.txt')as$read){
      echo'<p>'.$read.'</p>';
    }
  ?>
</body>
</html>