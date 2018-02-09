<?php

///////////////////////////////////////////////////////////////////////////////////////////////////////////////
//<MySQLに接続

    $dsn='mysql:dbname=データベース名; host=localhost';
    $user='ユーザー名';
    $password='パスワード';
    $pdo=new PDO($dsn,$user,$password);

//<MySQLに接続>
//////////////////////////////////////////////////////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////////////////////////////////////////////////////
//<テーブル作成>

    //$sql="CREATE TABLE mission"
    //."("
    //."num INT,"
    //."name char(32),"
    //."comment TEXT,"
    //."time TEXT,"
    //."pass TEXT"
    //.");";

    //$stmt=$pdo->query($sql);

//<テーブル作成>
//////////////////////////////////////////////////////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////////////////////////////////////////////////////
//<テーブル一覧を表示>

    //$sql='SHOW TABLES';
    //$result=$pdo->query($sql);
    //foreach($result as $row){
    //echo $row[0];
    //echo '<br>';
    //}

//<テーブル一覧を表示>
//////////////////////////////////////////////////////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////////////////////////////////////////////////////
//<意図したテーブルの中身を確認>

    //$sql='SHOW CREATE TABLE mission';
    //$result=$pdo->query($sql);
    //foreach($result as $row){
    //print_r($row);
    //}
    //echo "<hr>";

//<意図したテーブルの中身を確認>
//////////////////////////////////////////////////////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////////////////////////////////////////////////////
//<テーブルを削除>

    //$sql="DROP TABLE mission";
    //$result=$pdo->query($sql);

//<テーブルを削除>
//////////////////////////////////////////////////////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////////////////////////////////////////////////////
//＜編集を押した際、パスワードが合っていたときの処理＞

    //編集した番号とパスワードを受け取る
    $jushinHensyu1=$_POST['hensyu1'];
    $jushinPass3=$_POST['pass3'];


    //何も書き込まれずに編集を押しても何も変わらない
    if(empty($jushinHensyu1) || empty($jushinPass3)){

    //数字を書き込んだ上で編集を押した場合
    }else{

	$sql='SELECT*FROM mission';
	$select=$pdo->query($sql);
	foreach($select as $gyo){

	    //入力された数字と番号が同じとき
	    if($gyo['num']==$jushinHensyu1 && $gyo['pass']==$jushinPass3){

		//編集フォームで入力されたことの証明→hidden=100
		$jushinHandan1=$_POST['handan1'];

		//編集したい番号の名前・コメント・パスワードを入手
		$dateName=$gyo['name'];
		$dateComment=$gyo['comment'];
		$datePass=$gyo['pass'];

	    }
	}
    }

//＜編集を押した際、パスワードが合っていたときの処理＞
//////////////////////////////////////////////////////////////////////////////////////////////////////////////


?>



<html>

    <head>

	<!-タイトル->
	<title>満腹食べたい！！</title>

    </head>



<body>

    <!-見出し->
    <h1>満腹食べたい！！</h1>


<!-//////////////////////////////////////////////////////////////////////////////////////////////////////////////->
<!-＜送信フォーム＞->

    <form method="POST" action="mission_2-15.php">

	<!-名前の入力フォーム->
	名前　　　<input type="text" name="namae" size="30" value="<?php echo $dateName ?>"><br>

	<!-コメントの入力フォーム->
	コメント　<input type="text" name="comment" size="50" value="<?php echo $dateComment ?>"><br>

	<!-パスワードの入力フォーム->
	パスワード<input type="password" name="pass1" size="30" value="<?php echo $datePass ?>">

	<!-編集されたときのみ送るhidden値->
	<input type="hidden" name="handan2" value="<?php echo $jushinHandan1 ?>">
	<input type="hidden" name="hensyu2" value="<?php echo $jushinHensyu1 ?>">
	<input type="hidden" name="pass3" value="<?php echo $jushinPass3 ?>">

	<!-送信フォーム->
	<input type="submit" value="送信"><br>

    </form>

    <!-仕切り線->
    <hr>

<!-＜送信フォーム＞->
<!-///////////////////////////////////////////////////////////////////////////////////////////////////////////->

<!-///////////////////////////////////////////////////////////////////////////////////////////////////////////->
<!-＜削除フォーム＞->

    <form method="POST" action="mission_2-15.php">

	<!-削除したい番号の入力フォーム->
	削除対象番号<input type="text" name="sakujo" size="10"><br>

	<!-パスワードの入力フォーム（削除）->
	パスワード　<input type="password" name="pass2">

	<!-削除フォーム->
	<input type="submit" value="削除">

    </form>

    <?php

	//削除したい番号を受け取る
	$jushinSakujo=$_POST['sakujo'];
	$jushinPass2=$_POST['pass2'];

	if(empty($jushinSakujo) || empty($jushinPass2)){

	}else{

	    $sql='SELECT*FROM mission';
	    $select=$pdo->query($sql);
	    foreach($select as $gyo){

		//パスワードが合っていたとき
		if($gyo['num']==$jushinSakujo && $gyo['pass']==$jushinPass2){

		    //「この番号は削除されました」とデータベースに上書き
	            $nm="この番号は削除されました";
	            $kome="";
	            $zikan="";
		    $pasu="";
	            $sql="update mission set name='$nm', comment='$kome', time='$zikan' where num=$jushinSakujo";
	            $result=$pdo->query($sql);

		//すでに削除されているとき
		}elseif($gyo['num']==$jushinSakujo && empty($gyo['comment'])){

	    	    echo '※指定された番号は削除済みです';

		//パスワードが違うとき
		}elseif($gyo['num']==$jushinSakujo && $gyo['pass']!==$jushinPass2){

		    //「※パスワードが違います」と表示
		    echo '※パスワードが違います';

		}
	    }
	}

    ?>

    <!-仕切り線->
    <hr>

