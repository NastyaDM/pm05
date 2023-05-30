<?php

include "vendors/admin_route.php";
include "vendors/connect.php";
?>

<!DOCTYPE html>
<html lang="ru">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style/global.css" />
  <link rel="stylesheet" href="style/pages/workers.css">
  <script src="js/input-file.js" defer></script>
  <title>BookHaven: Работники</title>
</head>

<body>
  <div class="wrapper">
    <?php include "partials/sidebar.php" ?>
    <div class="page-content">
      <?php include "partials/header.php" ?>
      <div class="page-content__wrapper">
        <section class="section">
          <header class="section-header">
            <h2 class="section-title">Работники</h2>
            <a href="#" class="button filled">
              <span><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M11.25 19V12.75H5V11.25H11.25V5H12.75V11.25H19V12.75H12.75V19H11.25Z" fill="white" />
                </svg>
              </span>
              <span>Добавить</span>
            </a>
          </header>
          <div class="section-content">
            <?php

            $workers = $db->query("SELECT * FROM `User` WHERE `role` NOT LIKE 'ADMIN'")->fetchAll();

            if (count($workers) > 0):
              ?>
              <table class="table">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>ФИО</th>
                    <th>Email</th>
                    <th>Логин</th>
                    <th>Пароль</th>
                    <th>Должность</th>
                    <th>Действия</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($workers as $worker): ?>
                    <tr>
                      <td>
                        <?php echo $worker['id'] ?>
                      </td>
                      <td>
                        <?php echo $worker['last_name'] ?>
                        <?php echo $worker['first_name'] ?>
                        <?php echo $worker['middle_name'] ?>
                      </td>
                      <td>
                        <?php echo $worker['email'] ?>
                      </td>
                      <td>
                        <?php echo $worker['login'] ?>
                      </td>
                      <td>
                        <?php echo $worker['password'] ?>
                      </td>
                      <td>
                        <?php echo $worker['role'] ?>
                      </td>
                      <td>
                        <a href="#" class="button icon"><svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                              d="M4.5 19.5H5.6L16.675 8.42505L15.575 7.32505L4.5 18.4V19.5ZM19.85 7.35005L16.65 4.15005L17.7 3.10005C17.9833 2.81672 18.3333 2.67505 18.75 2.67505C19.1667 2.67505 19.5167 2.81672 19.8 3.10005L20.9 4.20005C21.1833 4.48338 21.325 4.83338 21.325 5.25005C21.325 5.66672 21.1833 6.01672 20.9 6.30005L19.85 7.35005ZM18.8 8.40005L6.2 21H3V17.8L15.6 5.20005L18.8 8.40005ZM16.125 7.87505L15.575 7.32505L16.675 8.42505L16.125 7.87505Z"
                              fill="#C3A023" />
                          </svg>
                        </a>
                        <a href="#" class="button icon">
                          <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                              d="M6.525 21C6.1125 21 5.75937 20.8531 5.46563 20.5594C5.17188 20.2656 5.025 19.9125 5.025 19.5V5.25H4V3.75H8.7V3H15.3V3.75H20V5.25H18.975V19.5C18.975 19.9 18.825 20.25 18.525 20.55C18.225 20.85 17.875 21 17.475 21H6.525ZM17.475 5.25H6.525V19.5H17.475V5.25ZM9.175 17.35H10.675V7.375H9.175V17.35ZM13.325 17.35H14.825V7.375H13.325V17.35Z"
                              fill="#B3261E" />
                          </svg>

                        </a>
                      </td>
                    </tr>
                  <?php endforeach ?>
                </tbody>
              </table>
            <?php else: ?>
              <p>Нет данных</p>
            <?php endif ?>
          </div>
        </section>
      </div>
    </div>
  </div>
</body>

</html>