<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>課題</title>
</head>
<body>
  <p>以下にファイルから読み込んだ住所データを表示</p>
  <div>住所データ</div>
  <table>
    <tr>
      <th>郵便番号</th>
      <th>都道府県</th>
      <th>市区町村</th>
      <th>町域</th>
    </tr>
    <?php
      foreach(file('13tokyo.csv')as$datum){
        echo'<tr>';
        echo'<td>'.explode(',',$datum)[2].'</td>';
        echo'<td>'.explode(',',$datum)[6].'</td>';
        echo'<td>'.explode(',',$datum)[7].'</td>';
        echo'<td>'.explode(',',$datum)[8].'</td>';
        echo'</tr>';
      }
    ?>
  </table>
  <form method="post">
    <input type="text" name="comment">
    <input type="submit" name="submit" value="送信">
  </form>
</body>
</html>