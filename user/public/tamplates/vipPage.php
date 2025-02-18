<?php
session_start();
if(!isset($_SESSION['auth'])){
  header("Location: ../index.php");
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Пользователи">
  <title>VIP страница</title>
  <link rel="stylesheet" type="text/css" href="/css/index.css">
  <script src="https://smartcaptcha.yandexcloud.net/captcha.js" defer></script>
</head>
<body>
  <div id="edit">
    <form id="editPost" action="/app/editUser.php" method="POST" enctype="multipart/form-data" autocomplete="on">
      <p>
        <label for="editName">Ваше имя</label>
        <input id="editName" type="text" name="name" placeholder="Иван" required autocomplete="on"
          value = "<?php if(isset($_SESSION['authName'])) echo $_SESSION['authName']; ?>"
        >
      </p>
      <p>
        <label for="editPhone">Тел. номер</label>
        <input id="editPhone" type="tel" name="phone" placeholder="+79870000000" required autocomplete="on"
          pattern="[\+]\d{11}"
          value = "<?php if(isset($_SESSION['authPhone'])) echo $_SESSION['authPhone']; ?>"
        >
      </p>
      <p>
        <label for="editEmail">Эл. почта</label>
        <input id="editEmail" type="email" name="email" placeholder="user@mail.ru" required autocomplete="on"
          value = "<?php if(isset($_SESSION['authEmail'])) echo $_SESSION['authEmail']; ?>"
        >
      </p>
      <p>
        <label for="editPassword">Пароль</label>
        <input id="editPassword" type="password" name="password" placeholder="123456" required autocomplete="new-password">
      </p>
      <p>
        <label for="editConfirmPassword">Подтверждение пароля</label>
        <input id="editConfirmPassword" type="password" name="confirmPassword" placeholder="123456" required autocomplete="new-password">
      </p>
      <p>
        <input id="submit" type="submit" value="Изменить данные">
      </p>
    </form>
  </div>
</body>
</html>