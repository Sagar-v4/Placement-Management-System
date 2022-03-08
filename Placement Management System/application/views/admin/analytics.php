<!DOCTYPE html>
<html lang="en">
<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Analytics</title>

  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="icon" type="image/png" href="<?= base_url().'uploads/system/logo.svg';?>">
  <link rel="stylesheet" href="<?= base_url("public/admin/");?>plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="<?= base_url("public/admin/");?>plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <link rel="stylesheet" href="<?= base_url("public/admin/");?>dist/css/adminlte.min.css">
</head>

<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
  <nav class="main-header fixed-top navbar navbar-expand navbar-white navbar-light">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>

    <ul class="navbar-nav ml-auto">
      <li class="nav-item dropdown">
        <a class="nav-link mb-2" data-toggle="dropdown" href="#">
          <div class="user-panel pb-2 ">
            <div class="image">
              <img src="<?= base_url().$userInfo['profile_thumb'] ;?>" class="img-circle elevation-2" alt="User Image">
            </div>   
          </div>  
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <div class=" dropdown-header"><strong><?= $userInfo['fname']." ".$userInfo['lname'];?></strong></div>
          <div class="dropdown-divider"></div>
          <a href="<?= base_url().'home/home/index';?>" class="dropdown-item">
            <i class="fas fa-home mr-2"></i> Home
          </a>
          <div class="dropdown-divider"></div>
          <a href="<?= base_url().'admin/profile/index';?>" class="dropdown-item">
            <i class="fas fa-id-card-alt mr-2"></i> My Profile
          </a>
          <div class="dropdown-divider"></div>
          <a href="<?= base_url().'admin/changepassword/index';?>" class="dropdown-item">
            <i class="fas fa-user-lock mr-2"></i> Change Password
          </a>
          <div class="dropdown-divider"></div>
          <a href="<?= base_url().'login/login/logout/admin';?>" class="dropdown-item">
            <i class="fas fa-running mr-2"></i> Log Out
          </a>
        </div>
      </li>

    </ul>
  </nav>

  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="<?= base_url().'home/home/index'; ?>" class="brand-link">
      <img src="<?= base_url().'uploads/system/adminLogo.svg';?>" alt="Admin Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-dark">PMS - Admin</span>
    </a>

    <div class="sidebar">

      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
      
          <li class="nav-item">
            <a href="<?= base_url().'admin/analytics/index';?>" class="nav-link active">
              <i class="nav-icon fas fa-chart-bar"></i>
              <p>Analytics</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= base_url().'admin/profile/index';?>" class="nav-link">
              <i class="nav-icon fas fa-user-shield"></i>
              <p>Profile</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= base_url().'admin/home/index';?>" class="nav-link">
              <i class="nav-icon fas fa-columns"></i>
              <p>Dashboard</p>
            </a>
          </li>

          <li class="nav-header">MANAGE</li>

          <li class="nav-item">
            <a href="<?= base_url().'admin/users/index';?>" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>All Users</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-user-cog"></i>
              <p>Admins
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
                <?php if ( $userInfo['power'] == 1 ) { ?>
                  <li class="nav-item">
                    <a href="<?= base_url().'admin/addadmin/index';?>" class="nav-link">
                      <i class="nav-icon fa fa-plus"></i>
                      <p>Add New</p>
                    </a>
                  </li>
                <?php } ?>
              <li class="nav-item">
                <a href="<?= base_url().'admin/admindetail/index';?>" class="nav-link">
                  <i class="nav-icon fas fa-info-circle"></i>
                  <p>Details</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item ">
            <a href="#" class="nav-link ">
              <i class="nav-icon fas fa-user-graduate"></i>
              <p>Students
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?= base_url().'admin/addnewstudent/index';?>" class="nav-link">
                  <i class="nav-icon fa fa-plus"></i>
                  <p>Add New</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= base_url().'admin/studentdetail/index';?>" class="nav-link ">
                  <i class="nav-icon fas fa-info-circle"></i>
                  <p>Details</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-address-card"></i>
              <p>Company
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
                <?php if ( $userInfo['power'] == 1 ) { ?>
                  <li class="nav-item">
                    <a href="<?= base_url().'admin/addnewcompany/index';?>" class="nav-link">
                      <i class="nav-icon fa fa-plus"></i>
                      <p>Add New</p>
                    </a>
                  </li>
                <?php } ?>
              <li class="nav-item">
                <a href="<?= base_url().'admin/companydetail/index';?>" class="nav-link">
                  <i class="nav-icon fas fa-info-circle"></i>
                  <p>Details</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="<?= base_url().'admin/deactivated/index';?>" class="nav-link">
              <i class="nav-icon fas fa-ban"></i>
              <p>Deactivated</p>
            </a>
          </li>

          <li class="nav-header">OTHERS</li>

          <?php if ( $userInfo['power'] == 1 ) { ?>
            <li class="nav-item">
              <a href="<?= base_url().'admin/contactus/index';?>" class="nav-link">
                <i class="nav-icon fas fa-envelope"></i>
                <p>Contact Us</p>
              </a>
            </li>
          <?php } ?>
          <li class="nav-item">
            <a href="<?= base_url().'admin/changepassword/index';?>" class="nav-link">
              <i class="nav-icon fas fa-fingerprint"></i>
              <p>Change Password</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= base_url().'login/login/logout/admin';?>" class="nav-link">
              <i class="nav-icon fas fa-sign-out-alt"></i>
              <p>SIGN OUT</p>
            </a>
          </li>
        </ul>
      </nav>
    </div>
  </aside>

  <div class="content-wrapper mt-5">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mt-4 mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Analytics</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?= base_url().'home/home/index'; ?>">Home</a></li>
              <li class="breadcrumb-item active">Analytics</li>
            </ol>
          </div>
        </div>
      </div>
    </div>

    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-3 col-sm-6">
            <div class="small-box bg-info">
              <div class="inner">
                <h3><?= $databaseSize;?> MB</h3>
                <p>Database Size</p>
              </div>
            </div>
          </div>

          <div class="col-lg-3 col-sm-6">
            <div class="small-box bg-success">
              <div class="inner">
                <h3><?= $projectMediaSize;?> MB</h3>
                <p>Media Size</p>
              </div>
            </div>
          </div>

          <div class="col-lg-3 col-sm-6">
            <div class="small-box bg-warning">
              <div class="inner">
                <h3><?= $projectTotalSize;?> MB</h3>
                <p>File Size</p>
              </div>
            </div>
          </div>
          
          <div class="col-lg-3 col-sm-6">
            <div class="small-box bg-danger">
              <div class="inner">
                <h3><?= $totalSize;?> MB</h3>
                <p>Total PMS Storage</p>
              </div>
            </div>
          </div>
        </div>
        
        <div class="row my-2">
          <div class="col-md-6 col-sm-12">
            <div id="piechartStudentGenderRation" style="height: 500px;"></div>
          </div>
          <div class="col-md-6 col-sm-12">
            <div id="barchartStudentGenderRation" style="height: 500px;"></div>
          </div>
        </div>

        <div class="row my-3">
          <div class="col-md-6 col-sm-12">
            <div id="piechartUserCount" style=" height: 500px;"></div>
          </div>
          <div class="col-md-6 col-sm-12">
            <div id="barchartUserCount" style=" height: 500px;"></div>
          </div>
        </div>
        </div>
      </div>
    </div>
  </div>

  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 1.0.0
    </div>
    <strong>Copyright &copy; 2021-2022 <a href="#">Sagar Variya Production</a>.</strong> All rights reserved.
  </footer>
