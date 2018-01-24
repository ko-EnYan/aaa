<?php
///////////////////////////////////////////////////////////////////////////////////////////////////////////////
//＜編集を押した際、パスワードが合っていたときの処理＞

    $filename = 'kadai26.txt';

    //編集のパスワードが打たれたとき
    $jushinPass3 = $_POST['pass3'];

    //編集フォームで入力された数字を入手
    $jushinHensyu1 = $_POST['hensyu1'];


    //何も書きこまれずに編集を押しても何も起こらない
    if(empty($jushinHensyu1)  ||  empty($jushinPass3)){

    //数字を書き込んだ上で編集を押した場合
    } else {

	//ファイル全体を配列に入れる
	$hairetsu = file($filename);

	//1行ずつ判断
	foreach($hairetsu as $chat1){

	    //<>を境目に配列に分ける
	    $pieces = explode("<>",$chat1);

	    //入力された数字と番号が同じとき
	    if($pieces[0] == $jushinHensyu1){

		//パスワードが一致したとき
		if($pieces[4] == $jushinPass3."\n"){

		    //編集フォームで入力されたことの証明→hidden=100
		    $jushinHandan1 = $_POST['handan1'];

		    //編集したい番号の名前・コメント・パスワードを入手
		    $dateName = $pieces[1];
		    $dateComment = $pieces[2];
		    $datePass = $pieces[4];
		}
	    }
	}
    }

//＜編集を押した際、パスワードが合っていたときの処理＞
///////////////////////////////////////////////////////////////////////////////////////////////////////////////
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

    <form method="POST" action="mission_2-6.php">

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
<!-//////////////////////////////////////////////////////////////////////////////////////////////////////////////->



<!-//////////////////////////////////////////////////////////////////////////////////////////////////////////////->
<!-＜削除フォーム＞->

    <form method="POST" action="mission_2-6.php">

	<!-削除したい番号の入力フォーム->
	削除対象番号<input type="text" name="sakujo" size="10"><br>

	<!-パスワードの入力フォーム（削除）->
	パスワード　<input type="password" name="pass2">

	<!-削除フォーム->
	<input type="submit" value="削除">

    </form>

    <?php

	$filename = 'kadai26.txt';

	//削除したい番号とパスワードを受け取る
	$jushinSakujo = $_POST['sakujo'];
	$jushinPass2 = $_POST['pass2'];

	//何も書きこまれずに削除を押しても何も起こらない
	if(empty($jushinSakujo)){

	//番号が書き込まれていたら実行
	} else {

	    //ファイルの文を1行ずつ配列に入れる
	    $hairetsu = file($filename);

	    //ファイルを開く
	    $fp = fopen($filename,'w');

	    //1列ずつ評価していく
	    foreach($hairetsu as $chat){

		//区切りごとに、配列に入れる
		$pieces = explode("<>",$chat);

		//パスワードが合っていたとき
		if($pieces[0] == $jushinSakujo  &&  $pieces[4] == $jushinPass2."\n"){

		    //「この投稿は削除されました」と記述
		    fwrite($fp,$pieces[0]."<>"."この投稿は削除されました"."<>"."<>"."<>"."\n");

		//すでに削除されているとき
		} elseif($pieces[0] == $jushinSakujo  &&  empty($pieces[2])){

		    fwrite($fp,$chat);

		    echo '※指定された番号は削除済みです';

	        //パスワードが違うとき
	        } elseif($pieces[0] == $jushinSakujo  &&  $pieces[4] !== $jushinPass2."\n"){

		    fwrite($fp,$chat);

		    //パスワードが違いますと表示
		    echo '※パスワードが違います';

	        } else {

	        //削除フォームに入力された数字と違うなら保存（テキストファイルに書き込む）
	        fwrite($fp,$chat);
	        }
	    }

	    fclose($fp);
	}

    ?>

    <!-仕切り線->
    <hr>

<!-＜削除フォーム＞->
<!-//////////////////////////////////////////////////////////////////////////////////////////////////////////////->



