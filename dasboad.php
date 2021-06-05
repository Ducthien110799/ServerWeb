  <?php
  include 'server/security.php';
  include 'includes/header.php';
  include 'includes/navbar.php' ?>

  <!-- Begin Page Content -->
  <div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>  
        </div>
        <!-- Content Row -->
        <div class="row">

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xxs font-weight-bold text-primary text-uppercase mb-1">
                                Tiền bán hàng</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">

                                    <?php 
                                        require 'server/dbconfig.php';
                                        $sql_qry="SELECT SUM(chitietdonhang.soluongctdh*chitietdonhang.giactdh) as count FROM donhang INNER JOIN chitietdonhang on donhang.iddh= chitietdonhang.iddh WHERE donhang.xacnhandh='true'";
                                        $duration = $connection->query($sql_qry);
                                        while($record = $duration->fetch_array()){
                                            $total = $record['count'];
                                        }
                                        echo number_format($total).' VNĐ'
                                    ?>
                                </div>
                            </div>
                            <div class="col-auto">
                                    <img src="https://img.icons8.com/wired/64/000000/cheap-2.png"/>     
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Số đơn hàng</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    
                                    <?php 
                                            require 'server/dbconfig.php';
                                            $query="SELECT iddh  FROM donhang WHERE xacnhandh = 'true'";
                                            $query_run = mysqli_query($connection, $query);
                                            $row = mysqli_num_rows($query_run);
                                             echo $row;
                                        ?>
                                </div>
                            </div>
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Số sản phẩm</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    
                                     <?php 
                                        require 'server/dbconfig.php';
                                        $sql_qry="SELECT SUM(soluongctdh) AS count FROM chitietdonhang JOIN donhang on chitietdonhang.iddh=donhang.iddh WHERE donhang.xacnhandh= 'true'";
                                        $duration = $connection->query($sql_qry);
                                        while($record = $duration->fetch_array()){
                                            $total = $record['count'];
                                        }
                                        echo $total
                                    ?>
                                </div>
                            </div>
                            <div class="col-auto">
                                <img src="https://img.icons8.com/wired/64/000000/shopping-cart.png"/>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xxs font-weight-bold text-info text-uppercase mb-1">Tổng số khách hàng
                                </div>
                                <div class="row no-gutters align-items-center">
                                    <div class="col-auto">
                                        <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">

                                        <?php 
                                            require 'server/dbconfig.php';
                                            $query="SELECT idkh  FROM khachhang order by idkh";
                                            $query_run = mysqli_query($connection, $query);
                                            $row = mysqli_num_rows($query_run);
                                            echo $row
                                        ?>

                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                            <div class="col-auto">
                                <img src="https://img.icons8.com/wired/64/000000/budget.png"/>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pending Requests Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xxs font-weight-bold text-danger text-uppercase mb-1">
                                Đơn hàng chưa xác nhận</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    
                                    <?php 
                                            require 'server/dbconfig.php';
                                            $query="SELECT iddh  FROM donhang where xacnhandh='false'  order by iddh";
                                            $query_run = mysqli_query($connection, $query);
                                            $row = mysqli_num_rows($query_run);
                                            echo $row
                                        ?>
                                </div>
                            </div>
                            <div class="col-auto">
                                <img src="https://img.icons8.com/wired/64/FF0000/delivery.png"/>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Pending Requests Card Example -->
            <div class="col-xl-6 col-md-3 mb-4">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div style="width: 550px; height: auto;">
                            <canvas id="graph"></canvas>
                            <script>
                                $(document).ready(function () {
                                    showGraph();
                                });
                                function showGraph(){
                                        $.post("charData.php",
                                        function (data){
                                            var labels = [];
                                            var result = [];
                                            for (var i in data) {
                                                labels.push(data[i].status);
                                                result.push(data[i].size_status);
                                            }
                                            var pie = $("#graph");
                                            var myChart = new Chart(pie, {
                                                type: 'pie',
                                                data: {
                                                    labels: labels,
                                                    datasets: [
                                                        {
                                                            data: result,
                                                            borderColor: ["rgba(217, 83, 79,1)","rgba(240, 173, 78, 1)","rgba(92, 184, 92, 1)"],
                                                            backgroundColor: ["rgba(217, 83, 79,0.2)","rgba(240, 173, 78, 0.2)","rgba(92, 184, 92, 0.2)"],
                                                        }
                                                    ]
                                                },
                                                options: {
                                                    title: {
                                                        display: true,
                                                        text: "Tất cả sản phẩm"
                                                    }
                                                }
                                            });
                                        });
                                }
                                </script>
                        </div>
                    </div>
                </div>
            </div>


                <!-- Pending Requests Card Example -->
            <div class="col-xl-6 col-md-3 mb-4">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div style="width: 550px; height: auto;">
                            <canvas id="graph2"></canvas>
                            <script>
                                $(document).ready(function () {
                                    showGraph2();
                                });
                                function showGraph2(){
                                        $.post("charSale.php",
                                        function (data){
                                            var labels = [];
                                            var result = [];
                                            for (var i in data) {
                                                labels.push(data[i].status);
                                                result.push(data[i].size_status);
                                            }
                                            var pie = $("#graph2");
                                            var myChart = new Chart(pie, {
                                                type: 'pie',
                                                data: {
                                                    labels: labels,
                                                    datasets: [
                                                        {
                                                            data: result,
                                                            borderColor: ["rgba(217, 83, 79,1)","rgba(240, 173, 78, 1)","rgba(92, 184, 92, 1)"],
                                                            backgroundColor: ["rgba(217, 83, 79,0.2)","rgba(240, 173, 78, 0.2)","rgba(92, 184, 92, 0.2)"],
                                                        }
                                                    ]
                                                },
                                                options: {
                                                    title: {
                                                        display: true,
                                                        text: "Sản phẩm đã bán"
                                                    }
                                                }
                                            });
                                        });
                                }
                                </script>
                        </div>
                    </div>
                </div>
            </div>                          
        </div>
    </div>
    <!-- /.container-fluid -->
<hr class="sidebar-divider">
<!-- End of Main Content -->
<?php
include 'includes/scripts.php';
include'includes/footer.php'
?>

