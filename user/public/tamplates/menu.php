<div id="menu">
  <nav class="nav" id="kursor">
    <ul>
      <li><a href="../tamplates/vipPage.php">VIP</a></li>
      <li><a href="../tamplates/formRegistration.php">Регистрация</a></li>
      <?php 
      session_start();
      if(!isset($_SESSION['auth'])) {
        echo '<li><a href="../tamplates/formAuth.php">Вход</a></li>';
      } else {
        echo '<li><a href="../tamplates/trueAuth.php">Вход</a></li>';
      }
      ?>
    </ul>
  </nav>
</div>