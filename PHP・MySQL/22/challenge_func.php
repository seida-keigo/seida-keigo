<?php
  $err_msg=[];
  $height='';
  $weight='';
  $bmi='';
  $request_method=get_request_method();
  if($request_method==='POST'){
    $height=get_post_data('height');
    $weight=get_post_data('weight');
    if(check_float($height)!==TRUE){
      $err_msg[]='身長は数値を入力してください';
    }
    if(check_float($weight)!==TRUE){
      $err_msg[]='体重は数値を入力してください';
    }
    if(count($err_msg)===0){
      $bmi=calc_bmi($height,$weight);
    }
  }
  function calc_bmi($height,$weight){
    return 10000*$weight/$height**2;
  }
  function check_float($num){
    return is_numeric($num)&&+$num>0;
  }
  function get_request_method(){
    return$_SERVER['REQUEST_METHOD'];
  }
  function get_post_data($key){
    $str='';
    if(isset($_POST[$key])===TRUE){
      $str=$_POST[$key];
    }
    return$str;
  }
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>BMI計算</title>
</head>
<body>
  <h1>BMI計算</h1>
  <form method="post">
    身長(cm): <input type="text" name="height" value="<?php print$height;?>">
    体重(Kg): <input type="text" name="weight" value="<?php print$weight;?>">
    <input type="submit" value="BMI計算">
  </form>
  <?php
    if(count($err_msg)>0){
      foreach($err_msg as$value){
        ?>
          <p><?php print$value;?></p>
        <?php
      }
    }
  ?>
  <?php
    if($request_method==='POST'&&count($err_msg)===0){
      ?>
        <p>あなたのBMIは<?php print$bmi;?>です</p>
      <?php
    }
  ?>
</body>
</html>