<!-＜削除フォーム＞->
<!-///////////////////////////////////////////////////////////////////////////////////////////////////////////->

<!-///////////////////////////////////////////////////////////////////////////////////////////////////////////->
<!-＜編集フォーム＞->

    <form method="POST" action="mission_2-15.php">

	<!-編集したい番号の入力フォーム->
	編集対象番号<input type="text" name="hensyu1" size="10"><br>

	<!-パスワードの入力フォーム（編集）->
	パスワード　<input type="password" name="pass3">

	<!-編集フォーム->
	<input type="submit" value="編集">

	<!-編集の際はhiddenの値も送信する handan=100->
	<input type="hidden" name="handan1" value="100">

    </form>

    <?php

	//編集したい番号とパスワードを受け取る
	$jushinHensyu1=$_POST['hensyu1'];
	$jushinPass3=$_POST['pass3'];

	//何も書き込まれずに編集を押しても何も起こらない
	if(empty($jushinHensyu1)){

	}else{

	    $sql='SELECT*FROM mission';
	    $select=$pdo->query($sql);
	    foreach($select as $gyo){

		//指定した番号がすでに削除されたものなら
		if($gyo['num']==$jushinHensyu1 && empty($gyo['comment'])){

		    echo '※指定された番号はすでに削除されています';

		//パスワードが違うとき
		}elseif($gyo['num']==$jushinHensyu1 && $gyo['pass']!==$jushinPass3){

		    echo '※パスワードが違います';

		}
	    }
	}

    ?>

<!-＜編集フォーム＞->
<!-///////////////////////////////////////////////////////////////////////////////////////////////////////////->

    <!-仕切り線->
    <hr><hr>

<?php

    //何行目か数える(投稿番号）
    $a=0;
    $sql='SELECT*FROM mission';
    $results=$pdo->query($sql);
    foreach($results as $row){
	$a++;
    } 
    $cnt=$a+1;

    //UNIX TIMESTMPを取得
    $tomestamp=time();

    //日時を出力
    $time=date("Y/m/d H:i:s");

    //フォームで入力された文字列を受け取る
    $jushinName=$_POST['namae'];
    $jushinComment=$_POST['comment'];
    $jushinHandan2=$_POST['handan2'];
    $jushinHensyu2=$_POST['hensyu2'];
    $jushinPass1=$_POST['pass1'];
    $jushinPass3=$_POST['pass3'];


//////////////////////////////////////////////////////////////////////////////////////////////////////////////
//<編集時の送信・通常の送信＞

    //何も書きこまれずに送信を押しても何も起こらない(コメント）
    if(empty($jushinName)||empty($jushinComment)||empty($jushinPass1)){

    //編集するとき
    }elseif($jushinHandan2==100){

	$sql='SELECT*FROM mission';
	$select=$pdo->query($sql);
	foreach($select as $gyo){

	    //編集で打たれた番号と同じとき
	    if($gyo['num']==$jushinHensyu2 && $gyo['pass']==$jushinPass3){

	        $nm=$jushinName;
	        $kome=$jushinComment;
		$zikan=$time;
	        $pasu=$jushinPass1;
	        $sql="update mission set name='$nm', comment='$kome', time='$zikan', pass='$pasu' where num=$jushinHensyu2";
	        $result=$pdo->query($sql);

	    }
	}

    //何か書き込んだ上で送信を押した場合(通常ver)
    }else{

	//入力されたものをデータベース内に書き込む
	$sql=$pdo->prepare("INSERT INTO mission(num,name,comment,time,pass) VALUES(:num,:name,:comment,:time,:pass)");
	$sql->bindParam(':num',$cnt,PDO::PARAM_STR);
	$sql->bindParam(':name',$jushinName,PDO::PARAM_STR);
	$sql->bindParam(':comment',$jushinComment,PDO::PARAM_STR);
	$sql->bindParam(':time',$time,PDO::PARAM_STR);
	$sql->bindParam(':pass',$jushinPass1,PDO::PARAM_STR);
	$sql->execute();

    }

//<通常の送信＞
//////////////////////////////////////////////////////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////////////////////////////////////////////////////
//＜ブラウザに表示＞

    $sql='SELECT*FROM mission';
    $results=$pdo->query($sql);
    foreach($results as $row){
	echo $row['num'].',';
	echo $row['name'];

	if(empty($row['comment'])){
	    echo '<br>';

	}else{
	    echo ','.$row['comment'].',';
	    echo $row['time'].'<br>';
	}
    } 

//＜ブラウザに表示＞
//////////////////////////////////////////////////////////////////////////////////////////////////////////////

?>

</body>
</html>
