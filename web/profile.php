<?php

include "vendors/auth_route.php";

$auth_token = json_decode($_COOKIE['auth_token'], true);
$response_message = null;


function handle_put($user)
{
  include "vendors/connect.php";
  include_once "vendors/helpers.php";

  $id = $user['id'];

  $first_name = format_data($_POST['first_name']);
  $last_name = format_data($_POST['last_name']);
  $middle_name = format_data($_POST['middle_name']);
  $favorite_genrs = format_data($_POST['favorite_genrs']);
  $unfavorite_genrs = format_data($_POST['unfavorite_genrs']);
  $email = format_data($_POST['email']);
  $login = format_data($_POST['login']);
  $password = format_data($_POST['password']);
  $hashed_password = md5($password);
  $new_password = format_data($_POST['new-password']);
  $repeat_new_password = format_data($_POST['repeat-new-password']);

  if ($hashed_password !== $user["password"]) {
    return "Введен неверный пароль!";
  }

  $query = "UPDATE `User` SET `first_name` = '$first_name', `last_name` = '$last_name', `middle_name` = '$middle_name', `favorite_genrs` = '$favorite_genrs', `unfavorite_genrs` = '$unfavorite_genrs', `email` = '$email', `login` = '$login'";

  $new_user = [...$user, "first_name" => $first_name, "last_name" => $last_name, "middle_name" => $middle_name, "favorite_genrs" => $favorite_genrs, "unfavorite_genrs" => $unfavorite_genrs, "email" => $email, "login" => $login];

  if ($new_password) {
    if ($new_password !== $repeat_new_password) {
      return "Пароли не совпадают!";
    }

    $hashed_new_password = md5($new_password);

    $query .= ", `password` = '$hashed_new_password'";

    $new_user = [...$new_user, "password" => $hashed_new_password];
  }

  $db->query($query . " WHERE `id` = '$id'");

  setcookie("auth_token", json_encode($new_user), time() + 3600 * 24 * 30 * 3);

  return "Данные успешно изменены!";
}

