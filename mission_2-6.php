<?php
///////////////////////////////////////////////////////////////////////////////////////////////////////////////
//���ҏW���������ہA�p�X���[�h�������Ă����Ƃ��̏�����

    $filename = 'kadai26.txt';

    //�ҏW�̃p�X���[�h���ł��ꂽ�Ƃ�
    $jushinPass3 = $_POST['pass3'];

    //�ҏW�t�H�[���œ��͂��ꂽ���������
    $jushinHensyu1 = $_POST['hensyu1'];


    //�����������܂ꂸ�ɕҏW�������Ă������N����Ȃ�
    if(empty($jushinHensyu1)  ||  empty($jushinPass3)){

    //�������������񂾏�ŕҏW���������ꍇ
    } else {

	//�t�@�C���S�̂�z��ɓ����
	$hairetsu = file($filename);

	//1�s�����f
	foreach($hairetsu as $chat1){

	    //<>�����ڂɔz��ɕ�����
	    $pieces = explode("<>",$chat1);

	    //���͂��ꂽ�����Ɣԍ��������Ƃ�
	    if($pieces[0] == $jushinHensyu1){

		//�p�X���[�h����v�����Ƃ�
		if($pieces[4] == $jushinPass3."\n"){

		    //�ҏW�t�H�[���œ��͂��ꂽ���Ƃ̏ؖ���hidden=100
		    $jushinHandan1 = $_POST['handan1'];

		    //�ҏW�������ԍ��̖��O�E�R�����g�E�p�X���[�h�����
		    $dateName = $pieces[1];
		    $dateComment = $pieces[2];
		    $datePass = $pieces[4];
		}
	    }
	}
    }

//���ҏW���������ہA�p�X���[�h�������Ă����Ƃ��̏�����
///////////////////////////////////////////////////////////////////////////////////////////////////////////////
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

    <form method="POST" action="mission_2-6.php">

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
<!-//////////////////////////////////////////////////////////////////////////////////////////////////////////////->



