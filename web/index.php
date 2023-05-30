<?php include "vendors/connect.php" ?>

<!DOCTYPE html>
<html lang="ru">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="style/global.css" />
  <link rel="stylesheet" href="style/pages/home.css" />
  <title>BookHaven</title>
</head>

<body>
  <div class="wrapper">
    <?php include "partials/sidebar.php" ?>
    <div class="page-content">
      <?php include "partials/header.php" ?>
      <div class="page-content__wrapper">
        <div class="intro">
          <div class="intro-info">
            <h1 class="title">BookHaven рады приветствовать вас!</h1>
            <p class="intro-info-text">
              Добро пожаловать в нашу уютную библиотеку! Здесь вы найдете
              самую разнообразную коллекцию книг для всех возрастов и вкусов.
              От классики до современной фантастики, от детских сказок до
              научных трудов - у нас есть все, что может заинтересовать и
              вдохновить вас. Не сомневайтесь, что вы найдете здесь идеальную
              книгу для своего духовного развития и увлечения. Добро
              пожаловать в мир знания и фантазии!
            </p>
          </div>
          <div class="intro-img">
            <img src="assets/intro.png" alt="Интро" />
          </div>
        </div>
        <section class="section">
          <header class="section-header">
            <h2 class="section-title">Новинки этого года</h2>
            <a href="catalog.php" class="button">Посмотреть все</a>
          </header>
          <div class="section-content">
            <div class="product-list">
              <?php

              $books = $db->query("SELECT * FROM `Product`")->fetchAll();
              $books = array_reverse($books);

              if (count($books) > 0):
                ?>
                <?php foreach ($books as $book): ?>
                  <div class="product">
                    <a href="product.php?id=<?php echo $book['id'] ?>" class="product-photo">
                      <img src="assets/<?php echo $book['img'] ?>" alt="" />
                    </a>
                    <div class="product-info">
                      <p class="product-info-price">
                        <?php echo $book['price'] ?> ₽
                      </p>
                      <div class="product-info-text">
                        <p class="product-info-name">
                          <?php echo $book['title'] ?>
                        </p>
                        <p class="product-info-author">
                          <?php echo $book['author'] ?>
                        </p>
                      </div>
                      <div class="product-actions">
                        <a href="product.php?id=<?php echo $book['id'] ?>" class="button filled">Купить</a>
                        <button class="button icon">
                          <svg width="24" height="25" viewBox="0 0 24 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                              d="M12 21.475L10.975 20.55C9.2122 18.9313 7.75483 17.535 6.6029 16.361C5.45097 15.187 4.53333 14.1375 3.85 13.2125C3.16667 12.2875 2.6875 11.45 2.4125 10.7C2.1375 9.95002 2 9.19169 2 8.42502C2 6.92244 2.50417 5.66763 3.5125 4.6606C4.52083 3.65355 5.76667 3.15002 7.25 3.15002C8.2 3.15002 9.07917 3.37502 9.8875 3.82502C10.6958 4.27502 11.4 4.92502 12 5.77502C12.7 4.87502 13.4417 4.21252 14.225 3.78752C15.0083 3.36252 15.85 3.15002 16.75 3.15002C18.2333 3.15002 19.4792 3.65355 20.4875 4.6606C21.4958 5.66763 22 6.92244 22 8.42502C22 9.19169 21.8625 9.95002 21.5875 10.7C21.3125 11.45 20.8333 12.2875 20.15 13.2125C19.4667 14.1375 18.549 15.187 17.3971 16.361C16.2452 17.535 14.7878 18.9313 13.025 20.55L12 21.475ZM12 19.5C13.6873 17.9501 15.0757 16.621 16.1655 15.5126C17.2551 14.4042 18.1208 13.4334 18.7625 12.6C19.4042 11.7667 19.8542 11.0239 20.1125 10.3716C20.3708 9.71938 20.5 9.07172 20.5 8.42865C20.5 7.32623 20.15 6.42086 19.45 5.71252C18.75 5.00419 17.8519 4.65002 16.7556 4.65002C15.8969 4.65002 15.1021 4.91252 14.3712 5.43752C13.6404 5.96252 13.05 6.70002 12.6 7.65002H11.375C10.9417 6.71669 10.3596 5.98336 9.62875 5.45002C8.8979 4.91669 8.10311 4.65002 7.24437 4.65002C6.14813 4.65002 5.25 5.00419 4.55 5.71252C3.85 6.42086 3.5 7.32766 3.5 8.43292C3.5 9.07766 3.62917 9.72919 3.8875 10.3875C4.14583 11.0459 4.59583 11.7959 5.2375 12.6375C5.87917 13.4792 6.75 14.45 7.85 15.55C8.95 16.65 10.3333 17.9667 12 19.5Z"
                              fill="#6750A4" />
                          </svg>
                        </button>
                      </div>
                    </div>
                  </div>
                <?php endforeach ?>
              <?php endif ?>
            </div>
          </div>
      </div>
      </section>
      <section class="section">
        <header class="section-header">
          <h2 class="section-title">Литературные новости</h2>
        </header>
        <div class="section-content">
          <div class="new-list">
            <div class="new">
              <a href="https://rg.ru/2023/05/21/oneginu-200-v-den-nachala-raboty-pushkina-nad-svoim-glavnym-poeticheskim-proizvedeniem-uzhe-bylo-predopredeleno-ego-okonchanie-no-sam-poet-ob-etom-eshche-ne-dogadyvalsia.php"
                class="new-photo">
                <img src="assets/news.png" alt="" />
              </a>
              <div class="new-info">
                <div class="new-info-title">Онегин</div>
                <div class="new-info-text">
                  Онегину - 200. В день начала работы Пушкина над своим
                  главным поэтическим произведением уже было предопределено
                  его окончание - но сам поэт об этом еще не догадывался...
                </div>
                <div class="new-actions">
                  <div class="new-data">12.05.2023</div>
                  <a href="https://rg.ru/2023/05/21/oneginu-200-v-den-nachala-raboty-pushkina-nad-svoim-glavnym-poeticheskim-proizvedeniem-uzhe-bylo-predopredeleno-ego-okonchanie-no-sam-poet-ob-etom-eshche-ne-dogadyvalsia.php"
                    class="button filled">Читать</a>
                </div>
              </div>
            </div>
            <div class="new">
              <a href="https://rg.ru/2023/05/21/oneginu-200-v-den-nachala-raboty-pushkina-nad-svoim-glavnym-poeticheskim-proizvedeniem-uzhe-bylo-predopredeleno-ego-okonchanie-no-sam-poet-ob-etom-eshche-ne-dogadyvalsia.php"
                class="new-photo">
                <img src="assets/news.png" alt="" />
              </a>
              <div class="new-info">
                <div class="new-info-title">Онегин</div>
                <div class="new-info-text">
                  Онегину - 200. В день начала работы Пушкина над своим
                  главным поэтическим произведением уже было предопределено
                  его окончание - но сам поэт об этом еще не догадывался...
                </div>
                <div class="new-actions">
                  <div class="new-data">12.05.2023</div>
                  <a href="https://rg.ru/2023/05/21/oneginu-200-v-den-nachala-raboty-pushkina-nad-svoim-glavnym-poeticheskim-proizvedeniem-uzhe-bylo-predopredeleno-ego-okonchanie-no-sam-poet-ob-etom-eshche-ne-dogadyvalsia.php"
                    class="button filled">Читать</a>
                </div>
              </div>
            </div>
            <div class="new">
              <a href="https://rg.ru/2023/05/21/oneginu-200-v-den-nachala-raboty-pushkina-nad-svoim-glavnym-poeticheskim-proizvedeniem-uzhe-bylo-predopredeleno-ego-okonchanie-no-sam-poet-ob-etom-eshche-ne-dogadyvalsia.php"
                class="new-photo">
                <img src="assets/news.png" alt="" />
              </a>
              <div class="new-info">
                <div class="new-info-title">Онегин</div>
                <div class="new-info-text">
                  Онегину - 200. В день начала работы Пушкина над своим
                  главным поэтическим произведением уже было предопределено
                  его окончание - но сам поэт об этом еще не догадывался...
                </div>
                <div class="new-actions">
                  <div class="new-data">12.05.2023</div>
                  <a href="https://rg.ru/2023/05/21/oneginu-200-v-den-nachala-raboty-pushkina-nad-svoim-glavnym-poeticheskim-proizvedeniem-uzhe-bylo-predopredeleno-ego-okonchanie-no-sam-poet-ob-etom-eshche-ne-dogadyvalsia.php"
                    class="button filled">Читать</a>
                </div>
              </div>
            </div>
            <div class="new">
              <a href="https://rg.ru/2023/05/21/oneginu-200-v-den-nachala-raboty-pushkina-nad-svoim-glavnym-poeticheskim-proizvedeniem-uzhe-bylo-predopredeleno-ego-okonchanie-no-sam-poet-ob-etom-eshche-ne-dogadyvalsia.php"
                class="new-photo">
                <img src="assets/news.png" alt="" />
              </a>
              <div class="new-info">
                <div class="new-info-title">Онегин</div>
                <div class="new-info-text">
                  Онегину - 200. В день начала работы Пушкина над своим
                  главным поэтическим произведением уже было предопределено
                  его окончание - но сам поэт об этом еще не догадывался...
                </div>
                <div class="new-actions">
                  <div class="new-data">12.05.2023</div>
                  <a href="https://rg.ru/2023/05/21/oneginu-200-v-den-nachala-raboty-pushkina-nad-svoim-glavnym-poeticheskim-proizvedeniem-uzhe-bylo-predopredeleno-ego-okonchanie-no-sam-poet-ob-etom-eshche-ne-dogadyvalsia.php"
                    class="button filled">Читать</a>
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