 <?php
extract($_POST);
try {
    $user = 'u20294';
    $password = '5205554';
    $db = new PDO('mysql:host=localhost;dbname=u20294', $user, $password);
    $login = $_POST['save'];
    $sth = $db->prepare("DELETE FROM profi WHERE login=:login");
    $sth->bindParam(':login', $login);
    $sth->execute();
    header('Location: admin.php');
}
catch(PDOException $e){
    print('Error : ' . $e->getMessage());
    exit();
}
?>