<!-//////////////////////////////////////////////////////////////////////////////////////////////////////////////->
<!-���폜�t�H�[����->

    <form method="POST" action="mission_2-6.php">

	<!-�폜�������ԍ��̓��̓t�H�[��->
	�폜�Ώ۔ԍ�<input type="text" name="sakujo" size="10"><br>

	<!-�p�X���[�h�̓��̓t�H�[���i�폜�j->
	�p�X���[�h�@<input type="password" name="pass2">

	<!-�폜�t�H�[��->
	<input type="submit" value="�폜">

    </form>

    <?php

	$filename = 'kadai26.txt';

	//�폜�������ԍ��ƃp�X���[�h���󂯎��
	$jushinSakujo = $_POST['sakujo'];
	$jushinPass2 = $_POST['pass2'];

	//�����������܂ꂸ�ɍ폜�������Ă������N����Ȃ�
	if(empty($jushinSakujo)){

	//�ԍ����������܂�Ă�������s
	} else {

	    //�t�@�C���̕���1�s���z��ɓ����
	    $hairetsu = file($filename);

	    //�t�@�C�����J��
	    $fp = fopen($filename,'w');

	    //1�񂸂]�����Ă���
	    foreach($hairetsu as $chat){

		//��؂育�ƂɁA�z��ɓ����
		$pieces = explode("<>",$chat);

		//�p�X���[�h�������Ă����Ƃ�
		if($pieces[0] == $jushinSakujo  &&  $pieces[4] == $jushinPass2."\n"){

		    //�u���̓��e�͍폜����܂����v�ƋL�q
		    fwrite($fp,$pieces[0]."<>"."���̓��e�͍폜����܂���"."<>"."<>"."<>"."\n");

		//���łɍ폜����Ă���Ƃ�
		} elseif($pieces[0] == $jushinSakujo  &&  empty($pieces[2])){

		    fwrite($fp,$chat);

		    echo '���w�肳�ꂽ�ԍ��͍폜�ς݂ł�';

	        //�p�X���[�h���Ⴄ�Ƃ�
	        } elseif($pieces[0] == $jushinSakujo  &&  $pieces[4] !== $jushinPass2."\n"){

		    fwrite($fp,$chat);

		    //�p�X���[�h���Ⴂ�܂��ƕ\��
		    echo '���p�X���[�h���Ⴂ�܂�';

	        } else {

	        //�폜�t�H�[���ɓ��͂��ꂽ�����ƈႤ�Ȃ�ۑ��i�e�L�X�g�t�@�C���ɏ������ށj
	        fwrite($fp,$chat);
	        }
	    }

	    fclose($fp);
	}

    ?>

    <!-�d�؂��->
    <hr>

<!-���폜�t�H�[����->
<!-//////////////////////////////////////////////////////////////////////////////////////////////////////////////->



<!-///////////////////////////////////////////////////////////////////////////////////////////////////////////////->
<!-�ҏW�t�H�[��->

    <form method="POST" action="mission_2-6.php">

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

	$filename = 'kadai26.txt';

	//�ҏW�������ԍ��ƃp�X���[�h���󂯎��
	$jushinHensyu1 = $_POST['hensyu1'];
	$jushinPass3 = $_POST['pass3'];

	//�����������܂ꂸ�ɕҏW�������Ă������N����Ȃ�
	if(empty($jushinHensyu1)){

	//�ԍ����������܂�Ă�������s
	} else {

	    //�t�@�C���̕���1�s���z��ɓ����
	    $hairetsu = file($filename);

	    //1�񂸂]�����Ă���
	    foreach($hairetsu as $chat){

		//��؂育�ƂɁA�z��ɓ����
		$pieces = explode("<>",$chat);

		//�w�肳�ꂽ�ԍ������łɍ폜���ꂽ���̂Ȃ�
		if($pieces[0] == $jushinHensyu1  &&  empty($pieces[2])){

		    echo '���w�肳�ꂽ�ԍ��͍폜����Ă��܂�';

		//�p�X���[�h���Ⴄ�Ƃ�
		}elseif($pieces[0] == $jushinHensyu1  &&  $pieces[4] !== $jushinPass3."\n"){

		    echo '���p�X���[�h���Ⴂ�܂�';
		}
	    }
	}

    ?>
<!-�ҏW�t�H�[��->
<!-///////////////////////////////////////////////////////////////////////////////////////////////////////////////->

    <!-�d�؂��->
    <hr><hr>


    <?php

	$filename = 'kadai26.txt';

	$fp = fopen($filename,'a');
	fclose($fp);

	//UNIX TIMESTMP���擾
	$tomestamp = time();

	//�������o��
	$time = date("Y/m/d H:i:s");

	//�t�H�[���œ��͂��ꂽ��������󂯎��
	$jushinName = $_POST['namae'];
	$jushinComment = $_POST['comment'];
	$jushinHandan2 = $_POST['handan2'];
	$jushinHensyu2 = $_POST['hensyu2'];
	$jushinPass1 = $_POST['pass1'];



//////////////////////////////////////////////////////////////////////////////////////////////////////////////
//���ҏW���̑��M�E�ʏ�̑��M��

	//�����������܂ꂸ�ɑ��M�������Ă������N����Ȃ�(�R�����g�j
	if((empty($jushinName)  ||  empty($jushinComment))  ||  empty($jushinPass1)){
	
	//hidden�̒l��100�̏�Ԃő��M���������ꍇ(�ҏWver)
	}elseif ($jushinHandan2 == 100){

	    //�t�@�C����z��ɓ����
	    $hairetsu = file($filename);

	    //�t�@�C�����J��
	    $fp = fopen($filename,'w');

	    //�ҏW�őł��ꂽ�ԍ��Ɠ����Ȃ�㏑���A����ȊO�Ȃ炻�̂܂�
	    foreach($hairetsu as $chat){

		//1�s����<>�����ɔz��ɓ����
		$pieces = explode("<>",$chat);

		//�ҏW�őł��ꂽ�ԍ��Ɠ����Ƃ�
		if($pieces[0] == $jushinHensyu2  &&  $pieces[4] == $jushinPass3."\n"){
		    $pieces[1] = $jushinName;
		    $pieces[2] = $jushinComment;
		    $pieces[4] = $jushinPass1;
		    fwrite($fp,$pieces[0]."<>".$pieces[1]."<>".$pieces[2]."<>".$pieces[3]."<>".$pieces[4]."\n");

		//�ԍ��ƈႤ�Ƃ�
    		}else{
		    fwrite($fp,$pieces[0]."<>".$pieces[1]."<>".$pieces[2]."<>".$pieces[3]."<>".$pieces[4]);
    		}
	    }
	    fclose($fp);

	//�����������񂾏�ő��M���������ꍇ(�ʏ�ver)
	} else {

	    //�t�@�C���S�̂�z��ɓ����
	    $hairetsu = file($filename);

	    //�s�����J�E���g
	    $cnt = count($hairetsu) + 1;

	    //�t�@�C�����J��
	    $fp = fopen($filename,'a');

	    //���͂��ꂽ���̂��t�@�C���ɏ�������
	    fwrite($fp,$cnt."<>".$jushinName."<>".$jushinComment."<>".$time."<>".$jushinPass1."\n");

	    //�t�@�C�������
	    fclose($fp);
	}
//���ҏW���̑��M�E�ʏ�̑��M��
//////////////////////////////////////////////////////////////////////////////////////////////////////////////



//////////////////////////////////////////////////////////////////////////////////////////////////////////////
//���u���E�U�ɕ\����

	//�t�@�C���S�̂�z��ɓ����
	$hairetsu = file($filename);

	//1�s���]��
	foreach($hairetsu as $chat){

	    //<>�����ڂɔz��ɕ�����
	    $pieces = explode("<>",$chat);

	    //�������z���1��ɏ����o���Ă����i�p�X���[�h�ȊO�j
	    for($i=0; $i<4; $i++){
		echo $pieces[$i]." ";
	    }
	    echo "<br>";
	}

//���u���E�U�ɕ\����
//////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ?>


</body>
</html>