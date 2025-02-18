<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Пользователи">
  <title>Регистрация</title>
  <link rel="stylesheet" type="text/css" href="../css/index.css">
</head>
<body>
  <?php session_start(); ?>
  <div id="registration">
    <form id="post" action="/app/registration.php" method="POST" enctype="multipart/form-data" autocomplete="on">
      <p>
        <label for="name">Ваше имя</label>
        <input id="name" type="text" name="name" placeholder="Иван" required autocomplete="on"
          value = "<?php if(isset($_SESSION['name'])) echo $_SESSION['name']; ?>"
        >
      </p>
      <p>
        <label for="phone">Тел. номер</label>
        <input id="phone" type="tel" name="phone" placeholder="+79870000000" required autocomplete="on"
          pattern="[\+]\d{11}"
          value = "<?php if(isset($_SESSION['phone'])) echo $_SESSION['phone']; ?>"
        >
      </p>
      <p>
        <label for="email">Эл. почта</label>
        <input id="email" type="email" name="email" placeholder="user@mail.ru" required autocomplete="on"
          value = "<?php if(isset($_SESSION['email'])) echo $_SESSION['email']; ?>"
        >
      </p>
      <p>
        <label for="password">Пароль</label>
        <input id="password" type="password" name="password" placeholder="123456" required autocomplete="new-password">
      </p>
      <p>
        <label for="confirmPassword">Подтверждение пароля</label>
        <input id="confirmPassword" type="password" name="confirmPassword" placeholder="123456" required autocomplete="new-password">
      </p>
      <p>
        <input id="submit" type="submit" value="Регистрация">
      </p>
    </form>
  </div>
</body>
</html>