<?php
 if (!empty($messages)) {
  print('<div id="messages">');
  foreach ($messages as $message) {
    print($message);
  }
  print('</div>');
}
function authenticate() {
  header('HTTP/l.1 401 Unauthorized');
  header('WWW-Authenticate: Basic rеаlm="admin.php"');
  print('<h1>401 Требуется авторизация</h1>');
  exit();
}
if(isset($_POST['OldAuth'])){
  $p = $_POST['OldAuth'];
}
else{
  $p=0;
}
if (!isset($_SERVER['PHP_AUTH_USER']) ||
isset($_POST['SeenBefore']) && $p == $_SERVER['PHP_AUTH_USER']) {
  authenticate();
}
else{
  try {
    $db = new PDO('mysql:host=localhost;dbname=u20294', 'u20294', '5205554');
    $row=$db->query("SELECT login FROM admin where login='".(string)$_SERVER['PHP_AUTH_USER']."' AND password='".(string)md5($_SERVER['PHP_AUTH_PW'])."'")->fetch();
  }
  catch(PDOException $e){
    header('HTTP/l.1 401 Unauthorized');
    header('WWW-Authenticate: Basic rеаlm="admin.php"'); 
    exit('');
  }
  if (!empty($row)){
    echo "<p>Добро пожаловать: " . htmlspecialchars($_SERVER['PHP_AUTH_USER']) . "<br />";
    echo "<form action='' method='post'>\n";
    echo "<input type='hidden' name='SeenBefore' value='1' />\n";
    echo "<input type='hidden' name='OldAuth' value=\"" . htmlspecialchars($_SERVER['PHP_AUTH_USER']) . "\" />\n";
    echo "<input type='hidden' name='save'/>\n";
    echo "<input style='border-radius: 50px; margin:5px;' type='submit' value='Авторизоваться повторно как администратор'/>\n";
    echo "</form></p>\n";
    echo "<form action='index.php' method='post'>\n";
    echo "<input type='submit' name='save' id='out' value='Создать нового пользователя'/>\n";
    echo "<input type='submit' name='save' id='out' value='Войти как пользователь'/>\n";
    echo "</form></p>\n";
    $num=1;
    $messages[] = sprintf("
      <head>
        <meta charset='utf-8'>
        <link rel='stylesheet' href = 'style.css'>
        <title>Администратор web6</title>
      </head>
      <table>
      <tr>
        <th>num</th>
        <th class='short'>login</th>
        <th class='short'>password</th>
        <th >name</th>
        <th >email</th>
        <th >date</th>
        <th class='middle'>sex</th>
        <th class='short'>limb</th>
        <th class='middle'>ability1</th>
        <th class='middle'>ability2</th>
        <th class='middle'>ability3</th>
        <th class='middle'>ability4</th>
        <th class='middle'>ability5</th>
        <th class='middle'>ability6</th>
        <th class='middle'>ability7</th>
        <th class='middle'>ability8</th>
        <th class='long'>osebe</th>
        <th class='middle'>kontract</th>
        <th class='middle'>Удалить</th>
      </tr>
    ");
    foreach($db->query('SELECT * FROM profi') as $row){
      $n=1;
      while(true){
        if(md5($n)!=$row['password']){
          $n=$n+1;
        }
        else{
          break;
        }
      }
      $messages[] = sprintf("
        <tr>
          <td>%s</td>
          <td class='short'>%s</td>
          <td class='short'>%s</td>
          <td >%s</td>
          <td >%s</td>
          <td >%s</td>
          <td class='middle'>%s</td>
          <td class='short'>%s</td>
          <td class='middle'>%s</td>
          <td class='middle'>%s</td>
          <td class='middle'>%s</td>
          <td class='middle'>%s</td>
          <td class='middle'>%s</td>
          <td class='middle'>%s</td>
          <td class='middle'>%s</td>
          <td class='middle'>%s</td>
          <td class='long'>%s</td>
          <td class='middle'>%s</td>
          <td class='middle'>
            <form method='POST' action='delete.php'>
              <input type='submit' name='save' value='%s' />
            </form>
          </td>
        </tr>
      ",
      strip_tags($num),
      strip_tags($row['login']),
      strip_tags($n),
      strip_tags($row['name']),
      strip_tags($row['email']),
      strip_tags($row['date']),
      strip_tags($row['sex']),
      strip_tags($row['limb']),
      strip_tags($row['ability1']),
      strip_tags($row['ability2']),
      strip_tags($row['ability3']),
      strip_tags($row['ability4']),
      strip_tags($row['ability5']),
      strip_tags($row['ability6']),
      strip_tags($row['ability7']),
      strip_tags($row['ability8']),
      strip_tags($row['osebe']),
      strip_tags($row['kontract']),
      strip_tags($row['login']),
      );
      $num=$num+1;
    }
    $messages[] = sprintf("</table>");
    if (!empty($messages)) {
      print('<div id="messages">');
      foreach ($messages as $message) {
        print($message);
      }
      print('</div>');
    }
  }
  else{
    authenticate();
  }
}
?>