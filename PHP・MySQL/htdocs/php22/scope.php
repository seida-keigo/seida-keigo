<?php
  //$str='スコープテスト';
  function test_scope(){
    //global$str;
    //print$str;
    print$_SERVER['REQUEST_METHOD'];
  }
  test_scope();
?>