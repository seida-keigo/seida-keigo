<?php
  if(isset($_GET['my_name'])&&$_GET['my_name']!==''){
    echo'ようこそ'.htmlspecialchars($_GET['my_name'],ENT_QUOTES,'UTF-8').'さん';
  }
  else{
    echo'名前を入力してください';
  }
?>