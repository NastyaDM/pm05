<?php

include_once "vendors/helpers.php";

$response_message = null;

function handle_post()
{
  include "vendors/connect.php";

  $first_name = format_data($_POST['first_name']);
  $last_name = format_data($_POST['last_name']);
  $middle_name = format_data($_POST['middle_name']);
  $email = format_data($_POST['email']);
  $login = format_data($_POST['login']);
  $password = format_data($_POST['password']);
  $repeat_password = format_data($_POST['repeat-password']);
  $terms = $_POST['terms'];

  $exist_user = $db->query("SELECT * FROM `User` WHERE `login` = '$login'")->fetch();

  if ($exist_user) {
    return "Такой пользователь уже существует!";
  }

  if ($password !== $repeat_password) {
    return "Ваши пароли не совпадают!";
  }

  $hashed_password = md5($password);

  $db->query("INSERT INTO `User`(`first_name`, `last_name`, `middle_name`, `email`, `login`, `password`, `role`) VALUES ('$first_name', '$last_name', '$middle_name', '$email', '$login', '$hashed_password', 'USER')");

  return "Новый пользователь успешно зарегистрирован!";
}

if (isset($_POST['first_name']) && isset($_POST['email']) && isset($_POST['login']) && isset($_POST['password']) && isset($_POST['repeat-password']) && isset($_POST['terms'])) {
  $respose = handle_post();

  if ($respose) {
    $response_message = $respose;
  }
}



?>

<!DOCTYPE html>
<html lang="ru">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="style/global.css" />
  <link rel="stylesheet" href="style/pages/register.css" />
  <title>BookHaven: Регистрация</title>
</head>

<body>
  <div class="wrapper">
    <?php include "partials/sidebar.php" ?>
    <div class="page-content">
      <?php include "partials/header.php" ?>
      <div class="page-content__wrapper">
        <section class="section w-auto">
          <header class="section-header">
            <h2 class="section-title">Регистрация</h2>
          </header>
          <div class="section-content">
            <form action="register.php" class="form" method="POST">
              <div class="form-inputs">
                <div class="form-input">
                  <input type="text" required name="first_name" placeholder="Имя *" />
                </div>
                <div class="form-input">
                  <input type="text" name="last_name" placeholder="Фамилия" />
                </div>
                <div class="form-input">
                  <input type="text" name="middle_name" placeholder="Отчество" />
                </div>
                <div class="form-input">
                  <input type="email" required name="email" placeholder="Email *" />
                </div>
                <div class="form-input">
                  <input type="text" required name="login" placeholder="Логин *" />
                </div>
                <div class="form-input">
                  <input type="password" required name="password" placeholder="Придумайте пароль *" />
                </div>
                <div class="form-input">
                  <input type="password" required name="repeat-password" placeholder="Повторите пароль *" />
                </div>
              </div>
              <span class="form-warning">* обязательные поля для заполнения</span>
              <div class="form-checkboxes">
                <div class="form-checkbox">
                  <input type="checkbox" name="terms" id="terms" checked />
                  <label for="terms" class="form-checkbox-label">
                    <div class="form-checkbox-label__icon">
                      <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                          d="M7.87504 14.875L3.20837 10.2083L4.10421 9.31248L7.87504 13.0833L15.875 5.08331L16.7709 5.97915L7.87504 14.875Z"
                          fill="black" />
                      </svg>
                    </div>
                    <span>
                      Я принимаю правила пользовательского соглашения
                    </span>
                  </label>
                </div>
                <div class="form-checkbox">
                  <input type="checkbox" name="notify" id="notify" />
                  <label for="notify" class="form-checkbox-label">
                    <div class="form-checkbox-label__icon">
                      <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                          d="M7.87504 14.875L3.20837 10.2083L4.10421 9.31248L7.87504 13.0833L15.875 5.08331L16.7709 5.97915L7.87504 14.875Z"
                          fill="black" />
                      </svg>
                    </div>
                    <span>
                      Я согласен на рассылку уведомлений по СМС и email
                    </span>
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
                  <span class="input-text">Уже есть аккаунт?</span>
                  <a href="login.php" class="input-text a">Войти</a>
                </div>
                <button type="submit" class="button filled">Зарегистрироваться</button>
              </div>
            </form>
          </div>
        </section>
      </div>
    </div>
  </div>
</body>

</html>