if (isset($_POST['first_name']) && isset($_POST['email']) && isset($_POST['login']) && isset($_POST['password'])) {
  $respose = handle_put($auth_token);

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
  <link rel="stylesheet" href="style/pages/profile.css" />
  <title>BookHaven: Профиль</title>
</head>

<body>
  <div class="wrapper">
    <?php include "partials/sidebar.php" ?>
    <div class="page-content">
      <?php include "partials/header.php" ?>
      <div class="page-content__wrapper">
        <section class="section w-auto">
          <header class="section-header">
            <h2 class="section-title">Информация о пользователе</h2>
          </header>
          <div class="section-content">
            <div class="section-content">
              <form action="profile.php" method="POST" class="form">
                <div class="form-inputs__group">
                  <div class="form-inputs">
                    <div class="form-input">
                      <input type="text" name="first_name" value="<?php echo $auth_token['first_name'] ?>" required
                        placeholder="Имя" />
                    </div>
                    <div class="form-input">
                      <input type="text" name="last_name" value="<?php echo $auth_token['last_name'] ?>"
                        placeholder="Фамилия" />
                    </div>
                    <div class="form-input">
                      <input type="text" name="middle_name" value="<?php echo $auth_token['middle_name'] ?>"
                        placeholder="Отчество" />
                    </div>
                    <div class="form-input">
                      <input type="text" name="favorite_genrs" value="<?php echo $auth_token['favorite_genrs'] ?>"
                        placeholder="Любимые жанры" />
                    </div>
                    <div class="form-input">
                      <input type="text" name="unfavorite_genrs" value="<?php echo $auth_token['unfavorite_genrs'] ?>"
                        placeholder="Не любимые жанры" />
                    </div>
                  </div>
                  <div class="form-inputs">
                    <div class="form-input">
                      <input type="email" name="email" value="<?php echo $auth_token['email'] ?>" required
                        placeholder="Email " />
                    </div>
                    <div class="form-input">
                      <input type="text" name="login" value="<?php echo $auth_token['login'] ?>" required
                        placeholder="Логин " />
                    </div>
                    <div class="form-input">
                      <input type="password" name="password" placeholder="Напишите старый пароль" />
                    </div>
                    <div class="form-input">
                      <input type="password" name="new-password" placeholder="Придумайте новый пароль" />
                    </div>
                    <div class="form-input">
                      <input type="password" name="repeat-new-password" placeholder="Повторите пароль " />
                    </div>
                  </div>
                </div>
                <?php if ($response_message): ?>
                  <p class="form-response">
                    <?php echo $response_message ?>
                  </p>
                <?php endif ?>
                <div class="form-actions profile">
                  <button class="button" type="button">Отмена</button>
                  <button class="button filled" type="submit">Сохранить</button>
                </div>
            </div>
            </form>
          </div>

        </section>
        <section class="section">
          <header class="section-header">
            <h2 class="section-title">История заказов</h2>
          </header>
          <div class="section-content">
            <div class="product-mini-list">
              <div class="product-mini">
                <div class="product-mini-photo">
                  <img src="assets/product_mini.png" alt="" />
                </div>
                <div class="product-mini-info">
                  <p class="product-mini-name">Кровавое приданое</p>
                  <p class="product-mini-author">С. Т. Гибсон</p>
                  <div class="product-mini__price">
                    <p class="product-mini-price-text">Цена</p>
                    <p class="product-mini-price">690 ₽</p>
                  </div>
                  <div class="product-mini-action">
                    <div class="product-mini__date">
                      <p class="product-mini-date-text">Завершено:</p>
                      <p class="product-mini-date">12.04.2023</p>
                    </div>
                    <button class="button filled">Повторить</button>
                  </div>
                </div>
              </div>
              <div class="product-mini">
                <div class="product-mini-photo">
                  <img src="assets/product_mini.png" alt="" />
                </div>
                <div class="product-mini-info">
                  <p class="product-mini-name">Кровавое приданое</p>
                  <p class="product-mini-author">С. Т. Гибсон</p>
                  <div class="product-mini__price">
                    <p class="product-mini-price-text">Цена</p>
                    <p class="product-mini-price">690 ₽</p>
                  </div>
                  <div class="product-mini-action">
                    <div class="product-mini__date">
                      <p class="product-mini-date-text">Завершено:</p>
                      <p class="product-mini-date">12.04.2023</p>
                    </div>
                    <button class="button filled">Повторить</button>
                  </div>
                </div>
              </div>
              <div class="product-mini">
                <div class="product-mini-photo">
                  <img src="assets/product_mini.png" alt="" />
                </div>
                <div class="product-mini-info">
                  <p class="product-mini-name">Кровавое приданое</p>
                  <p class="product-mini-author">С. Т. Гибсон</p>
                  <div class="product-mini__price">
                    <p class="product-mini-price-text">Цена</p>
                    <p class="product-mini-price">690 ₽</p>
                  </div>
                  <div class="product-mini-action">
                    <div class="product-mini__date">
                      <p class="product-mini-date-text">Завершено:</p>
                      <p class="product-mini-date">12.04.2023</p>
                    </div>
                    <button class="button filled">Повторить</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
        <section class="section">
          <header class="section-header">
            <h2 class="section-title">Избранное</h2>
          </header>
          <div class="section-content">
            <div class="product-list">
              <div class="product">
                <a href="product.php" class="product-photo">
                  <img src="assets/product.png" alt="" />
                </a>
                <div class="product-info">
                  <p class="product-info-price">690 ₽</p>
                  <div class="product-info-text">
                    <p class="product-info-name">Кровавое приданое</p>
                    <p class="product-info-author">С. Т. Гибсон</p>
                  </div>
                  <div class="product-actions">
                    <a href="product.php" class="button filled">Купить</a>
                    <button class="button icon">
                      <svg width="24" height="25" viewBox="0 0 24 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                          d="M12 21.475L10.975 20.55C9.2122 18.9313 7.75483 17.535 6.6029 16.361C5.45097 15.187 4.53333 14.1375 3.85 13.2125C3.16667 12.2875 2.6875 11.45 2.4125 10.7C2.1375 9.95002 2 9.19169 2 8.42502C2 6.92244 2.50417 5.66763 3.5125 4.6606C4.52083 3.65355 5.76667 3.15002 7.25 3.15002C8.2 3.15002 9.07917 3.37502 9.8875 3.82502C10.6958 4.27502 11.4 4.92502 12 5.77502C12.7 4.87502 13.4417 4.21252 14.225 3.78752C15.0083 3.36252 15.85 3.15002 16.75 3.15002C18.2333 3.15002 19.4792 3.65355 20.4875 4.6606C21.4958 5.66763 22 6.92244 22 8.42502C22 9.19169 21.8625 9.95002 21.5875 10.7C21.3125 11.45 20.8333 12.2875 20.15 13.2125C19.4667 14.1375 18.549 15.187 17.3971 16.361C16.2452 17.535 14.7878 18.9313 13.025 20.55L12 21.475ZM12 19.5C13.6873 17.9501 15.0757 16.621 16.1655 15.5126C17.2551 14.4042 18.1208 13.4334 18.7625 12.6C19.4042 11.7667 19.8542 11.0239 20.1125 10.3716C20.3708 9.71938 20.5 9.07172 20.5 8.42865C20.5 7.32623 20.15 6.42086 19.45 5.71252C18.75 5.00419 17.8519 4.65002 16.7556 4.65002C15.8969 4.65002 15.1021 4.91252 14.3712 5.43752C13.6404 5.96252 13.05 6.70002 12.6 7.65002H11.375C10.9417 6.71669 10.3596 5.98336 9.62875 5.45002C8.8979 4.91669 8.10311 4.65002 7.24437 4.65002C6.14813 4.65002 5.25 5.00419 4.55 5.71252C3.85 6.42086 3.5 7.32766 3.5 8.43292C3.5 9.07766 3.62917 9.72919 3.8875 10.3875C4.14583 11.0459 4.59583 11.7959 5.2375 12.6375C5.87917 13.4792 6.75 14.45 7.85 15.55C8.95 16.65 10.3333 17.9667 12 19.5Z"
                          fill="#6750A4" />
                        <ellipse cx="7.5" cy="8.5" rx="5" ry="4.5" fill="#6750A4" />
                        <ellipse cx="12" cy="12.5" rx="5" ry="4.5" fill="#6750A4" />
                        <ellipse cx="16.5" cy="8.5" rx="5" ry="4.5" fill="#6750A4" />
                        <path d="M12 21L3.77276 11.625L20.2272 11.625L12 21Z" fill="#6750A4" />
                      </svg>
                    </button>
                  </div>
                </div>
              </div>
              <div class="product">
                <a href="product.php" class="product-photo">
                  <img src="assets/product.png" alt="" />
                </a>
                <div class="product-info">
                  <p class="product-info-price">690 ₽</p>
                  <div class="product-info-text">
                    <p class="product-info-name">Кровавое приданое</p>
                    <p class="product-info-author">С. Т. Гибсон</p>
                  </div>
                  <div class="product-actions">
                    <a href="product.php" class="button filled">Купить</a>
                    <button class="button icon">
                      <svg width="24" height="25" viewBox="0 0 24 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                          d="M12 21.475L10.975 20.55C9.2122 18.9313 7.75483 17.535 6.6029 16.361C5.45097 15.187 4.53333 14.1375 3.85 13.2125C3.16667 12.2875 2.6875 11.45 2.4125 10.7C2.1375 9.95002 2 9.19169 2 8.42502C2 6.92244 2.50417 5.66763 3.5125 4.6606C4.52083 3.65355 5.76667 3.15002 7.25 3.15002C8.2 3.15002 9.07917 3.37502 9.8875 3.82502C10.6958 4.27502 11.4 4.92502 12 5.77502C12.7 4.87502 13.4417 4.21252 14.225 3.78752C15.0083 3.36252 15.85 3.15002 16.75 3.15002C18.2333 3.15002 19.4792 3.65355 20.4875 4.6606C21.4958 5.66763 22 6.92244 22 8.42502C22 9.19169 21.8625 9.95002 21.5875 10.7C21.3125 11.45 20.8333 12.2875 20.15 13.2125C19.4667 14.1375 18.549 15.187 17.3971 16.361C16.2452 17.535 14.7878 18.9313 13.025 20.55L12 21.475ZM12 19.5C13.6873 17.9501 15.0757 16.621 16.1655 15.5126C17.2551 14.4042 18.1208 13.4334 18.7625 12.6C19.4042 11.7667 19.8542 11.0239 20.1125 10.3716C20.3708 9.71938 20.5 9.07172 20.5 8.42865C20.5 7.32623 20.15 6.42086 19.45 5.71252C18.75 5.00419 17.8519 4.65002 16.7556 4.65002C15.8969 4.65002 15.1021 4.91252 14.3712 5.43752C13.6404 5.96252 13.05 6.70002 12.6 7.65002H11.375C10.9417 6.71669 10.3596 5.98336 9.62875 5.45002C8.8979 4.91669 8.10311 4.65002 7.24437 4.65002C6.14813 4.65002 5.25 5.00419 4.55 5.71252C3.85 6.42086 3.5 7.32766 3.5 8.43292C3.5 9.07766 3.62917 9.72919 3.8875 10.3875C4.14583 11.0459 4.59583 11.7959 5.2375 12.6375C5.87917 13.4792 6.75 14.45 7.85 15.55C8.95 16.65 10.3333 17.9667 12 19.5Z"
                          fill="#6750A4" />
                        <ellipse cx="7.5" cy="8.5" rx="5" ry="4.5" fill="#6750A4" />
                        <ellipse cx="12" cy="12.5" rx="5" ry="4.5" fill="#6750A4" />
                        <ellipse cx="16.5" cy="8.5" rx="5" ry="4.5" fill="#6750A4" />
                        <path d="M12 21L3.77276 11.625L20.2272 11.625L12 21Z" fill="#6750A4" />
                      </svg>
                    </button>
                  </div>
                </div>
              </div>
              <div class="product">
                <a href="product.php" class="product-photo">
                  <img src="assets/product.png" alt="" />
                </a>
                <div class="product-info">
                  <p class="product-info-price">690 ₽</p>
                  <div class="product-info-text">
                    <p class="product-info-name">Кровавое приданое</p>
                    <p class="product-info-author">С. Т. Гибсон</p>
                  </div>
                  <div class="product-actions">
                    <a href="product.php" class="button filled">Купить</a>
                    <button class="button icon">
                      <svg width="24" height="25" viewBox="0 0 24 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                          d="M12 21.475L10.975 20.55C9.2122 18.9313 7.75483 17.535 6.6029 16.361C5.45097 15.187 4.53333 14.1375 3.85 13.2125C3.16667 12.2875 2.6875 11.45 2.4125 10.7C2.1375 9.95002 2 9.19169 2 8.42502C2 6.92244 2.50417 5.66763 3.5125 4.6606C4.52083 3.65355 5.76667 3.15002 7.25 3.15002C8.2 3.15002 9.07917 3.37502 9.8875 3.82502C10.6958 4.27502 11.4 4.92502 12 5.77502C12.7 4.87502 13.4417 4.21252 14.225 3.78752C15.0083 3.36252 15.85 3.15002 16.75 3.15002C18.2333 3.15002 19.4792 3.65355 20.4875 4.6606C21.4958 5.66763 22 6.92244 22 8.42502C22 9.19169 21.8625 9.95002 21.5875 10.7C21.3125 11.45 20.8333 12.2875 20.15 13.2125C19.4667 14.1375 18.549 15.187 17.3971 16.361C16.2452 17.535 14.7878 18.9313 13.025 20.55L12 21.475ZM12 19.5C13.6873 17.9501 15.0757 16.621 16.1655 15.5126C17.2551 14.4042 18.1208 13.4334 18.7625 12.6C19.4042 11.7667 19.8542 11.0239 20.1125 10.3716C20.3708 9.71938 20.5 9.07172 20.5 8.42865C20.5 7.32623 20.15 6.42086 19.45 5.71252C18.75 5.00419 17.8519 4.65002 16.7556 4.65002C15.8969 4.65002 15.1021 4.91252 14.3712 5.43752C13.6404 5.96252 13.05 6.70002 12.6 7.65002H11.375C10.9417 6.71669 10.3596 5.98336 9.62875 5.45002C8.8979 4.91669 8.10311 4.65002 7.24437 4.65002C6.14813 4.65002 5.25 5.00419 4.55 5.71252C3.85 6.42086 3.5 7.32766 3.5 8.43292C3.5 9.07766 3.62917 9.72919 3.8875 10.3875C4.14583 11.0459 4.59583 11.7959 5.2375 12.6375C5.87917 13.4792 6.75 14.45 7.85 15.55C8.95 16.65 10.3333 17.9667 12 19.5Z"
                          fill="#6750A4" />
                        <ellipse cx="7.5" cy="8.5" rx="5" ry="4.5" fill="#6750A4" />
                        <ellipse cx="12" cy="12.5" rx="5" ry="4.5" fill="#6750A4" />
                        <ellipse cx="16.5" cy="8.5" rx="5" ry="4.5" fill="#6750A4" />
                        <path d="M12 21L3.77276 11.625L20.2272 11.625L12 21Z" fill="#6750A4" />
                      </svg>
                    </button>
                  </div>
                </div>
              </div>
              <div class="product">
                <a href="product.php" class="product-photo">
                  <img src="assets/product.png" alt="" />
                </a>
                <div class="product-info">
                  <p class="product-info-price">690 ₽</p>
                  <div class="product-info-text">
                    <p class="product-info-name">Кровавое приданое</p>
                    <p class="product-info-author">С. Т. Гибсон</p>
                  </div>
                  <div class="product-actions">
                    <a href="product.php" class="button filled">Купить</a>
                    <button class="button icon">
                      <svg width="24" height="25" viewBox="0 0 24 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                          d="M12 21.475L10.975 20.55C9.2122 18.9313 7.75483 17.535 6.6029 16.361C5.45097 15.187 4.53333 14.1375 3.85 13.2125C3.16667 12.2875 2.6875 11.45 2.4125 10.7C2.1375 9.95002 2 9.19169 2 8.42502C2 6.92244 2.50417 5.66763 3.5125 4.6606C4.52083 3.65355 5.76667 3.15002 7.25 3.15002C8.2 3.15002 9.07917 3.37502 9.8875 3.82502C10.6958 4.27502 11.4 4.92502 12 5.77502C12.7 4.87502 13.4417 4.21252 14.225 3.78752C15.0083 3.36252 15.85 3.15002 16.75 3.15002C18.2333 3.15002 19.4792 3.65355 20.4875 4.6606C21.4958 5.66763 22 6.92244 22 8.42502C22 9.19169 21.8625 9.95002 21.5875 10.7C21.3125 11.45 20.8333 12.2875 20.15 13.2125C19.4667 14.1375 18.549 15.187 17.3971 16.361C16.2452 17.535 14.7878 18.9313 13.025 20.55L12 21.475ZM12 19.5C13.6873 17.9501 15.0757 16.621 16.1655 15.5126C17.2551 14.4042 18.1208 13.4334 18.7625 12.6C19.4042 11.7667 19.8542 11.0239 20.1125 10.3716C20.3708 9.71938 20.5 9.07172 20.5 8.42865C20.5 7.32623 20.15 6.42086 19.45 5.71252C18.75 5.00419 17.8519 4.65002 16.7556 4.65002C15.8969 4.65002 15.1021 4.91252 14.3712 5.43752C13.6404 5.96252 13.05 6.70002 12.6 7.65002H11.375C10.9417 6.71669 10.3596 5.98336 9.62875 5.45002C8.8979 4.91669 8.10311 4.65002 7.24437 4.65002C6.14813 4.65002 5.25 5.00419 4.55 5.71252C3.85 6.42086 3.5 7.32766 3.5 8.43292C3.5 9.07766 3.62917 9.72919 3.8875 10.3875C4.14583 11.0459 4.59583 11.7959 5.2375 12.6375C5.87917 13.4792 6.75 14.45 7.85 15.55C8.95 16.65 10.3333 17.9667 12 19.5Z"
                          fill="#6750A4" />
                        <ellipse cx="7.5" cy="8.5" rx="5" ry="4.5" fill="#6750A4" />
                        <ellipse cx="12" cy="12.5" rx="5" ry="4.5" fill="#6750A4" />
                        <ellipse cx="16.5" cy="8.5" rx="5" ry="4.5" fill="#6750A4" />
                        <path d="M12 21L3.77276 11.625L20.2272 11.625L12 21Z" fill="#6750A4" />
                      </svg>
                    </button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>
    </div>
  </div>
</body>

</html>