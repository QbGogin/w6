<?php
header('Content-Type: text/html; charset=UTF-8');
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
$messages = array();
  if (!empty($_COOKIE['save'])) {
    setcookie('save', '', 100000);
    $messages[] = 'Спасибо, результаты сохранены.';
    if (!empty($_COOKIE['pass'])) {
      $messages[] = sprintf("Вы можете <a href='login.php'>Войти</a> с логином <strong>%s</strong> и паролем <strong>%s</strong> для изменения данных.",
      strip_tags($_COOKIE['login']),
      strip_tags($_COOKIE['pass']));
    }
  }

  $errors = array();

  $errors['name'] = !empty($_COOKIE['name_error']);
  $errors['email'] = !empty($_COOKIE['email_error']);
  $errors['date'] = !empty($_COOKIE['date_error']);
  $errors['sex'] = !empty($_COOKIE['sex_error']);
  $errors['limb'] = !empty($_COOKIE['limb_error']);
  $errors['abilities'] = !empty($_COOKIE['abilities_error']);
  $errors['osebe'] = !empty($_COOKIE['osebe_error']);
  $errors['kontract'] = !empty($_COOKIE['kontract_error']);
 
  if ($errors['name']) {
    setcookie('name_error', '', 100000);
    $messages[] = '<div class="error">Заполните имя.</div>';
  }

  if ($errors['email']) {
      setcookie('email_error', '', 100000);
      $messages[] = '<div class="error">Заполните email в правильной форме</div>';
  }

  if ($errors['date']) {
      setcookie('date_error', '', 100000);
      $messages[] = '<div class="error">Заполните дату.</div>';
  }

  if ($errors['sex']) {
      setcookie('sex_error', '', 100000);
      $messages[] = '<div class="error">Выберите пол.</div>';
  }

  if ($errors['limb']) {
      setcookie('limb_error', '', 100000);
      $messages[] = '<div class="error">Выберите кол-во конечностей.</div>';
  }

  if ($errors['abilities']) {
      setcookie('abilities_error', '', 10000);
      $messages[] = '<div class="error">Выберите способность.</div>';
  }
  
  if ($errors['osebe']) {
    setcookie('osebe_error', '', 100000);
    $messages[] = '<div class="error">Введите сообщение.</div>';
  }

  if ($errors['kontract']) {
    setcookie('kontract_error', '', 100000);
    $messages[] = '<div class="error">Ознакомьтесь с контрактом.</div>';
  }
  $values = array();
  $values['name'] = empty($_COOKIE['name_value']) ? '' : strip_tags($_COOKIE['name_value']);
  $values['email'] = empty($_COOKIE['email_value']) ? '' : strip_tags($_COOKIE['email_value']);
  $values['date'] = empty($_COOKIE['date_value']) ? '' : strip_tags($_COOKIE['date_value']);
  $values['sex'] = empty($_COOKIE['sex_value']) ? '' :strip_tags($_COOKIE['sex_value']);
  $values['limb'] = empty($_COOKIE['limb_value']) ? '' : strip_tags($_COOKIE['limb_value']);
  $values['ability1'] = empty($_COOKIE['ability1_value']) ? '' : strip_tags($_COOKIE['ability1_value']);
  $values['ability2'] = empty($_COOKIE['ability2_value']) ? '' : strip_tags($_COOKIE['ability2_value']);
  $values['ability3'] = empty($_COOKIE['ability3_value']) ? '' : strip_tags($_COOKIE['ability3_value']);
  $values['ability4'] = empty($_COOKIE['ability4_value']) ? '' : strip_tags($_COOKIE['ability4_value']);
  $values['ability5'] = empty($_COOKIE['ability5_value']) ? '' : strip_tags($_COOKIE['ability5_value']);
  $values['ability6'] = empty($_COOKIE['ability6_value']) ? '' : strip_tags($_COOKIE['ability6_value']);
  $values['ability7'] = empty($_COOKIE['ability7_value']) ? '' : strip_tags($_COOKIE['ability7_value']);
  $values['ability8'] = empty($_COOKIE['ability8_value']) ? '' : strip_tags($_COOKIE['ability8_value']);
  $values['osebe'] = empty($_COOKIE['osebe_value']) ? '' :strip_tags($_COOKIE['osebe_value']);
  $values['kontract'] = empty($_COOKIE['kontract_value']) ? '' : strip_tags($_COOKIE['kontract_value']);


  if (!empty($_SESSION['login'])) {
    $db = new PDO('mysql:host=localhost;dbname=u20294', 'u20294', '5205554');
    try{
    	$row=$db->query("SELECT * FROM profi where login='".$_SESSION['login']."'")->fetch();
    	$values['name'] =strip_tags($row['name']);
    	$values['email'] = strip_tags($row['email']);
    	$values['date'] = strip_tags($row['date']);
    	$values['sex'] = strip_tags($row['sex']);
    	$values['limb'] = strip_tags($row['limb']);
    	$values['ability1'] =strip_tags($row['ability1']);
    	$values['ability2'] =strip_tags($row['ability2']);
      $values['ability3'] =strip_tags($row['ability3']);
      $values['ability1'] =strip_tags($row['ability4']);
    	$values['ability2'] =strip_tags($row['ability5']);
      $values['ability3'] =strip_tags($row['ability6']);
      $values['ability1'] =strip_tags($row['ability7']);
    	$values['ability2'] =strip_tags($row['ability8']);
      $values['osebe'] = strip_tags($row['osebe']);
   		$values['kontract'] = strip_tags($row['kontract']);
    }
		catch(PDOException $e){}
		$db = null;
    printf('Вход с логином %s, uid %d.', $_SESSION['login'], $_SESSION['uid']);
  }
    include('form.php');
}
else{
  $action = $_POST['save'];
  if($_POST['save'] =='выйти' || $_POST['save'] =='Создать нового пользователя'){//выходим из сессии и возвращаемся к index.php
    $values = array();
    $values['name'] = null;
    $values['email'] = null;
    $values['date'] = null;
    $values['sex'] = null;
    $values['limb'] = null;
    $values['ability1'] = null;
    $values['ability2'] = null;
    $values['ability3'] = null;
    $values['ability4'] = null;
    $values['ability5'] = null;
    $values['ability6'] = null;
    $values['ability7'] = null;
    $values['ability8'] = null;
    $values['osebe'] = null;
    $values['kontract'] = null;
    if(!empty($_SESSION['login'])){
      setcookie('save', '', 100000);
      setcookie('login', '', 100000);
      setcookie('pass', '', 100000);
      setcookie('name_value', '', 100000);
      setcookie('email_value', '', 100000);
      setcookie('date_value', '', 100000);
      setcookie('sex_value', '', 100000);
      setcookie('limb_value', '', 100000);
      setcookie('ability1_value', '', 100000);
      setcookie('ability2_value', '', 100000);
      setcookie('ability3_value', '', 100000);
      setcookie('ability4_value', '', 100000);
      setcookie('ability5_value', '', 100000);
      setcookie('ability6_value', '', 100000);
      setcookie('ability7_value', '', 100000);
      setcookie('ability8_value', '', 100000);
      setcookie('osebe_value', '', 100000);
      setcookie('kontract_value', '', 100000);
      $_COOKIE=array();
  }
    session_destroy();
      header('Location: index.php');
    }
    if($_POST['save'] =='войти'|| $_POST['save'] == 'Войти как пользователь'){
      session_destroy();
      header('Location: login.php');
    }
    if($_POST['save'] =='сохранить'){
      $errors = FALSE;  
      $messages[]='ok';
      if (empty($_POST['name'])) {
        setcookie('name_error', '1', time() + 24 * 60 * 60);
        $errors = TRUE;
      }
      else {
          setcookie('name_value', $_POST['name'], time() + 30 * 24 * 60 * 60);
      }

      if (!preg_match("|^[-0-9a-z_\.]+@[-0-9a-z_^\.]+\.[a-z]{2,6}$|i", $_POST['email'])) {
          setcookie('email_error', '1', time() + 24 * 60 * 60);
          $errors = TRUE;
      }
      else {
          setcookie('email_value', $_POST['email'], time() + 30 * 24 * 60 * 60);
      }

      if (empty($_POST['date'])) {
          setcookie('date_error', '1', time() + 24 * 60 * 60);
          $errors = TRUE;
      }
      else {
          setcookie('date_value', $_POST['date'], time() + 30 * 24 * 60 * 60);
      }   

      if (empty($_POST['sex'])) {
          setcookie('sex_error', '1', time() + 24 * 60 * 60);
          $errors = TRUE;
      }
      else {
          setcookie('sex_value', $_POST['sex'], time() + 30 * 24 * 60 * 60);
      }

      if (empty($_POST['limb'])) {
          setcookie('limb_error', '1', time() + 24 * 60 * 60);
          $errors = TRUE;
      }
      else {
          setcookie('limb_value', $_POST['limb'], time() + 30 * 24 * 60 * 60);
      }

      if (!isset($_POST['ability1'])
       && !isset($_POST['ability2'])
       && !isset($_POST['ability3'])
       && !isset($_POST['ability4'])
       && !isset($_POST['ability5'])
       && !isset($_POST['ability6'])
       && !isset($_POST['ability7'])
       && !isset($_POST['ability8'])) {
          setcookie('abilities_error', '1', time() + 24 * 60 * 60);
          $errors = TRUE;
        }
      else {
        setcookie('ability1_value', isset($_POST['ability1']) ? $_POST['ability1'] : '', time() + 365 * 30 * 24 * 60 * 60);
        setcookie('ability2_value', isset($_POST['ability2']) ? $_POST['ability2'] : '', time() + 365 * 30 * 24 * 60 * 60);
        setcookie('ability3_value', isset($_POST['ability3']) ? $_POST['ability3'] : '', time() + 365 * 30 * 24 * 60 * 60);
        setcookie('ability4_value', isset($_POST['ability4']) ? $_POST['ability4'] : '', time() + 365 * 30 * 24 * 60 * 60);
        setcookie('ability5_value', isset($_POST['ability5']) ? $_POST['ability5'] : '', time() + 365 * 30 * 24 * 60 * 60);
        setcookie('ability6_value', isset($_POST['ability6']) ? $_POST['ability6'] : '', time() + 365 * 30 * 24 * 60 * 60);
        setcookie('ability7_value', isset($_POST['ability7']) ? $_POST['ability7'] : '', time() + 365 * 30 * 24 * 60 * 60);
        setcookie('ability8_value', isset($_POST['ability8']) ? $_POST['ability8'] : '', time() + 365 * 30 * 24 * 60 * 60);
      }

      if (empty($_POST['osebe'])) {
          setcookie('osebe_error', '1', time() + 24 * 60 * 60);
          $errors = TRUE;
      }
      else {
          setcookie('osebe_value', $_POST['osebe'], time() + 30 * 24 * 60 * 60);
      }

      if (empty($_POST['kontract'])) {
          setcookie('kontract_error', '1', time() + 24 * 60 * 60);
          $errors = TRUE;
      }
      else {
          setcookie('kontract_value', $_POST['kontract'], time() + 30 * 24 * 60 * 60);
      }

    if ($errors) {
      header('Location: index.php');
      exit();
    }
    else{
      setcookie('name_error', '', 100000);
      setcookie('email_error', '', 100000);
      setcookie('date_error', '', 100000);
      setcookie('sex_error', '', 100000);
      setcookie('limb_error', '', 100000);
      setcookie('abilities_error', '', 100000);
      setcookie('osebe_error', '', 100000);
      setcookie('kontract_error', '', 100000);
    }
      if (!empty($_COOKIE[session_name()]) && session_start() && !empty($_SESSION['login'])) {
        setcookie('login', $login);
        setcookie('pass', $pass);
        extract($_POST);
        $user = 'u20294';
        $password = '5205554';
        $db = new PDO('mysql:host=localhost;dbname=u20294', $user, $password);
        extract($_POST);
        $login = $_SESSION['login'];
        $name = $_POST['name'];
        $email = $_POST['email'];
        $date = $_POST['date'];
        $sex = $_POST['sex'];
        $limb = $_POST['limb'];
        if(!empty( $_POST['ability1'])){
          $ability1 = $_POST['ability1'];
        }
        else{
          $ability1 = '';
        }
        if(!empty( $_POST['ability2'])){
          $ability2 = $_POST['ability2'];
        }
        else{
          $ability2 = '';
        }
        if(!empty( $_POST['ability3'])){
          $ability3 = $_POST['ability3'];
        }
        else{
          $ability3 = '';
        }
        if(!empty( $_POST['ability4'])){
          $ability4 = $_POST['ability4'];
        }
        else{
          $ability4 = '';
        }
        if(!empty( $_POST['ability5'])){
          $ability5 = $_POST['ability5'];
        }
        else{
          $ability5 = '';
        }
        if(!empty( $_POST['ability6'])){
          $ability6 = $_POST['ability6'];
        }
        else{
          $ability6 = '';
        }
        if(!empty( $_POST['ability7'])){
          $ability7 = $_POST['ability7'];
        }
        else{
          $ability7 = '';
        }
        if(!empty( $_POST['ability8'])){
          $ability8 = $_POST['ability8'];
        }
        else{
          $ability8 = '';
        }
        $osebe = $_POST['osebe'];
        $kontract = $_POST['kontract'];
        try {
          $sth = $db->prepare("UPDATE profi SET name=:name, email=:email, date=:date, sex=:sex, limb=:limb, ability1=:ability1, ability2=:ability2,
           ability3=:ability3,ability4=:ability4,ability5=:ability5,ability6=:ability6,ability7=:ability7,ability8=:ability8, osebe=:osebe, kontract=:kontract WHERE login=:login");
          $sth->bindParam(':login', $login);
          $sth->bindParam(':name', $name);
          $sth->bindParam(':email', $email);
          $sth->bindParam(':date', $date);
          $sth->bindParam(':sex', $sex);
          $sth->bindParam(':limb', $limb);
          $sth->bindParam(':ability1', $ability1);
          $sth->bindParam(':ability2', $ability2);
          $sth->bindParam(':ability3', $ability3);
          $sth->bindParam(':ability4', $ability4);
          $sth->bindParam(':ability5', $ability5);
          $sth->bindParam(':ability6', $ability6);
          $sth->bindParam(':ability7', $ability7);
          $sth->bindParam(':ability8', $ability8);
          $sth->bindParam(':osebe', $osebe);
          $sth->bindParam(':kontract', $kontract);
          $sth->execute();
        }
      catch(PDOException $e){
        print('Error : ' . $e->getMessage());
        exit();
      }  
      setcookie('save', '1');
      $messages[] = 'Спасибо, результаты сохранены.';
      header('Location: index.php');
      }
      else {
        $user = 'u20294';
        $password = '5205554';
        $db = new PDO('mysql:host=localhost;dbname=u20294', $user, $password);
        extract($_POST);
        $b=TRUE;
        try {
          while($b){
            $login = (string)rand(1, 200);
            $pass = (string)rand(1, 100);
            $b=FALSE;
            foreach($db->query('SELECT login FROM profi') as $row){
              if($row['login']==$login){
                $b=TRUE;
              }
            }
          }
        }
        catch(PDOException $e){
          print('Error : ' . $e->getMessage());
          setcookie('save', '1');
          exit();
        }
        setcookie('login', $login);
        setcookie('pass', $pass);
        extract($_POST);
        $user = 'u20294';
        $password = '5205554';
        $db = new PDO('mysql:host=localhost;dbname=u20294', $user, $password);
        $hash = (string)md5($pass);
        $name = $_POST['name'];
        $email = $_POST['email'];
        $date = $_POST['date'];
        $sex = $_POST['sex'];
        $limb = $_POST['limb'];
        if(!empty( $_POST['ability1'])){
          $ability1 = $_POST['ability1'];
        }
        else{
          $ability1 = '';
        }
        if(!empty( $_POST['ability2'])){
          $ability2 = $_POST['ability2'];
        }
        else{
          $ability2 = '';
        }
        if(!empty( $_POST['ability3'])){
          $ability3 = $_POST['ability3'];
        }
        else{
          $ability3 = '';
        }
        if(!empty( $_POST['ability4'])){
          $ability4 = $_POST['ability4'];
        }
        else{
          $ability4 = '';
        }
        if(!empty( $_POST['ability5'])){
          $ability5 = $_POST['ability5'];
        }
        else{
          $ability5 = '';
        }
        if(!empty( $_POST['ability6'])){
          $ability6 = $_POST['ability6'];
        }
        else{
          $ability6 = '';
        }
        if(!empty( $_POST['ability7'])){
          $ability7 = $_POST['ability7'];
        }
        else{
          $ability7 = '';
        }
        if(!empty( $_POST['ability8'])){
          $ability8 = $_POST['ability8'];
        }
        else{
          $ability8 = '';
        }
        $osebe = $_POST['osebe'];
        $kontract = $_POST['kontract'];
        try {
          $sth = $db->prepare("INSERT INTO profi (login, password, name, email, date, sex, limb, ability1, ability2, ability3,ability4, ability5, ability6,ability7, ability8,  osebe, kontract)
           VALUES (:login, :pass, :name, :email, :date, :sex, :limb, :ability1, :ability2, :ability3,:ability4, :ability5, :ability6,:ability7, :ability8, :osebe, :kontract)");
          $sth->bindParam(':login', $login, PDO::PARAM_INT);
          $sth->bindParam(':pass', $hash);
          $sth->bindParam(':name', $name);
          $sth->bindParam(':email', $email);
          $sth->bindParam(':date', $date);
          $sth->bindParam(':sex', $sex);
          $sth->bindParam(':limb', $limb);
          $sth->bindParam(':ability1', $ability1);
          $sth->bindParam(':ability2', $ability2);
          $sth->bindParam(':ability3', $ability3);
          $sth->bindParam(':ability4', $ability1);
          $sth->bindParam(':ability5', $ability2);
          $sth->bindParam(':ability6', $ability3);
          $sth->bindParam(':ability7', $ability1);
          $sth->bindParam(':ability8', $ability2);
          $sth->bindParam(':osebe', $osebe);
          $sth->bindParam(':kontract', $kontract);
          $sth->execute();
        }
        catch(PDOException $e){
          print('Error : ' . $e->getMessage());
          exit();
        }
      }  
      setcookie('save', '1');
      $messages[] = 'Спасибо, результаты сохранены.';
      header('Location: index.php');
    }
  }