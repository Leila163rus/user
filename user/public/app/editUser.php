<?php
  if($_SERVER['REQUEST_METHOD'] == 'POST') {
    require(__DIR__ . '/../config/pdo.php');
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirmPassword'];
    if($password !== $confirm_password) { 
      echo "<script>alert('Пароли не совпадают. Повторите попытку.');
      window.location.href='../index.php';
      </script>";
    } else {
      $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    }
  }

  session_start();
  $currentName = $_SESSION['name'];
  echo $currentName;
  $sql = "UPDATE users SET name=:name, phone=:phone, email=:email, password=:password WHERE name='$currentName'";
  try {
    $pdo = new PDO($dsn, $user, $pass, $opt);
    $res = $pdo->prepare($sql);
    $res->execute(['name' => $name, 'phone' => $phone, 'email' => $email, 'password' => $password]);
    if(!empty($res)) {
      echo "<script>
        alert('Данные изменены.');
        window.location.href='../index.php';
        </script>";
    }
  } catch (PDOException $e) {
    echo "Ошибка при выполнении запроса: " . $e->getMessage();
  }
?>