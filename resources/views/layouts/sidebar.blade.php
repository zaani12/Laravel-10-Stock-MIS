<ul class="navbar-nav bg-orange-gradient sidebar sidebar-dark accordion" id="accordionSidebar" style="background: linear-gradient(90deg, #805AD5 0%, #5A67D8 100%);">

  <!-- Sidebar - Brand -->
  <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
    <div class="sidebar-brand-icon rotate-n-15">
      <i class="fas fa-motorcycle"></i>
    </div>
    <div class="sidebar-brand-text mx-3">Ziko Moto</div>
  </a>

  <!-- Divider -->
  <hr class="sidebar-divider my-0">

  <!-- Nav Item - Dashboard -->
  <li class="nav-item">
    <a class="nav-link" href="{{ route('AdminDashboard') }}">
      <i class="fas fa-fw fa-tachometer-alt"></i>
      <span>Dashboard</span></a>
  </li>

  <li class="nav-item">
    <a class="nav-link" href="{{ route('products') }}">
      <i class="fas fa-fw fa-gift"></i>
      <span>Product</span></a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="{{ route('products.market') }}">
      <i class="fas fa-fw fa-shopping-cart"></i>
      <span>Store</span></a>
  </li>


  <!-- <li class="nav-item">
    <a class="nav-link" href="fetchEmployees">
      <i class="fas fa-fw fa-users"></i>
      <span>Employees</span></a>
  </li> -->

  <li class="nav-item">
    <a class="nav-link" href="{{route('suppliers/index')}}">
      <i class="fas fa-fw fa-users"></i>
      <span>Suppliers</span></a>
  </li>

  <li class="nav-item">
    <a class="nav-link" href="userAccounts">
      <i class="fas fa-fw fa-lock"></i>
      <span>User Accounts</span></a>
  </li>

  <li class="nav-item">
    <a class="nav-link" href="/profile">
      <i class="fas fa-fw fa-user"></i>
      <span>Profile Setting</span></a>
  </li>

  <!-- Divider -->
  <hr class="sidebar-divider d-none d-md-block">

  <!-- Sidebar Toggler (Sidebar) -->
  <div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
  </div>


</ul>
