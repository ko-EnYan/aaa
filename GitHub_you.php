<?php

///////////////////////////////////////////////////////////////////////////////////////////////////////////////
//<MySQL�ɐڑ�

    $dsn='mysql:dbname=�f�[�^�x�[�X��; host=localhost';
    $user='���[�U�[��';
    $password='�p�X���[�h';
    $pdo=new PDO($dsn,$user,$password);

//<MySQL�ɐڑ�>
//////////////////////////////////////////////////////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////////////////////////////////////////////////////
//<�e�[�u���쐬>

    //$sql="CREATE TABLE mission"
    //."("
    //."num INT,"
    //."name char(32),"
    //."comment TEXT,"
    //."time TEXT,"
    //."pass TEXT"
    //.");";

    //$stmt=$pdo->query($sql);

//<�e�[�u���쐬>
//////////////////////////////////////////////////////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////////////////////////////////////////////////////
//<�e�[�u���ꗗ��\��>

    //$sql='SHOW TABLES';
    //$result=$pdo->query($sql);
    //foreach($result as $row){
    //echo $row[0];
    //echo '<br>';
    //}

//<�e�[�u���ꗗ��\��>
//////////////////////////////////////////////////////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////////////////////////////////////////////////////
//<�Ӑ}�����e�[�u���̒��g���m�F>

    //$sql='SHOW CREATE TABLE mission';
    //$result=$pdo->query($sql);
    //foreach($result as $row){
    //print_r($row);
    //}
    //echo "<hr>";

//<�Ӑ}�����e�[�u���̒��g���m�F>
//////////////////////////////////////////////////////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////////////////////////////////////////////////////
//<�e�[�u�����폜>

    //$sql="DROP TABLE mission";
    //$result=$pdo->query($sql);

//<�e�[�u�����폜>
//////////////////////////////////////////////////////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////////////////////////////////////////////////////
//���ҏW���������ہA�p�X���[�h�������Ă����Ƃ��̏�����

    //�ҏW�����ԍ��ƃp�X���[�h���󂯎��
    $jushinHensyu1=$_POST['hensyu1'];
    $jushinPass3=$_POST['pass3'];


    //�����������܂ꂸ�ɕҏW�������Ă������ς��Ȃ�
    if(empty($jushinHensyu1) || empty($jushinPass3)){

    //�������������񂾏�ŕҏW���������ꍇ
    }else{

	$sql='SELECT*FROM mission';
	$select=$pdo->query($sql);
	foreach($select as $gyo){

	    //���͂��ꂽ�����Ɣԍ��������Ƃ�
	    if($gyo['num']==$jushinHensyu1 && $gyo['pass']==$jushinPass3){

		//�ҏW�t�H�[���œ��͂��ꂽ���Ƃ̏ؖ���hidden=100
		$jushinHandan1=$_POST['handan1'];

		//�ҏW�������ԍ��̖��O�E�R�����g�E�p�X���[�h�����
		$dateName=$gyo['name'];
		$dateComment=$gyo['comment'];
		$datePass=$gyo['pass'];

	    }
	}
    }

//���ҏW���������ہA�p�X���[�h�������Ă����Ƃ��̏�����
//////////////////////////////////////////////////////////////////////////////////////////////////////////////


?>



<html>

    <head>

	<!-�^�C�g��->
	<title>�����H�ׂ����I�I</title>

    </head>



<body>

    <!-���o��->
    <h1>�����H�ׂ����I�I</h1>


