<nav class="navbar navbar-expand-lg">
<a class="navbar-brand text-white" href="#">Dashboard</a>
<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
<span class="navbar-toggler-icon"></span>
</button>
<div class="collapse navbar-collapse" id="navbarNav">
<ul class="navbar-nav ml-auto ">
  <li class="nav-item">
    <a class="nav-link ml-4 btn hover:bg-red-700 bg-red-500 btn-sm" href="http://localhost/stock_managment/index.php"><span class="fa fa-home text-slate-300"></span> Home</a>
  </li>
  <li class="nav-item dropdown">
 <a class="nav-link dropdown-toggle btn btn-sm hover:bg-red-700 bg-red-500 ml-4" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
 <span class="fas fa-shop text-white"></span>  Manage shop
        </a>
        <div class="dropdown-menu bg-red-500 hover:bg-red-700" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item bg-red-500 hover:bg-red-700" href="http://localhost/stock_managment/product/index.php">Product</a>
          <a class="dropdown-item bg-red-500 hover:bg-red-700" href="http://localhost/stock_managment/category/index.php">Category</a>
        </div>
  </li>
  <li class="nav-item">
    <a class="nav-link ml-4 btn hover:bg-red-700 bg-red-500 btn-sm" href="#">Pricing</a>
  </li>
  <li class="nav-item">
    <a class="nav-link ml-4 btn hover:bg-red-700 bg-red-500 btn-sm" href="#"><span class='fa fa-user text-slate-300'></span> Account</a>
  </li>
  <li>
    
    <a href="http://localhost/stock_managment/logout.php" class="btn hover:bg-red-700 bg-red-500 ml-4"><span class="fa fa-user"></span> logout</a>
  </li>
</ul>
</div>
</nav>