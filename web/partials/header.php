<?php

$auth_token = json_decode($_COOKIE['auth_token'] ?? '', true);

?>

<header class="header">
  <div class="search-input">
    <form action="catalog.php">
      <input type="search" name="search" id="search" placeholder="Поиск" />
    </form>
  </div>
  <?php if ($auth_token && $auth_token['role'] && $auth_token['role'] !== 'USER'): ?>
    <div class="header-navigation">
      <a href="/orders.php" class="header-navigation-item">Заказы</a>
      <a href="/books.php" class="header-navigation-item">Каталог</a>
      <?php if ($auth_token['role'] === "ADMIN"): ?>
        <a href="/workers.php" class="header-navigation-item">Работники</a>
      <?php endif ?>
    </div>
  <?php endif ?>
  <div class="header-title">
    <span class="header-text">Добро пожаловать,&nbsp;</span>
    <a href="profile.php" class="header-text-name">
      <?php echo $auth_token ? $auth_token['first_name'] : "гость" ?>!
    </a>
  </div>
</header>