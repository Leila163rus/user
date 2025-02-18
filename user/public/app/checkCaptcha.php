<?php
define('SMARTCAPTCHA_SERVER_KEY', '');

function check_captcha($token) {
    $ch = curl_init();
    $args = http_build_query([
        "secret" => 'ysc2_TqkOGd3aoX72Dz2sUoUMQeHa5iap0jYCfqhKBUcz0017c2f2',
        "token" => $token,
        "ip" => $_SERVER['REMOTE_ADDR'],
    ]);
    curl_setopt($ch, CURLOPT_URL, "https://smartcaptcha.yandexcloud.net/validate?$args");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_TIMEOUT, 1);

    $server_output = curl_exec($ch);
    $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if ($httpcode !== 200) {
        echo "Allow access due to an error: code=$httpcode; message=$server_output\n";
        return true;
    }
    $resp = json_decode($server_output);
    return $resp->status === "ok";
}

function checkToken() {
  $token = $_POST['smart-token'];
  if (check_captcha($token)) {
    return true;
  } else {
    echo "<script>
        alert('Извините, похоже вы робот.');
        window.location.href='../tamplates/formAuth.php';
        </script>";
  }
}
?>