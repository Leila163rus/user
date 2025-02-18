<?php
require(__DIR__ . '/../app/checkCaptcha.php');

if($_SERVER['REQUEST_METHOD'] == 'POST' && checkToken()) {
  $email = '';
  $phone = '';
  $password = $_POST['password'];
  if (filter_var($_POST['text'], FILTER_VALIDATE_EMAIL)) {
    $email = $_POST['text'];
  } elseif (preg_match('/[\+]\d{11}/', $phone) or preg_match('/d{12}/', $phone)) {
    $phone = $_POST['text'];
  } else {
    echo "<script>
      alert('Введите верный номер телефона или адрес электронной почты.');
      window.location.href='../tamplates/formAuth.php';
      </script>";
  }

  require(__DIR__ . '/../config/pdo.php');
  $sql = "SELECT password, name, phone, email FROM users WHERE phone=:phone OR email=:email";
  try {
    $pdo = new PDO($dsn, $user, $pass, $opt);
    $res = $pdo->prepare($sql);
    $res->execute(['phone' => $phone, 'email' => $email]);
    $row = $res->fetch(PDO::FETCH_ASSOC);
    if (password_verify($password, $row['password'])) {
      session_start(); 
      $_SESSION['auth'] = true;
      $_SESSION['authName'] = $row['name'];
      $_SESSION['authPhone'] = $row['phone']; 
      $_SESSION['authEmail'] = $row['email'];
      echo "<script>
        alert('Добро пожаловать.');
        window.location.href='../tamplates/vipPage.php';
        </script>";
    } else {
      echo "<script>
        alert('Пароль неверный.');
        window.location.href='../tamplates/formAuth.php';
        </script>";
    }
  } catch (PDOException $e) {
    echo "Ошибка при выполнении запроса: " . $e->getMessage();
  }
}
?>