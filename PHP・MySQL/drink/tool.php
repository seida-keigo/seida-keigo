<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="utf-8">
	<title>自動販売機管理画面</title>
</head>
<body>
	<?php
		function is_natural($num){
			return is_numeric($num)&&is_int(+$num)&&$num>=0;
		}
		$link=mysqli_connect('mysql34.conoha.ne.jp','bcdhm_work02','********','bcdhm_work02');
		mysqli_set_charset($link,'utf8');
	?>
	<form method="post" enctype="multipart/form-data">
		<b>商品追加</b><br>
		<input name="name" placeholder="ドリンク名"><br>
		<input name="price" placeholder="値段"><br>
		<input name="stock" placeholder="在庫数"><br>
		<select name="status">
			<option value="0">非公開</option>
			<option value="1">公開</option>
		</select><br>
		画像(PNGまたはJPEG) <input name="img" type="file"><br>
		<input type="submit">
		<?php
			$img_is_correct=preg_match('/\.[Pp][Nn][Gg]$|\.[Jj][Pp][Ee]?[Gg]$/',$_FILES['img']['name'])===1;
			$status_is_correct=$_POST['status']==='0'||$_POST['status']==='1';
			if($img_is_correct&&$_POST['name']!==''&&is_natural($_POST['price'])&&is_natural($_POST['stock'])&&$status_is_correct){
				$img_ext=preg_replace('/^.*\./','',$_FILES['img']['name']);
				$name='\''.htmlspecialchars($_POST['name'],ENT_QUOTES,'UTF-8').'\'';
				$status='\''.$_POST['status'].'\'';
				$result=mysqli_query($link,'INSERT INTO drink_table(img_ext,name,price,stock,status)VALUES(\''.$img_ext.'\','.$name.','.+$_POST['price'].','.+$_POST['stock'].','.$status.');');
				if($result!==false){
					$result=mysqli_query($link,'SELECT id FROM drink_table ORDER BY id DESC LIMIT 1;');
					if($item=mysqli_fetch_array($result)){
						move_uploaded_file($_FILES['img']['tmp_name'],'img/'.$item['id'].'.'.$img_ext);
						echo'商品を追加しました';
					}
					else{
						echo'商品を追加できませんでした';
					}
				}
				else{
					echo'商品を追加できませんでした';
				}
			}
			elseif(isset($_FILES['img'])||isset($_POST['name'])||isset($_POST['price'])||isset($_POST['stock'])||isset($_POST['status'])){
				echo'商品を追加できませんでした';
			}
		?>
	</form>
	<hr>
	<?php
		if(isset($_POST['id'])&&is_natural($_POST['stock_change'])&&$_POST['status_change']!=='0'&&$_POST['status_change']!=='1'){
			$result=mysqli_query($link,'UPDATE drink_table SET stock='.+$_POST['stock_change'].' WHERE id='.$_POST['id'].';');
			echo$result?'商品情報を更新しました':'商品情報を更新できませんでした';
		}
		elseif(isset($_POST['id'])&&!is_natural($_POST['stock_change'])&&($_POST['status_change']==='0'||$_POST['status_change']==='1')){
			$result=mysqli_query($link,'UPDATE drink_table SET status=\''.$_POST['status_change'].'\'WHERE id='.$_POST['id'].';');
			echo$result?'商品情報を更新しました':'商品情報を更新できませんでした';
		}
		elseif(isset($_POST['id'])||isset($_POST['stock_change'])||isset($_POST['status_change'])){
			echo'商品情報を更新できませんでした';
		}
	?>
	<table>
		<tbody>
			<tr>
				<th>商品画像</th>
				<th>商品名</th>
				<th>値段</th>
				<th>在庫数</th>
				<th>公開ステータス</th>
			</tr>
			<?php
				$result=mysqli_query($link,'SELECT*FROM drink_table');
				while($item=mysqli_fetch_array($result)){
					echo'
						<tr>
							<td>
								<img height="32" src="img/'.$item['id'].'.'.$item['img_ext'].'">
							</td>
							<th>'.$item['name'].'</th>
							<td>¥'.$item['price'].'</td>
							<td>
								<form method="post">
									<input name="id" type="hidden" value="'.$item['id'].'">
									<input name="stock_change" value="'.$item['stock'].'">
									<input type="submit" value="変更">
								</form>
							</td>
							<td>
								<form method="post">
									<input name="id" type="hidden" value="'.$item['id'].'">
									'.($item['status']==='0'?'非':'').'公開
									<input name="status_change" type="hidden" value="'.($item['status']==='1'?'0':'1').'">
									<input type="submit" value="変更">
								</form>
							</td>
						</tr>
					';
				}
				mysqli_free_result($result);
				mysqli_close($link);
			?>
		</tbody>
	</table>
</body>
</html>