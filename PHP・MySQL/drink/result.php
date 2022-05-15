<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="utf-8">
	<title>自動販売機</title>
</head>
<body>
	<?php
		$link=mysqli_connect('mysql34.conoha.ne.jp','bcdhm_work02','********','bcdhm_work02');
		mysqli_set_charset($link,'utf8');
		$money_is_correct=is_numeric($_POST['money'])?(is_int(+$_POST['money'])&&$_POST['money']>=0):false;
		if(isset($_POST['id'])&&$money_is_correct){
			$result=mysqli_query($link,'SELECT*FROM drink_table WHERE id='.$_POST['id'].';');
			if($item=mysqli_fetch_array($result)){
				if($_POST['money']>=$item['price']&&$item['stock']>=1&&$item['status']==='1'){
					mysqli_autocommit($link,false);
					$result=mysqli_query($link,'UPDATE drink_table SET stock='.($item['stock']-1).' WHERE id='.$_POST['id'].';');
					if($result){
						mysqli_commit($link);
						echo'
							商品を購入しました<br>
							<img height="32" src="img/'.$item['id'].'.'.$item['img_ext'].'">
							<b>'.$item['name'].'</b> お釣り: '.($_POST['money']-$item['price']).'
						';
					}
					else{
						mysqli_rollback($link);
						echo'商品の購入に失敗しました';
					}
				}
				else{
					echo$item['stock']>=1&&$item['status']==='1'?'投入金が不足しています':'商品が売れ切れたか、非公開になりました';
				}
			}
		}
		else{
			echo isset($_POST['id'])?'投入金が不正です':'商品が選択されていません';
		}
		mysqli_close($link);
	?><br>
	<a href=".">戻る</a>
</body>
</html>