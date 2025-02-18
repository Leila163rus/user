<?php
require(__DIR__ . '/../app/checkUserExist.php');
require(__DIR__ . '/../app/checkConfirmPassword.php');

session_start(); 
$_SESSION['name'] = $_POST['name'];
$_SESSION['phone'] = $_POST['phone'];
$_SESSION['email'] = $_POST['email'];

if($_SERVER['REQUEST_METHOD'] == 'POST' && checkUserExist() && checkConfirmPassword()) {
  $name = $_POST['name'];
  $phone = $_POST['phone'];
  $email = $_POST['email'];
  $password = checkConfirmPassword();

  require(__DIR__ . '/../config/pdo.php');
  $sql = "INSERT INTO users (name, phone, email, password) VALUES (:name, :phone, :email, :password)";
  try {
    $pdo = new PDO($dsn, $user, $pass, $opt);
    $res = $pdo->prepare($sql);
    $res->execute(['name' => $name, 'phone' => $phone, 'email' => $email, 'password' => $password]);
    if(!empty($res)) {
      echo "<script>
        alert('Вы зарегестрированы.');
        window.location.href='../index.php';
        </script>";
    }
  } catch (PDOException $e) {
    echo "Ошибка при выполнении запроса: " . $e->getMessage();
  }
}