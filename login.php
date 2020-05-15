<?php
header('Content-Type: text/html; charset=UTF-8');
session_start();
if (!empty($_SESSION['login'])) {
  header('Location: index.php');
}
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
  $messages = array();
  $errors = array();
  $errors['login'] = !empty($_COOKIE['login_error']);
  $errors['pass'] = !empty($_COOKIE['pass_error']);
  if (!empty($errors['login'])) {
    setcookie('login_error', '', 100000);
    $messages[] = '<div class="error">Неверный login</div>';
  }
  else if(!empty($errors['pass'])){
    setcookie('pass_error', '', 100000);
    $messages[] = '<div class="error">Неверный пароль </div>';
  }
?>
<html lang="ru">
  	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">   <meta name="viewport" content="width=device-wedth,initial-scale=1.0">
		<link rel="stylesheet" href = "style.css">
		<title>Вход пользователя</title>
	</head>
  <?php
    if (!empty($messages)) {
      print('<div id="messages">');
      foreach ($messages as $message) {
        print($message);
      }
      print('</div>');
    }
  ?>
  <div class="container justify-content-center p=0 m=0" id="content">
    <form action="login.php" method="post">
      <p><h2>Войдите для изменения данных </p>
      <p>Логин:</p>
      <input name="login" id="login"  placeholder="логин"/>
      <p>Пароль:</p>
      <input name="pass" id="pass" placeholder="пароль"/></br>
      <input type="submit" id="in" value="Войти"/>
      </h2>
    </form>
    <form method="POST" action="admin.php">
      <input type='hidden' name='SeenBefore' value='1' />
        <input type='hidden' name='OldAuth' value="<?php print($_SERVER['PHP_AUTH_USER']); ?>"/>
      <input type='submit' name="save" id="in" value='Авторизоваться повторно как администратор'/>
    </form>
    <form action='index.php' method='post'>
      <input type='submit' name='save' id="in" value='Создать нового пользователя'/>
    </form></p>
  </div>
</html>
<?php
}
else {
  $errors = FALSE;
    if (empty($_POST['login'])) {
      setcookie('login_error', '1', time() + 24 * 60 * 60);
      $errors = TRUE;
    }
    else {
      setcookie('login_value', $_POST['login'], time() + 30 * 24 * 60 * 60);
    }
    if (empty($_POST['pass'])) {
      setcookie('pass_error', '1', time() + 24 * 60 * 60);
      $errors = TRUE;
    }
    else{
      setcookie('pass_value', $_POST['pass'], time() + 30 * 24 * 60 * 60);
    }
    if ($errors) {
      header('Location: login.php');
      exit();
    }
    else {
      try {
        $db = new PDO('mysql:host=localhost;dbname=u20294', 'u20294', '5205554');
        $row=$db->query("SELECT login FROM profi where login='".(string)$_POST['login']."' AND password='".(string)md5($_POST['pass'])."'")->fetch();
        $db = null;
      }
      catch(PDOException $e){}
      if (!empty($row)) {
        $_SESSION['login'] = (string)$_POST['login'];
        $_SESSION['pass'] = (string)md5($_POST['pass']);
        $_SESSION['uid'] = $_SESSION['login'];
        header('Location: index.php');
      }
      else{
        setcookie('login_error', '1', time() + 24 * 60 * 60);
        header('Location: login.php'); 
      }
    }
  }