<!DOCTYPE html>
<html lang="ru">
  	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">   <meta name="viewport" content="width=device-wedth,initial-scale=1.0">
		<link rel="stylesheet" href = "style.css">
		<title>Пользователь web6</title>
	</head>

	<body>
		<div class="container justify-content-center p=0 m=0" id="content">
			<?php
				if (!empty($messages)) {
				print('<div id="messages">');
				// Выводим все сообщения.
				foreach ($messages as $mess) {
          print($mess);
				}
				print('</div><br/><br/>');
				}
			?>
			<form method="POST" action="">
				<legend>Контактная информация</legend>
				<label for="name">Имя:</label><br>
				<input type="text" id="name" name="name" <?php if ($errors['name']) {print 'class="error"';} ?> value="<?php print $values['name']; ?>" placeholder="Иван"><br>
				<label for="email">e-mail:</label><br>
				<input type="text" id="email" name="email" <?php if ($errors['email']) {print 'class="error"';} ?> value="<?php print $values['email']; ?>" placeholder="email"><br>
				<br/>Дата рождения:<br/>
					<input name="date" id="date" <?php if ($errors['date']) {print 'class="error"';} ?> value="<?php print $values['date']; ?>" type="text" placeholder="01.01.2000"/><br/>
				<label for="sex">Пол:</label><br>
					<input type="radio" name="sex" value="male" <?php if ($values['sex'] == 'male') {print 'checked="checked"';} ?>/> Мужской<br>
					<input type="radio" name="sex" value="female"<?php if ($values['sex'] == 'female') {print 'checked="checked"';} ?>/>Женский<br>
				<label for="limb">Кол-во конечностей:</label><br>
				<input type="radio" name="limb" <?php if ($errors['limb']) {print 'class="error"';} ?> value="1" <?php if ($values['limb'] == '1') {print 'checked="checked"';} ?> />1<br/>
                <input type="radio" name="limb" <?php if ($errors['limb']) {print 'class="error"';} ?> value="2" <?php if ($values['limb'] == '2') {print 'checked="checked"';} ?> />2<br/>
                <input type="radio" name="limb" <?php if ($errors['limb']) {print 'class="error"';} ?> value="3" <?php if ($values['limb'] == '3') {print 'checked="checked"';} ?> />3<br/>
                <input type="radio" name="limb" <?php if ($errors['limb']) {print 'class="error"';} ?> value="4" <?php if ($values['limb'] == '4') {print 'checked="checked"';} ?> />4<br/>
                <input type="radio" name="limb" <?php if ($errors['limb']) {print 'class="error"';} ?> value=">4" <?php if ($values['limb'] == '>4') {print 'checked="checked"';} ?> />>4<br/> 
		
				<label <?php if ($errors['abilities']) {print 'class="error"';} ?> for="abilities">Сверхспособности:</label><br>
					<input type="checkbox" name="ability1" value="ability1" <?php if ($values['ability1'] != '') {print 'checked="checked"';} ?> />Непробиваемость<br/>
					<input type="checkbox" name="ability2" value="ability2" <?php if ($values['ability2'] != '') {print 'checked="checked"';} ?> />Супер-скорость<br/>
					<input type="checkbox" name="ability3" value="ability3" <?php if ($values['ability3'] != '') {print 'checked="checked"';} ?> />Левитация<br/>
                    <input type="checkbox" name="ability1" value="ability4" <?php if ($values['ability4'] != '') {print 'checked="checked"';} ?> />Невидимость<br/>
					<input type="checkbox" name="ability2" value="ability5" <?php if ($values['ability5'] != '') {print 'checked="checked"';} ?> />Способность видеть сквозь стены<br/>
					<input type="checkbox" name="ability3" value="ability6" <?php if ($values['ability6'] != '') {print 'checked="checked"';} ?> />Регенерация<br/>
                    <input type="checkbox" name="ability1" value="ability7" <?php if ($values['ability7'] != '') {print 'checked="checked"';} ?> />Бессмертие<br/>
					<input type="checkbox" name="ability2" value="ability8" <?php if ($values['ability8'] != '') {print 'checked="checked"';} ?> />Деньги<br/>                
				<textarea type="text" rows="10" cols="45" name="osebe" placeholder="Сообщение"><?php printf($values['osebe']);?></textarea><br>
				<input type="checkbox" name="kontract" value="kontract" <?php if ($values['kontract'] != '') {print 'checked="checked"';} ?>> C контрактом ознакомлен<br/>
				<input type="submit" name="save" id="ok" value="сохранить" />
				<input type="submit" name="save" id="out" value="выйти"/>
				<input type="submit" name="save" id="out" value="войти"/>
				<input type='hidden' name='SeenBefore' value='1'/>
			</form>
			<form method="POST" action="admin.php">
				<input type='hidden' name='SeenBefore' value='1' />
    			<input type='hidden' name='OldAuth' value="<?php print($_SERVER['PHP_AUTH_USER']); ?>"/>
				<input type='submit' name="save" id="out" value='Авторизоваться повторно как администратор'/>
			</form>
		</div>
	</body>
</html>