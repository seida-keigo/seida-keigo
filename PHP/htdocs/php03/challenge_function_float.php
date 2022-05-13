<?php
	$value=55.5555;
	$floor=floor($value);
	$ceil=ceil($value);
	$round=round($value);
	$round_2=round($value,2);
?>
<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<title>課題</title>
</head>
<body>
	<p>元の値: <?php echo$value;?></p>
	<p>小数切り捨て: <?php echo$floor;?></p>
	<p>小数切り上げ: <?php echo$ceil;?></p>
	<p>小数四捨五入: <?php echo$round;?></p>
	<p>小数第二位で四捨五入: <?php echo$round_2;?></p>
</body>
</html>