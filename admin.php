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
    header('WWW-Authenticate: Basic rеаlm=".login"'); 
    exit('');
  }
  if (!empty($row)){
    echo "<p>Добро пожаловать: " . htmlspecialchars($_SERVER['PHP_AUTH_USER']) . "<br />";
    echo "<form action='' method='post'>\n";
    echo "<input type='hidden' name='SeenBefore' value='1' />\n";
    echo "<input type='hidden' name='OldAuth' value=\"" . htmlspecialchars($_SERVER['PHP_AUTH_USER']) . "\" />\n";
    echo "<input type='submit' value='Авторизоваться повторно' />\n";
    echo "</form></p>\n";
    $num=1;
    $messages[] = sprintf("
    <head>
      <meta charset='utf-8'>
      <link rel='stylesheet' href = 'style.css'>
    </head>
    <table>
      <th>num</th>
      <th class='small_size'>login</th>
      <th class='big_size'>password</th>
      <th >name</th>
      <th >email</th>
      <th >date</th>
      <th class='center'>sex</th>
      <th class='small_size'>limb</th>
      <th class='center'>ability1</th>
      <th class='center'>ability2</th>
      <th class='center'>ability3</th>
      <th class='center'>ability4</th>
      <th class='center'>ability5</th>
      <th class='center'>ability6</th>
      <th class='center'>ability7</th>
      <th class='center'>ability8</th>
      <th class='big_size'>osebe</th>
      <th class='center'>kontract</th>
      <th class='center'>Удалить</th>
    </table>
    ");


    foreach($db->query('SELECT * FROM profi') as $row){
      $messages[] = sprintf("
      <head>
        <meta charset='utf-8'>
        <link rel='stylesheet' href = 'style.css'>
      </head>
      <table>
        <td>%s</td>
        <td class='small_size'>%s</td>
        <td class='big_size'>%s</td>
        <td >%s</td>
        <td >%s</td>
        <td >%s</td>
        <td class='center'>%s</td>
        <td class='small_size'>%s</td>
        <td class='center'>%s</td>
        <td class='center'>%s</td>
        <td class='center'>%s</td>
        <td class='center'>%s</td>
        <td class='center'>%s</td>
        <td class='center'>%s</td>
        <td class='center'>%s</td>
        <td class='center'>%s</td>
        <td class='big_size'>%s</td>
        <td class='center'>%s</td>
        <td class='center'>
          <form method='POST' action='delete.php'>
            <input type='submit' name='save' value='%s' />
          </form>
        </td>
      </table>
      ",
      strip_tags($num),
      strip_tags($row['login']),
      strip_tags($row['password']),
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