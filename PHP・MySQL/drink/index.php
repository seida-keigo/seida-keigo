<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="utf-8">
	<title>自動販売機</title>
</head>
<body>
	<h1>自動販売機</h1>
	<form action="result.php" method="post">
		金額 <input name="money"><br>
		<?php	
			$link=mysqli_connect('mysql34.conoha.ne.jp','bcdhm_work02','********','bcdhm_work02');
			mysqli_set_charset($link,'utf8');
			$result=mysqli_query($link,'SELECT*FROM drink_table');
			while($item=mysqli_fetch_array($result)){
				if($item['status']==='1'){
					echo'
						'.($item['stock']!=='0'?'<input type="radio" name="id" value="'.$item['id'].'">':'売り切れ').'
						<img height="32" src="img/'.$item['id'].'.'.$item['img_ext'].'">
						<b>'.$item['name'].'</b> ¥'.$item['price'].'<br>
					';
				}
			}
			mysqli_free_result($result);
			mysqli_close($link);
		?>
		<input type="submit" value="購入">
	</form>
</body>
</html>