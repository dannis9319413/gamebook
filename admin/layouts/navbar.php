<nav class="navbar navbar-expand-xl navbar-dark bg-dark">
  <div class="container">
    <a class="navbar-brand" href="../news/list.php">
      <h6 style="position:relative; top: 4px;"> GAMEBOOK 後臺管理系統</h6>
    </a>
    <button class="navbar-toggler navbar-toggler-right" data-toggle="collapse" data-target="#navbar1">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbar1" style="font-size: .8rem;">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item"> <a class="nav-link" href="../news/list.php">最新資料管理</a> </li>
        <li class="nav-item"> <a class="nav-link" href="../products/list.php">商品管理</a> </li>
        <li class="nav-item"> <a class="nav-link" href="../users/list.php">會員管理</a> </li>
        <li class="nav-item"> <a class="nav-link" href="../orders/list.php">訂單管理</a> </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle " data-toggle="dropdown" href="w" role="button" aria-haspopup="true" aria-expanded="false" style="font-size: 18px;">管理者</a>
          <div class="dropdown-menu" style="min-width:100px;">

            <div class="dropdown-item" style="font-size: 18px;"><?php echo $_SESSION['admin']['account']; ?>您好
            </div>
            <a class="dropdown-item" href="../../index.php" style="font-size: 18px;">返回前台</a>
            <div class="dropdown-divider" style="width:100%;"></div>

            <a class="dropdown-item" href="../functions/logout.php" style="font-size: 18px;">登出</a>

          </div>
        </li>

      </ul>
    </div>
  </div>
</nav>