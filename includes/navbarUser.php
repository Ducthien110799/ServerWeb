  
<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center">
        <div class="sidebar-brand-icon rotate-n-15">
            <img src="https://img.icons8.com/officel/40/000000/guest-male.png"/>  
        </div>
        <div class="sidebar-brand-text mx-3">Nhân Viên</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="dashboard_user.php">
            <img src="https://img.icons8.com/clouds/100/000000/dashboard.png"/>
            <span>Dashboard </span></a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider">
    </li>
    <!-- Heading -->
    <div class="sidebar-heading">
        Quản lí
    </div>
   

    <!-- Nav Item - Charts -->
    <li class="nav-item">
        <a class="nav-link" href="loaisanpham_user.php">
            <img src="https://img.icons8.com/bubbles/50/000000/opened-folder.png"/>
            <span>Loại Sản phẩm</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="sanpham_user.php">
           <img src="https://img.icons8.com/bubbles/50/000000/used-product.png"/>
            <span>Sản phẩm</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="khachhang_user.php">
            <img src="https://img.icons8.com/fluent/48/000000/loyalty.png"/>

            <span>Khách hàng</span>
        </a>
    </li>
      <li class="nav-item">
        <a class="nav-link" href="donhang_user.php">
            <img src="https://img.icons8.com/bubbles/50/000000/purchase-order.png"/>
            <span>Đơn hàng</span>
        </a>
    </li>


    <!-- Divider -->

</ul>
<!-- End of Sidebar -->
<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

            <!-- Sidebar Toggle (Topbar) -->
            <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                <i class="fa fa-bars"></i>
            </button>

        <div style="height: 100px; width: 200px; padding-top: 20px;  ">
             <img src="img/logo.png" class="col-lg-12">
        </div>

        <!-- Topbar Navbar -->
        <ul class="navbar-nav ml-auto">

            <!-- Nav Item - Search Dropdown (Visible Only XS) -->
            <li class="nav-item dropdown no-arrow d-sm-none">
                <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-search fa-fw"></i>
            </a>
            <!-- Dropdown - Messages -->
            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
            aria-labelledby="searchDropdown">
            <form class="form-inline mr-auto w-100 navbar-search">
                <div class="input-group">
                    <input type="text" class="form-control bg-light border-0 small"
                    placeholder="Search for..." aria-label="Search"
                    aria-describedby="basic-addon2">
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="button">
                            <i class="fas fa-search fa-sm"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </li>
</li>




<div class="topbar-divider d-none d-sm-block"></div>

<!-- Nav Item - User Information -->
<li class="nav-item dropdown no-arrow">
    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    <span class="mr-2 d-none d-lg-inline text-gray-600 small">

       <?php if (isset($_SESSION['emailtk'])) { ?>
          <?php echo  $_SESSION['emailtk'] ?>  
      <?php } ?>
      <?php if (isset($_SESSION['idtk'])) { ?>
        <?php echo  $_SESSION['idtk'] ?>  
    <?php } ?>

  </span>
  <img src="https://img.icons8.com/offices/30/000000/test-account.png"/>
</a>
<!-- Dropdown - User Information -->
<div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
aria-labelledby="userDropdown">
<a class="dropdown-item" data-toggle="modal" data-target="#logoutModal">
    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
    Logout
</a>
</div>
</li>

</ul>

</nav>
<!-- End of Topbar -->

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
aria-hidden="true">
<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>

            <form action="logout.php" method="POST">

              <button type="submit" name="logout_btn" class="btn btn-primary">Logout</button>
          </form>
          
      </div>
  </div>
</div>


</div>

