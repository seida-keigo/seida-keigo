<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>課題</title>
</head>
<body>
  <form method="post">
    <select name="job">
      <option value="all">全員</option>
      <option value="manager">マネージャー</option>
      <option value="analyst">アナリスト</option>
      <option value="clerk">一般職</option>
    </select>
    <button type="submit">表示</button>
  </from>
  <?php
    $job=htmlspecialchars($_POST['job'],ENT_QUOTES,'UTF-8');
    $link=mysqli_connect('mysql34.conoha.ne.jp','bcdhm_work02','********','bcdhm_work02');
    mysqli_set_charset($link,'utf8');
    if($job==='all'){
      $result=mysqli_query($link,'SELECT*FROM emp_table');
    }
    else{
      $result=mysqli_query($link,'SELECT*FROM emp_table WHERE job=\''.$job.'\'');
    }
    echo'<table>';
    echo'<tr>';
    echo'<th>社員番号</th>';
    echo'<th>名前</th>';
    echo'<th>職種</th>';
    echo'<th>年齢</th>';
    echo'</tr>';
    while($row=mysqli_fetch_array($result)){
      echo'<tr>';
      echo'<td>'.$row['emp_id'].'</td>';
      echo'<td>'.$row['emp_name'].'</td>';
      echo'<td>'.$row['job'].'</td>';
      echo'<td>'.$row['age'].'</td>';
      echo'</tr>';
    }
    echo'</table>';
    mysqli_free_result($result);
    mysqli_close($link);
  ?>
</body>
</html>