<!-///////////////////////////////////////////////////////////////////////////////////////////////////////////////->
<!-編集フォーム->

    <form method="POST" action="mission_2-6.php">

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

	$filename = 'kadai26.txt';

	//編集したい番号とパスワードを受け取る
	$jushinHensyu1 = $_POST['hensyu1'];
	$jushinPass3 = $_POST['pass3'];

	//何も書きこまれずに編集を押しても何も起こらない
	if(empty($jushinHensyu1)){

	//番号が書き込まれていたら実行
	} else {

	    //ファイルの文を1行ずつ配列に入れる
	    $hairetsu = file($filename);

	    //1列ずつ評価していく
	    foreach($hairetsu as $chat){

		//区切りごとに、配列に入れる
		$pieces = explode("<>",$chat);

		//指定された番号がすでに削除されたものなら
		if($pieces[0] == $jushinHensyu1  &&  empty($pieces[2])){

		    echo '※指定された番号は削除されています';

		//パスワードが違うとき
		}elseif($pieces[0] == $jushinHensyu1  &&  $pieces[4] !== $jushinPass3."\n"){

		    echo '※パスワードが違います';
		}
	    }
	}

    ?>
<!-編集フォーム->
<!-///////////////////////////////////////////////////////////////////////////////////////////////////////////////->

    <!-仕切り線->
    <hr><hr>


    <?php

	$filename = 'kadai26.txt';

	$fp = fopen($filename,'a');
	fclose($fp);

	//UNIX TIMESTMPを取得
	$tomestamp = time();

	//日時を出力
	$time = date("Y/m/d H:i:s");

	//フォームで入力された文字列を受け取る
	$jushinName = $_POST['namae'];
	$jushinComment = $_POST['comment'];
	$jushinHandan2 = $_POST['handan2'];
	$jushinHensyu2 = $_POST['hensyu2'];
	$jushinPass1 = $_POST['pass1'];



//////////////////////////////////////////////////////////////////////////////////////////////////////////////
//＜編集時の送信・通常の送信＞

	//何も書きこまれずに送信を押しても何も起こらない(コメント）
	if((empty($jushinName)  ||  empty($jushinComment))  ||  empty($jushinPass1)){
	
	//hiddenの値が100の状態で送信を押した場合(編集ver)
	}elseif ($jushinHandan2 == 100){

	    //ファイルを配列に入れる
	    $hairetsu = file($filename);

	    //ファイルを開く
	    $fp = fopen($filename,'w');

	    //編集で打たれた番号と同じなら上書き、それ以外ならそのまま
	    foreach($hairetsu as $chat){

		//1行ずつ<>を境に配列に入れる
		$pieces = explode("<>",$chat);

		//編集で打たれた番号と同じとき
		if($pieces[0] == $jushinHensyu2  &&  $pieces[4] == $jushinPass3."\n"){
		    $pieces[1] = $jushinName;
		    $pieces[2] = $jushinComment;
		    $pieces[4] = $jushinPass1;
		    fwrite($fp,$pieces[0]."<>".$pieces[1]."<>".$pieces[2]."<>".$pieces[3]."<>".$pieces[4]."\n");

		//番号と違うとき
    		}else{
		    fwrite($fp,$pieces[0]."<>".$pieces[1]."<>".$pieces[2]."<>".$pieces[3]."<>".$pieces[4]);
    		}
	    }
	    fclose($fp);

	//何か書き込んだ上で送信を押した場合(通常ver)
	} else {

	    //ファイル全体を配列に入れる
	    $hairetsu = file($filename);

	    //行数をカウント
	    $cnt = count($hairetsu) + 1;

	    //ファイルを開く
	    $fp = fopen($filename,'a');

	    //入力されたものをファイルに書き込む
	    fwrite($fp,$cnt."<>".$jushinName."<>".$jushinComment."<>".$time."<>".$jushinPass1."\n");

	    //ファイルを閉じる
	    fclose($fp);
	}
//＜編集時の送信・通常の送信＞
//////////////////////////////////////////////////////////////////////////////////////////////////////////////



//////////////////////////////////////////////////////////////////////////////////////////////////////////////
//＜ブラウザに表示＞

	//ファイル全体を配列に入れる
	$hairetsu = file($filename);

	//1行ずつ評価
	foreach($hairetsu as $chat){

	    //<>を境目に配列に分ける
	    $pieces = explode("<>",$chat);

	    //分けた配列を1列に書き出していく（パスワード以外）
	    for($i=0; $i<4; $i++){
		echo $pieces[$i]." ";
	    }
	    echo "<br>";
	}

//＜ブラウザに表示＞
//////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ?>


</body>
</html>