<!--Navbar-->
<nav class="navbar fixed-top navbar-expand-lg navbar-dark primary-color">

  <!-- Navbar brand -->
  <a class="navbar-brand" href="#">典藏台灣</a>

  <!-- Collapse button -->
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#basicExampleNav"
    aria-controls="basicExampleNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <!-- Collapsible content -->
  <div class="collapse navbar-collapse " id="basicExampleNav" >

    <!-- Links -->
    <ul class="navbar-nav mr-auto ">
      <li class="nav-item active">
        <a class="nav-link" href="index.php">首頁
          <span class="sr-only">(current)</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="abouts.php">最新文章</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="academic.php">學術典藏</a>
      </li>

      <!-- Dropdown -->
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown"
          aria-haspopup="true" aria-expanded="false">學習專區</a>
        <div class="dropdown-menu dropdown-primary" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item" href="a.php">認識數位典藏</a>  <!-- a.php -->
          <a class="dropdown-item" href="b.php">教材下載</a> <!-- b.php -->
          <a class="dropdown-item" href="c.php">協同編撰教材</a> <!-- c.php -->
          <a class="dropdown-item" href="d.php">能力測驗</a> <!-- d.php -->
        </div>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="./admin/index.php">會員登入</a>
      </li>

    </ul>
    <!-- Links -->

    <!-- <form class="form-inline">
      <div class="md-form my-0">
        <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search">
      </div>
    </form> -->
  </div>
  <!-- Collapsible content -->

</nav>
<!--/.Navbar-->