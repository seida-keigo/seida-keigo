<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>課題</title>
</head>
<body>
  <h1>郵便番号検索</h1>
  <h2>郵便番号から検索</h2>
  <form method="get">
    <input name="zip_code" placeholder="例) 1010001"></input>
    <input type="submit" value="検索">
  </form>
  <h2>地名から検索</h2>
  <form method="get">
    都道府県を選択
    <select name="pref">
      <option>都道府県を選択</option>
      <option value="1">北海道</option>
      <option value="2">新潟県</option>
      <option value="3">兵庫県</option>
    </select>
    市区町村
    <input name="city">
    <input type="submit" value="検索">
  </form>
  <hr>
  <p>ここに検索結果が表示されます</p>
  <?php
    $zip_code=preg_replace('/^[ 　]+|[ 　]+$/','',htmlspecialchars($_GET['zip_code'],ENT_QUOTES,'UTF-8'));
    if(isset($_GET['zip_code'])&&preg_match('/[0-9]{7,}/',$zip_code)===1){
      $link=mysqli_connect('mysql34.conoha.ne.jp','bcdhm_work02','t7ZWmB5c!','bcdhm_work02');
      mysqli_set_charset($link,'utf8');
      $result=mysqli_query($link,'SELECT a,e,f,g FROM zip_data_split_1 WHERE a=\''.$zip_code.'\';');
      while($row=mysqli_fetch_array($result)){
        print'<div class="zip-code">'.$row['a'].' '.$row['e'].' '.$row['f'].' '.$row['g'].'</div>';
      }
      $result=mysqli_query($link,'SELECT a,e,f,g FROM zip_data_split_2 WHERE a=\''.$zip_code.'\';');
      while($row=mysqli_fetch_array($result)){
        print'<div class="zip-code">'.$row['a'].' '.$row['e'].' '.$row['f'].' '.$row['g'].'</div>';
      }
      $result=mysqli_query($link,'SELECT a,e,f,g FROM zip_data_split_3 WHERE a=\''.$zip_code.'\';');
      while($row=mysqli_fetch_array($result)){
        print'<div class="zip-code">'.$row['a'].' '.$row['e'].' '.$row['f'].' '.$row['g'].'</div>';
      }
      mysqli_free_result($result);
      mysqli_close($link);
    }
    elseif(isset($_GET['zip_code'])){
      echo'<p>入力された郵便番号が不正です</p>';
    }

    $pref=htmlspecialchars($_GET['pref'],ENT_QUOTES,'UTF-8');
    $city=preg_replace('/^[ 　]+|[ 　]+$/','',htmlspecialchars($_GET['city'],ENT_QUOTES,'UTF-8'));
    if(isset($_GET['pref'])&&isset($_GET['city'])&&$city!==''){
      $link=mysqli_connect('mysql34.conoha.ne.jp','bcdhm_work02','t7ZWmB5c!','bcdhm_work02');
      mysqli_set_charset($link,'utf8');
      $result=mysqli_query($link,'SELECT a,e,f,g FROM zip_data_split_'.$pref.' WHERE f=\''.$city.'\';');
      while($row=mysqli_fetch_array($result)){
        print'<div class="zip-code">'.$row['a'].' '.$row['e'].' '.$row['f'].' '.$row['g'].'</div>';
      }
      mysqli_free_result($result);
      mysqli_close($link);
    }
    else{
      echo'<p>都道府県か市区町村が入力されていません</p>';
    }
  ?>
  <button>前へ</button>
  <button>次へ</button>
  <script>
    let page=0;
    let change=()=>{
      for(zipCode of document.querySelectorAll("div.zip-code")){
        zipCode.style.display="block";
      }
      for(num=0;num<10*page;num++){
        document.querySelectorAll("div.zip-code")[num].style.display="none";
      }
      for(num=10*page+10;num<document.querySelectorAll("div.zip-code").length;num++){
        document.querySelectorAll("div.zip-code")[num].style.display="none";
      }
    }
    change();
    document.querySelectorAll("button")[0].onclick=()=>{
      page--;
      change();
    }
    document.querySelectorAll("button")[1].onclick=()=>{
      page++;
      change();
    }
  </script>
</body>
</html>