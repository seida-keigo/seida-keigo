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
      function connect(){
        return mysqli_connect('mysql34.conoha.ne.jp','bcdhm_work02','t7ZWmB5c!','bcdhm_work02');
      }
      function insert($link,$time,$name,$comment){
        mysqli_query($link,'INSERT INTO bbs(time,name,comment)VALUES(\''.$time.'\',\''.$name.'\',\''.$comment.'\')');
      }
      function select($link){
        return mysqli_query($link,'SELECT time,name,comment FROM bbs');
      }
      function disconnect($link){
        mysqli_close($link);
      }
      function check_the_name(){
        $name=htmlspecialchars($_POST['name'],ENT_QUOTES,'UTF-8');
        return isset($_POST['name'])&&$name!==''&&mb_strlen($name)<=20;
      }
      function check_the_comment(){
        $comment=htmlspecialchars($_POST['comment'],ENT_QUOTES,'UTF-8');
        return isset($_POST['comment'])&&$comment!==''&&mb_strlen($comment)<=100;
      }
      function ent($str){
        return htmlentities($str);
      }
      if(check_the_name()&&check_the_comment()){
        $link=connect();
        mysqli_set_charset($link,'utf8');
        $name=htmlspecialchars($_POST['name'],ENT_QUOTES,'UTF-8');
        $comment=htmlspecialchars($_POST['comment'],ENT_QUOTES,'UTF-8');
        insert($link,date('Y/n/j G:i'),$name,$comment);
        //mysqli_query($link,'INSERT INTO bbs(time,name,comment)VALUES(\''.$time.'\',\''.$name.'\',\''.$comment.'\')');
        disconnect($link);
      }
      else{
        echo'<span id="alert">名前かコメントが無効です。</span>';
      }
    ?>
  </form>
  <p>発言一覧</p>
  <?php
    $link=connect();
    mysqli_set_charset($link,'utf8');
    $result=select($link);
    while($row=mysqli_fetch_array($result)){
      echo'<p>'.$row['time'].' <b>'.$row['name'].'</b> '.$row['comment'].'</p>';
    }
    mysqli_free_result($result);
    disconnect($link);
  ?>
</body>
</html>