<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>課題</title>
</head>
<body>
  <?php
    $goods_name='';
    $price='';
    if(isset($_POST['goods_name'])&&isset($_POST['price'])){
      $link=mysqli_connect('mysql34.conoha.ne.jp','bcdhm_work02','t7ZWmB5c!','bcdhm_work02');
      mysqli_set_charset($link,'utf8');
      $goods_name=htmlspecialchars($_POST['goods_name'],ENT_QUOTES,'UTF-8');
      $price=htmlspecialchars($_POST['price'],ENT_QUOTES,'UTF-8');
      $query='INSERT INTO goods_table(goods_name,price)VALUES(\''.$goods_name.'\','.$price.')';
      if(mysqli_query($link,$query)===TRUE){
        echo'追加成功';
      }
      else{
        echo'追加失敗';
      }
      mysqli_close($link);
    }
    else{
      echo'追加したい商品の名前と価格を入力してください';
    }
  ?>
  <form method="post">
    商品名: <input name="goods_name">
    価格: <input name="price">
    <button type="submit">表示</button>
  </from>
  <?php
    $link=mysqli_connect('mysql34.conoha.ne.jp','bcdhm_work02','t7ZWmB5c!','bcdhm_work02');
    mysqli_set_charset($link,'utf8');
    $result=mysqli_query($link,'SELECT goods_name,price FROM goods_table');
    echo'<table>';
    echo'<tr>';
    echo'<th>商品名</th>';
    echo'<th>価格</th>';
    echo'</tr>';
    while($row=mysqli_fetch_array($result)){
      echo'<tr>';
      echo'<td>'.$row['goods_name'].'</td>';
      echo'<td>'.$row['price'].'</td>';
      echo'</tr>';
    }
    echo'</table>';
    mysqli_free_result($result);
    mysqli_close($link);
  ?>
</body>
</html>