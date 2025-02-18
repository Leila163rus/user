<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Пользователи">
  <title>Авторизация</title>
  <link rel="stylesheet" type="text/css" href="../css/index.css">
  <script src="https://smartcaptcha.yandexcloud.net/captcha.js" defer></script>
</head>
<body>
  <?php session_start(); ?>
  <div id="auth">
    <form id="authPost" action="/app/auth.php" method="POST" enctype="multipart/form-data" autocomplete="on">
      <p>
        <label for="authText">Тел. номер или эл. почта</label>
        <input id="authText" type="text" name="text" placeholder="" required autocomplete="on"
          value = "<?php 
            if(isset($_SESSION['authEmail'])) {
              echo $_SESSION['authPhone'];
            } elseif(isset($_SESSION['authPhone'])) {
              echo $_SESSION['authEmail'];
            }
            ?>"
        >
      </p>
        <label for="authPassword">Пароль</label>
        <input id="authPassword" type="password" name="password" placeholder="123456" required autocomplete="new-password">
      </p>
      <div style="height: 100px" id="captcha-container" class="smart-captcha" data-sitekey="ysc1_TqkOGd3aoX72Dz2sUoUMD9ZeYidIk9MNJE5BLJQccd445162"></div>
        <p>
        <input id="submit" type="submit" value="Вход">
        </p>
    </form>
  </div>
</body>
</html>