<?php
function checkUser() {
  require(__DIR__ . '/../config/pdo.php');
  $sql = "SELECT name, phone, email FROM users WHERE name=:name OR phone=:phone OR email=:email";
  try {
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $pdo = new PDO($dsn, $user, $pass, $opt);
    $res = $pdo->prepare($sql);
    $res->execute(['name' => $name, 'phone' => $phone, 'email' => $email]);
    $row = $res->fetchAll(PDO::FETCH_ASSOC);

    if(!empty($row)) {
      $uncorrectFields = array();
      foreach($row as $fields) {
        array_push($uncorrectFields, array_intersect($_POST, $fields));
      } 
      $uncorrectFields = array_merge(...$uncorrectFields);
    
      $sqlName = $uncorrectFields['name']?? '';
      $sqlPhone = $uncorrectFields['phone']?? '';
      $sqlEmail = $uncorrectFields['email']?? '';
      
      if($name == $sqlName && $phone == $sqlPhone && $email == $sqlEmail) {
        echo "<script>
          alert('Такой пользователь уже существует. Введите другое имя, телефонный номер и адрес электронной почты.');
          window.location.href='../index.php';
          </script>";
          //return false;
      } elseif($name == $sqlName && $phone == $sqlPhone) {
        echo "<script>
          alert('Такой пользователь уже существует. Введите другое имя и телефонный номер.');
          window.location.href='../index.php';
          </script>";
         // return false;
      } elseif($name == $sqlName && $email == $sqlEmail) {
        echo "<script>
          alert('Такой пользователь уже существует. Введите другое имя и адрес электронной почты.');
          window.location.href='../index.php';
          </script>";
          //return false;
      } elseif($phone == $sqlPhone && $email == $sqlEmail) {
        echo "<script>
          alert('Такой пользователь уже существует. Введите другой телефонный номер и адрес электронной почты.');
          window.location.href='../index.php';
          </script>";
          //return false;
      } elseif($name == $sqlName && $email == $sqlEmail) {
        echo "<script>
          alert('Такой пользователь уже существует. Введите другое имя и адрес электронной почты.');
          window.location.href='../index.php';
          </script>";
          //return false;
      } elseif($name == $sqlName) {
        echo "<script>
          alert('Такой пользователь уже существует. Введите другое имя.');
          window.location.href='../index.php';
          </script>";
          //return false;
      } elseif($phone == $sqlPhone) {
        echo "<script>
          alert('Такой пользователь уже существует. Введите другой телефонный номер.');
          window.location.href='../index.php';
          </script>";
          //return false;
      } elseif($email == $sqlEmail) {
        echo "<script>
          alert('Такой пользователь уже существует. Введите другой адрес электронной почты.');
          window.location.href='../index.php';
          </script>";
          //return false;
      } else {
        echo 'true'; 
        return true;
      }
    }
  } catch (PDOException $e) {
    echo "Ошибка при выполнении запроса: " . $e->getMessage();
  } 
}
?>