<?php
  $number=0;
  if(isset($_POST['number'])===TRUE){
    $number=htmlspecialchars($_POST['number'],ENT_QUOTES,'UTF-8');
    for($i=1;$i<=$number;$i++){
      if(mt_rand(0,1)===1){
        $front_side++;
      }
      else{
        $back_side++;
      }
    }
  }
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>課題</title>
</head>
<body>
  <article id="wrap">
    <section>
      <p>表: <?php echo$front_side?>回</p>
      <p>裏: <?php echo$back_side?>回</p>
    </section>
    <form method="post">
      <select name="number">
        <option value="">回数選択</option>
        <option value="10">10</option>
        <option value="100">100</option>
        <option value="1000">1000</option>
      </select>回
      <button type="submit">コイントス</button>
    </form>
  </article>
</body>
</html>