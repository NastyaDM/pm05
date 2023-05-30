<?php
$response_message = null;

function handle_get()
{
  include "vendors/connect.php";
  include_once "vendors/helpers.php";

  $login = format_data($_GET['login']);
  $password = format_data($_GET['password']);

  $user = $db->query("SELECT * FROM `User` WHERE `login` = '$login'")->fetch();

  if (!$user) {
    return "Такого пользователя не существует!";
  }

  $hashed_password = md5($password);

  $user_password = $user['password'];

  if ($user_password !== $hashed_password) {
    return "Неверно введен логи или пароль!";
  }

  setcookie("auth_token", json_encode($user), time() + 3600 * 24 * 30 * 3);

  header('Location: /');

  return "Авторизация прошла успешно!";

}

if (isset($_GET['login']) && isset($_GET['password'])) {
  $respose = handle_get();

  $response_message = $respose;
}


?>

<!DOCTYPE html>
<html lang="ru">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="style/global.css" />
  <link rel="stylesheet" href="style/pages/login.css" />
  <title>BookHaven: Авторизация</title>
</head>

<body>
  <div class="wrapper">
    <?php include "partials/sidebar.php" ?>
    <div class="page-content">
      <?php include "partials/header.php" ?>
      <div class="page-content__wrapper">
        <section class="section w-auto">
          <header class="section-header">
            <h2 class="section-title">Авторизация</h2>
          </header>
          <div class="section-content">
            <form action="login.php" class="form">
              <div class="form-inputs">
                <div class="form-input">
                  <input type="text" name="login" required placeholder="Логин *" />
                </div>
                <div class="form-input">
                  <input type="password" name="password" required placeholder="Пароль *" />
                </div>
              </div>
              <span class="form-warning">* обязательные поля для заполнения</span>
              <div class="form-checkboxes">
                <div class="form-checkbox">
                  <input type="checkbox" id="terms" />
                  <label for="terms" class="form-checkbox-label">
                    <div class="form-checkbox-label__icon">
                      <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                          d="M7.87504 14.875L3.20837 10.2083L4.10421 9.31248L7.87504 13.0833L15.875 5.08331L16.7709 5.97915L7.87504 14.875Z"
                          fill="black" />
                      </svg>
                    </div>
                    <span> Запомнить меня </span>
                  </label>
                </div>
              </div>
              <?php if ($response_message): ?>
                <p class="form-response">
                  <?php echo $response_message ?>
                </p>
              <?php endif ?>
              <div class="form-actions">
                <div class="input-texts">
                  <span class="input-text">Нет аккаунта?</span>
                  <a href="register.php" class="input-text a">Зарегистрироваться</a>
                </div>
                <button type="submit" class="button filled">Войти</button>
              </div>
            </form>
          </div>
        </section>
      </div>
    </div>
  </div>
</body>

</html>