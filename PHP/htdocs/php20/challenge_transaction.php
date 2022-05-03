<?php
  $host='mysql34.conoha.ne.jp';
  $user='bcdhm_work02';
  $passwd='t7ZWmB5c!';
  $dbname='bcdhm_work02';
  $customer_id=1;//顧客は1に固定
  $message='';//購入処理完了時の表示メッセージ
  $point=0;//保有ポイント情報
  $err_msg=[];//エラーメッセージ
  $point_gift_list=[];//ポイントで購入できる景品
  if($link=mysqli_connect($host,$user,$passwd,$dbname)){//コネクション取得
    mysqli_set_charset($link,'UTF8');//文字コードセット
    /*
      保有ポイント情報を取得
    */
    $sql='SELECT point FROM point_customer_table WHERE customer_id='.$customer_id;//現在のポイント保有情報を取得するためのSQL
    if($result=mysqli_query($link,$sql)){//クエリ実行
      $row=mysqli_fetch_assoc($result);//１件取得
      if(isset($row['point'])===TRUE){//変数に格納
        $point=$row['point'];
      }
    }
    else{
      $err_msg[]='SQL失敗:'.$sql;
    }
    mysqli_free_result($result);
    //POSTの場合はポイントでの景品購入処理
    if($_SERVER['REQUEST_METHOD']==='POST'){
      //購入処理始め
      $date=date('Y-m-d H:i:s');//現在時刻を取得
      $goods_id=(int)$_POST['point_gift_id'];//商品IDを取得
      mysqli_autocommit($link,false);//更新系の処理を行う前にトランザクション開始(オートコミットをオフ）
      /*発注情報を挿入*/
      $sql='INSERT INTO order_table(customer_id,order_date,payment)VALUES('.$customer_id.',\''.$date.'\',\''.$payment.'\');';//insertのSQL
      if(mysqli_query($link,$sql)===TRUE){//insertを実行する
        $order_id=mysqli_insert_id($link);//A_Iを取得
        /*発注詳細情報を挿入*/
        $sql='INSERT INTO order_detail_table(order_id,goods_id,quantity)VALUES('.$order_id.','.$goods_id.',1);';//注文詳細情報をinsertする
        if(mysqli_query($link,$sql)!==TRUE){//insertを実行する
          $err_msg[]='order_detail_table: insertエラー:'.$sql;
        }
      }
      else{
        $err_msg[]='order_table: insertエラー:'.$sql;
      }
      /*ポイントを減らす操作*/
      $result=mysqli_query($link,'SELECT price FROM goods_table WHERE goods_id='.$goods_id.';');
      while($row=mysqli_fetch_array($result)){
        $payment=$row['price'];
      }
      $result=mysqli_query($link,'SELECT point FROM point_customer_table WHERE customer_id='.$customer_id.';');
      while($row=mysqli_fetch_array($result)){
        $point=$row['point'];
      }
      $sql='UPDATE point_customer_table SET point='.($point-$payment).';';
      if(mysqli_query($link,$sql)!==TRUE){
        $err_msg[]='point_customer_table: updateエラー:'.$sql;
      }
      if(count($err_msg)===0){//トランザクション成否判定
        mysqli_commit($link);//処理確定
      }
      else{
        mysqli_rollback($link);//処理取消
      }
      //購入処理終わり
    }
    /*
      景品情報を取得
    */
    $sql='SELECT point_gift_id,name,point FROM point_gift_table';//SQL
    if($result=mysqli_query($link,$sql)){//クエリ実行
      $i=0;
      while($row=mysqli_fetch_assoc($result)){
        $point_gift_list[$i]['point_gift_id']=htmlspecialchars($row['point_gift_id'],ENT_QUOTES,'UTF-8');
        $point_gift_list[$i]['name']=htmlspecialchars($row['name'],ENT_QUOTES,'UTF-8');
        $point_gift_list[$i]['point']=htmlspecialchars($row['point'],ENT_QUOTES,'UTF-8');
        $i++;
      }
    }
    else{
      $err_msg[]='SQL失敗:'.$sql;
    }
    mysqli_free_result($result);
    mysqli_close($link);
  }
  else{
    $err_msg[]='error:'.mysqli_connect_error();
  }
  //var_dump($err_msg);//エラーの確認が必要ならばコメントを外す
?>
<!DOCTYPE HTML>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>トランザクション課題</title>
</head>
<body>
  <?php
    if(empty($message)!==TRUE){
      ?>
        <p><?php print$message;?></p>
      <?php
    }
  ?>
  <section>
    <h1>保有ポイント</h1>
    <p><?php print number_format($point);?>ポイント</p>
  </section>
  <section>
    <h1>ポイント商品購入</h1>
    <form method="post">
      <ul>
        <?php
          foreach($point_gift_list as$point_gift){
            ?>
              <li>
                <span><?php print$point_gift['name'];?></span>
                <span><?php print number_format($point_gift['point']);?>ポイント</span>
                <?php
                  if($point_gift['point']<=$point){
                    ?>
                      <button type="submit" name="point_gift_id" value="<?php print$point_gift['point_gift_id'];?>">購入する</button>
                    <?php
                  }
                  else{
                    ?>
                      <button type="button" disabled="disabled">購入不可</button>
                    <?php
                  }
                ?>
              </li>
            <?php
          }
        ?>
      </ul>
    </form>
    <p>※サンプルのためポイント購入は1景品&1個に固定</p>
  </section>
</body>
</html>