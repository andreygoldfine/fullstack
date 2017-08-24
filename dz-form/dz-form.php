<?php

$message = false;
$error = false;
if (isset($_REQUEST['name']) && isset($_REQUEST['last_name']) && isset($_REQUEST['phone']) && isset($_REQUEST['email']) && isset($_REQUEST['gender']) && isset($_REQUEST['bio'])) {

    $name = $_REQUEST['name'];
    $last_name = $_REQUEST['last_name'];
    $phone = $_REQUEST['phone'];
    $email = $_REQUEST['email'];
    $gender = $_REQUEST['gender'];
    $bio = $_REQUEST['bio'];

    
    

    if (empty($name) || empty($last_name) || empty($phone) || empty($email) || empty($gender) || empty($bio)) {
        $error = 'Заполните поля';
    } else {
		if (!preg_match('/^[0-9]{11}$/', $phone) || !is_string($name) || !is_string($last_name) || !preg_match("~([a-zA-Z0-9!#$%&\'*+-/=?^_`{|}\~])@([a-zA-Z0-9-]).([a-zA-Z0-9]{2,4})~",$email)){

			$error = '<div class="error">Некоторые поля заполнены некорректно. <br/>Заполните их заново и повторите отправку формы.</div>';

		    } else {
				$row = 'Имя пользователя: ' . $name . ' ' . $last_name . PHP_EOL . 'Номер телефона: ' . $phone . PHP_EOL . 'E-mail: ' . $email . PHP_EOL . 'Пол: ' . $gender . PHP_EOL . 'О себе: ' . PHP_EOL . $bio .PHP_EOL . PHP_EOL;
				file_put_contents('files/information.txt', $row, FILE_APPEND);
				$message = '<div class="message">Регистрация успешно пройдена!</div>';
		    }


        
    }
}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Форма обратной связи</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
</head>
<body>

<?php if ($message) : ?>
	<?php echo $message ?>
<?php else : ?>

<center><h1>Добро пожаловать на наш сайт! Зарегистрируйтесь, чтобы продолжить:</h1></center>
<form method="post">
	<div class="main">
		<div class="element">
			<h4>Имя</h4>
			<input type="text" name="name" pattern="[а-яА-ЯёЁ]{2,64}" required title="Мы – русскоязычный сайт. У нас принято писать свое имя кириллицей." autofocus><br/>
		</div>

		<div class="element">
			<h4>Фамилия</h4>
			<input type="text" name="last_name" pattern="[а-яА-ЯёЁ]{2,64}" required title="Мы – русскоязычный сайт. У нас принято писать свою фамилию кириллицей."><br/>
		</div><br/>

		<div class="element">
			<h4>Телефон</h4>
			<input type="text" name="phone" pattern="[0-9]{5,12}" required title="Номер телефона пишется с помощью цифр, а не букв. Более того, он состоит из 11 символов."><br/>
		</div>

		<div class="element">
			<h4>E-mail</h4>
			<input type="email" name="email" required><br/>
		</div>
	</div>

	<div class="main">
		<div class="element">
			<h4>О себе (кратко)</h4>
			<textarea name="bio" reduired></textarea><br/>
		</div>

		<div class="element">
			<h4>Пол</h4>
			<input type="radio" class="radio" name="gender" required value="male"><label for="male">Мужской</label><br/>
			<input type="radio" class="radio" name="gender" reduired value="female"><label for="female">Женский</label><br/>
			<button type="submit" action="dz-form.php">Отправить</button>
		</div>	
	</div>
<?php if ($error) : ?>
	<?php echo $error ?>
<?php endif ?>
</form>

<?php endif ?>
</body>
</html>