</div>

  <script src="<?= base_url("public/admin/");?>plugins/jquery/jquery.min.js"></script>
  <script src="<?= base_url("public/admin/");?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="<?= base_url("public/admin/");?>plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
  <script src="<?= base_url("public/admin/");?>dist/js/adminlte.min.js"></script>
  <script src="<?= base_url("public/admin/");?>dist/js/demo.js"></script>


  
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

    <script type="text/javascript">

      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Gender', 'Student Gender Ratio'],
          <?php if(!empty($studentGender[0])) { ?>['<?= $studentGender[0]['student_gender'];?>', <?= $studentGender[0]['gender'];?>],<?php } ?>
          <?php if(!empty($studentGender[1])) { ?>['<?= $studentGender[1]['student_gender'];?>', <?= $studentGender[1]['gender'];?>],<?php } ?>
          <?php if(!empty($studentGender[2])) { ?>['<?= $studentGender[2]['student_gender'];?>', <?= $studentGender[2]['gender'];?>],<?php } ?>
        ]);

        var options = {
          title: 'Student Gender Ratio',
          is3D: true,
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechartStudentGenderRation'));

        chart.draw(data, options);
      }
    </script>
    
    <script type="text/javascript">

      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Gender', 'Student Gender Ratio', { role: "style" }],
          <?php if(!empty($studentGender[0])) { ?>['<?= $studentGender[0]['student_gender'];?>', <?= $studentGender[0]['gender'];?>, "#3366CC"],<?php } ?>
          <?php if(!empty($studentGender[1])) { ?>['<?= $studentGender[1]['student_gender'];?>', <?= $studentGender[1]['gender'];?>, "#DC3912"],<?php } ?>
          <?php if(!empty($studentGender[2])) { ?>['<?= $studentGender[2]['student_gender'];?>', <?= $studentGender[2]['gender'];?>, "#FF9900"],<?php } ?>
        ]);

        var options = {
          title: 'Student Gender Ratio',
          pieHole: 0.4,
          
        };

        var chart = new google.visualization.BarChart(document.getElementById('barchartStudentGenderRation'));

        chart.draw(data, options);
      }
    </script>
    
    <script type="text/javascript">

      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Roles', 'PMS Users'],
          <?php if(!empty($totalUsers[0])) { ?>['<?= $totalUsers[0]['user_role'];?>', <?= $totalUsers[0]['role'];?>],<?php } ?>
          <?php if(!empty($totalUsers[1])) { ?>['<?= $totalUsers[1]['user_role'];?>', <?= $totalUsers[1]['role'];?>],<?php } ?>
          <?php if(!empty($totalUsers[2])) { ?>['<?= $totalUsers[2]['user_role'];?>', <?= $totalUsers[2]['role'];?>],<?php } ?>
        ]);

        var options = {
          title: 'All PMS Users',
          pieHole: 0.4,
          
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechartUserCount'));

        chart.draw(data, options);
      }
    </script>
    
    <script type="text/javascript">

      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Roles', 'PMS Users', { role: "style" }],
          <?php if(!empty($totalUsers[0])) { ?>['<?= $totalUsers[0]['user_role'];?>', <?= $totalUsers[0]['role'];?>, "#3366CC"],<?php } ?>
          <?php if(!empty($totalUsers[1])) { ?>['<?= $totalUsers[1]['user_role'];?>', <?= $totalUsers[1]['role'];?>, "#DC3912"],<?php } ?>
          <?php if(!empty($totalUsers[2])) { ?>['<?= $totalUsers[2]['user_role'];?>', <?= $totalUsers[2]['role'];?>, "#FF9900"],<?php } ?>
        ]);

        var options = {
          title: 'All PMS Users',
          pieHole: 0.4,
          
        };

        var chart = new google.visualization.ColumnChart(document.getElementById('barchartUserCount'));

        chart.draw(data, options);
      }
    </script>

</body>
</html>