<!-//////////////////////////////////////////////////////////////////////////////////////////////////////////////->
<!-�����M�t�H�[����->

    <form method="POST" action="mission_2-15.php">

	<!-���O�̓��̓t�H�[��->
	���O�@�@�@<input type="text" name="namae" size="30" value="<?php echo $dateName ?>"><br>

	<!-�R�����g�̓��̓t�H�[��->
	�R�����g�@<input type="text" name="comment" size="50" value="<?php echo $dateComment ?>"><br>

	<!-�p�X���[�h�̓��̓t�H�[��->
	�p�X���[�h<input type="password" name="pass1" size="30" value="<?php echo $datePass ?>">

	<!-�ҏW���ꂽ�Ƃ��̂ݑ���hidden�l->
	<input type="hidden" name="handan2" value="<?php echo $jushinHandan1 ?>">
	<input type="hidden" name="hensyu2" value="<?php echo $jushinHensyu1 ?>">
	<input type="hidden" name="pass3" value="<?php echo $jushinPass3 ?>">

	<!-���M�t�H�[��->
	<input type="submit" value="���M"><br>

    </form>

    <!-�d�؂��->
    <hr>

<!-�����M�t�H�[����->
<!-///////////////////////////////////////////////////////////////////////////////////////////////////////////->

<!-///////////////////////////////////////////////////////////////////////////////////////////////////////////->
<!-���폜�t�H�[����->

    <form method="POST" action="mission_2-15.php">

	<!-�폜�������ԍ��̓��̓t�H�[��->
	�폜�Ώ۔ԍ�<input type="text" name="sakujo" size="10"><br>

	<!-�p�X���[�h�̓��̓t�H�[���i�폜�j->
	�p�X���[�h�@<input type="password" name="pass2">

	<!-�폜�t�H�[��->
	<input type="submit" value="�폜">

    </form>

    <?php

	//�폜�������ԍ����󂯎��
	$jushinSakujo=$_POST['sakujo'];
	$jushinPass2=$_POST['pass2'];

	if(empty($jushinSakujo) || empty($jushinPass2)){

	}else{

	    $sql='SELECT*FROM mission';
	    $select=$pdo->query($sql);
	    foreach($select as $gyo){

		//�p�X���[�h�������Ă����Ƃ�
		if($gyo['num']==$jushinSakujo && $gyo['pass']==$jushinPass2){

		    //�u���̔ԍ��͍폜����܂����v�ƃf�[�^�x�[�X�ɏ㏑��
	            $nm="���̔ԍ��͍폜����܂���";
	            $kome="";
	            $zikan="";
		    $pasu="";
	            $sql="update mission set name='$nm', comment='$kome', time='$zikan' where num=$jushinSakujo";
	            $result=$pdo->query($sql);

		//���łɍ폜����Ă���Ƃ�
		}elseif($gyo['num']==$jushinSakujo && empty($gyo['comment'])){

	    	    echo '���w�肳�ꂽ�ԍ��͍폜�ς݂ł�';

		//�p�X���[�h���Ⴄ�Ƃ�
		}elseif($gyo['num']==$jushinSakujo && $gyo['pass']!==$jushinPass2){

		    //�u���p�X���[�h���Ⴂ�܂��v�ƕ\��
		    echo '���p�X���[�h���Ⴂ�܂�';

		}
	    }
	}

    ?>

    <!-�d�؂��->
    <hr>

<!-���폜�t�H�[����->
<!-///////////////////////////////////////////////////////////////////////////////////////////////////////////->

<!-///////////////////////////////////////////////////////////////////////////////////////////////////////////->
<!-���ҏW�t�H�[����->

    <form method="POST" action="mission_2-15.php">

	<!-�ҏW�������ԍ��̓��̓t�H�[��->
	�ҏW�Ώ۔ԍ�<input type="text" name="hensyu1" size="10"><br>

	<!-�p�X���[�h�̓��̓t�H�[���i�ҏW�j->
	�p�X���[�h�@<input type="password" name="pass3">

	<!-�ҏW�t�H�[��->
	<input type="submit" value="�ҏW">

	<!-�ҏW�̍ۂ�hidden�̒l�����M���� handan=100->
	<input type="hidden" name="handan1" value="100">

    </form>

    <?php

	//�ҏW�������ԍ��ƃp�X���[�h���󂯎��
	$jushinHensyu1=$_POST['hensyu1'];
	$jushinPass3=$_POST['pass3'];

	//�����������܂ꂸ�ɕҏW�������Ă������N����Ȃ�
	if(empty($jushinHensyu1)){

	}else{

	    $sql='SELECT*FROM mission';
	    $select=$pdo->query($sql);
	    foreach($select as $gyo){

		//�w�肵���ԍ������łɍ폜���ꂽ���̂Ȃ�
		if($gyo['num']==$jushinHensyu1 && empty($gyo['comment'])){

		    echo '���w�肳�ꂽ�ԍ��͂��łɍ폜����Ă��܂�';

		//�p�X���[�h���Ⴄ�Ƃ�
		}elseif($gyo['num']==$jushinHensyu1 && $gyo['pass']!==$jushinPass3){

		    echo '���p�X���[�h���Ⴂ�܂�';

		}
	    }
	}

    ?>

<!-���ҏW�t�H�[����->
<!-///////////////////////////////////////////////////////////////////////////////////////////////////////////->

    <!-�d�؂��->
    <hr><hr>

<?php

    //���s�ڂ�������(���e�ԍ��j
    $a=0;
    $sql='SELECT*FROM mission';
    $results=$pdo->query($sql);
    foreach($results as $row){
	$a++;
    } 
    $cnt=$a+1;

    //UNIX TIMESTMP���擾
    $tomestamp=time();

    //�������o��
    $time=date("Y/m/d H:i:s");

    //�t�H�[���œ��͂��ꂽ��������󂯎��
    $jushinName=$_POST['namae'];
    $jushinComment=$_POST['comment'];
    $jushinHandan2=$_POST['handan2'];
    $jushinHensyu2=$_POST['hensyu2'];
    $jushinPass1=$_POST['pass1'];
    $jushinPass3=$_POST['pass3'];


//////////////////////////////////////////////////////////////////////////////////////////////////////////////
//<�ҏW���̑��M�E�ʏ�̑��M��

    //�����������܂ꂸ�ɑ��M�������Ă������N����Ȃ�(�R�����g�j
    if(empty($jushinName)||empty($jushinComment)||empty($jushinPass1)){

    //�ҏW����Ƃ�
    }elseif($jushinHandan2==100){

	$sql='SELECT*FROM mission';
	$select=$pdo->query($sql);
	foreach($select as $gyo){

	    //�ҏW�őł��ꂽ�ԍ��Ɠ����Ƃ�
	    if($gyo['num']==$jushinHensyu2 && $gyo['pass']==$jushinPass3){

	        $nm=$jushinName;
	        $kome=$jushinComment;
		$zikan=$time;
	        $pasu=$jushinPass1;
	        $sql="update mission set name='$nm', comment='$kome', time='$zikan', pass='$pasu' where num=$jushinHensyu2";
	        $result=$pdo->query($sql);

	    }
	}

    //�����������񂾏�ő��M���������ꍇ(�ʏ�ver)
    }else{

	//���͂��ꂽ���̂��f�[�^�x�[�X���ɏ�������
	$sql=$pdo->prepare("INSERT INTO mission(num,name,comment,time,pass) VALUES(:num,:name,:comment,:time,:pass)");
	$sql->bindParam(':num',$cnt,PDO::PARAM_STR);
	$sql->bindParam(':name',$jushinName,PDO::PARAM_STR);
	$sql->bindParam(':comment',$jushinComment,PDO::PARAM_STR);
	$sql->bindParam(':time',$time,PDO::PARAM_STR);
	$sql->bindParam(':pass',$jushinPass1,PDO::PARAM_STR);
	$sql->execute();

    }

//<�ʏ�̑��M��
//////////////////////////////////////////////////////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////////////////////////////////////////////////////
//���u���E�U�ɕ\����

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

//���u���E�U�ɕ\����
//////////////////////////////////////////////////////////////////////////////////////////////////////////////

?>

</body>
</html>
