<?php
function checkConfirmPassword() {
  $password = $_POST['password'];
  $confirmPassword = $_POST['confirmPassword'];
  if($password == $confirmPassword) { 
    $password = password_hash($password, PASSWORD_DEFAULT);
    return $password;
  } else {
    echo "<script>alert('Пароли не совпадают. Повторите попытку.');
    window.location.href='../tamplates/formRegistration.php';
    </script>";
    return false;
  }
}