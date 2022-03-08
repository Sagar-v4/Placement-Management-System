<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Analytics</title>
    
     <link rel="stylesheet" href="<?= base_url("public/admin/");?>plugins/fontawesome-free/css/all.min.css"> 
    <link rel="stylesheet" href="<?= base_url("public/admin/");?>plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <link rel="stylesheet" href="<?= base_url("public/admin/");?>dist/css/adminlte.min.css">
    <link rel="icon" type="image/png" href="<?= base_url().'uploads/system/logo.svg';?>">
    <link rel="icon" href="<?= base_url("public/stu-com/");?>assets/img/brand/favicon.png" type="image/png">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
    <link rel="stylesheet" href="<?= base_url("public/stu-com/");?>assets/vendor/nucleo/css/nucleo.css" type="text/css">
    <link rel="stylesheet" href="<?= base_url("public/stu-com/");?>assets/css/argon.css?v=1.2.0" type="text/css">

    <style type="text/css">
    .active{
        color: #172b4d;
        background-color: #f6f9fc;
    }
    
    /* Hide scrollbar for Chrome, Safari and Opera */
    .example::-webkit-scrollbar {
        display: none;
    }

    /* Hide scrollbar for IE, Edge and Firefox */
    .example {
    -ms-overflow-style: none;  /* IE and Edge */
    scrollbar-width: none;  /* Firefox */
    }

    /* Chrome, Safari, Edge, Opera */
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
    }

    /* Firefox */
    input[type=number] {
    -moz-appearance: textfield;
    }
    </style>

</head>

<body class="control-sidebar-slide-open layout-fixed g-sidenav-show g-sidenav-pinned">

<div class="wrapper">
    <nav class="main-header navbar navbar-top fixed-top navbar-expand navbar-dark bg-yellow border-bottom">
        <div class="container-fluid">
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars push-lg"></i></a>
                    </li>
                </ul>
                <ul class="navbar-nav align-items-center  ml-md-auto ">

                    <li class="nav-item dropdown">
                        <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span><i class="ni ni-bell-55"></i><span class="badge"><?= count($quickNotifications);?></span></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-xl  dropdown-menu-right  py-0 overflow-hidden">
                            <div class="px-3 py-3">
                                <h6 class="text-sm text-muted m-0">You have <strong class="text-primary"><?= count($quickNotifications);?></strong> notifications.</h6>
                            </div>
                            <div class="list-group list-group-flush">
                                
                                <?php if ( !empty($quickNotifications) ) { rsort($quickNotifications); $i = 0; foreach ($quickNotifications as $notification) { ?>

                                    <a class="list-group-item list-group-item-action">
                                        <div class="row align-items-center">
                                            <div class="col-auto">
                                                <!-- Avatar -->
                                                <i class="<?= $notification['company_notification_class']; ?> px-1 " style="transform: scale(1.5, 1.5);"></i>
                                            </div>
                                            <div class="col ml--2">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <div class="text-right text-muted">
                                                        <small><?= $notification['time']?></small>
                                                    </div>
                                                </div>
                                                <p class="text-sm mb-0"><?= $notification['company_notification_detail']?></p>
                                            </div>
                                        </div>
                                    </a>

                                <?php $i++; if ( $i >= 3) break; } } else { ?>
                                    <div class="text-center"><h4>You Have No Notifications.</h4></div>
                                <?php } ?>

                                <a href="<?= base_url().'company/notifications/index';?>" class="dropdown-item text-center text-primary font-weight-bold py-3">View all</a>
                            </div>
                        </div>
                    </li>
                </ul>
                <ul class="navbar-nav align-items-center ml-auto ml-md-0 ">
                    <li class="nav-item dropdown">
                        <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <div class="media align-items-center">
                                <span class="avatar avatar-sm rounded-circle">
                                    <img alt="Image placeholder" src="<?= base_url().$userInfo['profile_thumb'] ;?>">
                                </span>
                                <div class="media-body  ml-2  d-none d-lg-block">
                                    <span class="mb-0 text-sm  font-weight-bold"><?= $userInfo['name'] ;?></span>
                                </div>
                            </div>
                        </a>
                        <div class="dropdown-menu  dropdown-menu-right ">
                            <div class="dropdown-header noti-title">
                                <h6 class="text-overflow m-0"><?= $userInfo['name'] ;?></h6>
                            </div>
                            <a href="<?= base_url().'home/home/index'; ?>" class="dropdown-item">
                                <i class="ni ni-world"></i>
                                <span>Home</span>
                            </a>
                            <a href="<?= base_url().'company/profile/index';?>" class="dropdown-item">
                                <i class="ni ni-single-02"></i>
                                <span>My profile</span>
                            </a>
                            <a href="<?= base_url().'company/changepassword/index';?>" class="dropdown-item">
                                <i class="ni ni-lock-circle-open"></i>
                                <span>Change Password</span>
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="<?= base_url().'login/login/logout/company';?>" class="dropdown-item">
                                <i class="ni ni-user-run"></i>
                                <span>Logout</span>
                            </a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    
  <nav class="main-sidebar sidenav  sidebar-light-primary navbar-vertical  " id="sidenav-main">

    <div class="scrollbar-inner">
        <div class="sidenav-header  align-items-center">
            <a class="navbar-brand" href="<?= base_url().'home/home/index'; ?>">
                <img src="<?= base_url().'uploads/system/logo.svg';?>" class="navbar-brand-img">
            </a>
        </div>
        <div class="navbar-inner  align-items-center ">
                <ul class="navbar-nav flex-column ml-2 mr-2 pt-1">

                    <li class="nav-item mt-3 mb-1" >
                        <a href="<?= base_url().'company/analytics/index';?>" class="nav-link pt-2 pb-2 rounded active">
                            <i class="nav-icon ni ni-chart-bar-32 text-yellow"></i>
                            <span class="nav-link-text">Analytics</span>
                        </a>
                    </li>
                    <li class="nav-item mt-1 mb-1">
                        <a href="<?= base_url().'company/profile/index';?>" class="nav-link pt-2 pb-2 rounded ">
                            <i class="nav-icon fas fa-building text-default "></i>
                            <span class="nav-link-text">Profile</span>
                        </a>
                    </li>
                    <li class="nav-item mt-1 mb-1">
                        <a href="<?= base_url().'company/home/index';?>" class="nav-link pt-2 pb-2 rounded ">
                            <i class="nav-icon ni ni-tv-2 text-primary"></i>
                            <span class="nav-link-text">Dashboard</span>
                        </a>
                    </li> 
                    <li class="nav-item mt-1 mb-1">
                        <a href="<?= base_url().'company/notifications/index';?>" class="nav-link pt-2 pb-2 rounded">
                            <i class="nav-icon ni ni-bell-55 text-orange"></i>
                            <span class="nav-link-text">Notifications</span>
                        </a>
                    </li> 

                    <li class="nav-header m-2" >REQUIREMENTS</li>

                    <li class="nav-item mt-1 mb-1">
                        <a href="<?= base_url().'company/view/index';?>" class="nav-link pt-2 pb-2 rounded">
                            <i class="nav-icon fas fa-tasks text-info"></i>
                            <span class="nav-link-text">View All</span>
                        </a>
                    </li> 
                    <li class="nav-item mt-1 mb-1">
                        <a href="<?= base_url().'company/exams/index';?>" class="nav-link pt-2 pb-2 rounded">
                            <i class="nav-icon fas fa-edit text-info"></i>
                            <span class="nav-link-text">Exams</span>
                        </a>
                    </li> 
                    <li class="nav-item mt-1 mb-1">
                        <a href="<?= base_url().'company/interviews/index';?>" class="nav-link pt-2 pb-2 rounded">
                            <i class="nav-icon fas fa-podcast text-info"></i>
                            <span class="nav-link-text">Interviews</span>
                        </a>
                    </li> 
                    <li class="nav-item mt-1 mb-1">
                        <a href="<?= base_url().'company/new_requirement/index';?>" class="nav-link pt-2 pb-2 rounded">
                            <i class="nav-icon ni ni-fat-add text-info"></i>
                            <span class="nav-link-text">New</span>
                        </a>
                    </li>

                    <li class="nav-header m-2" >OTHERS</li>
                    
                    <li class="nav-item mt-1 mb-1">
                        <a href="<?= base_url().'company/changepassword/index';?>" class="nav-link pt-2 pb-2 rounded">
                            <i class="nav-icon fas fa-fingerprint text-success"></i>
                            <span class="nav-link-text">Change Password</span>
                        </a>
                    </li> 
                    <li class="nav-item mt-1 mb-1">
                        <a href="<?= base_url().'login/login/logout/company';?>" class="nav-link pt-2 pb-2 rounded">
                            <i class="nav-icon fas fa-sign-out-alt text-danger"></i>
                            <span class="nav-link-text">SIGN OUT</span>
                        </a>
                    </li> 
                </ul>
            </div>
            
    </div>
  </nav>

    <div class="content-wrapper mt-5"  style="min-width: 300px;">
        <div class=" position-fixed pb-6 bg-yellow " style="top:0px ; height:55%; width: 100%;">
        </div>
        <div class="header mt-6 pt-2 pb-6">
            <div class="container-fluid">
                <div class="header-body">
                    <div class="row mt-4">
                      <div class="col-lg-3 col-sm-6">
                        <div class="card small-box bg-success text-white">
                          <div class="inner">
                            <h3 class="text-white"><?= $totalPlaced;?> <small>Placed</small></h3>
                            <p>Total Students Placements</p>
                          </div>
                        </div>
                      </div>
                      <div class="col-lg-3 col-sm-6">
                        <div class="card small-box bg-primary text-white">
                          <div class="inner">
                            <h3 class="text-white"><?= $totalActive;?> <small>Active</small></h3>
                            <p>Total Active Requirements</p>
                          </div>
                        </div>
                      </div>
                      <div class="col-lg-3 col-sm-6">
                        <div class="card small-box bg-default text-white">
                          <div class="inner">
                            <h3 class="text-white"><?= $totalDeactive;?> <small>Deactivated</small></h3>
                            <p>Total Deactivated Requirements</p>
                          </div>
                        </div>
                      </div>
                      <div class="col-lg-3 col-sm-6">
                        <div class="card small-box bg-info text-white">
                          <div class="inner">
                            <h3 class="text-white"><?= $totalReqs;?> <small>Requirements</small></h3>
                            <p>Total Requirements</p>
                          </div>
                        </div>
                      </div>
                  </div>
                </div>
                <div class="row mt-2 mb-4">
                    <div class="col-md-6 col-sm-12">
                        <div id="piechartStudentApplications" style="height: 500px;"></div>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <div id="barchartStudentApplications" style="height: 500px;"></div>
                     </div>
                </div>
        
                <div class="row my-3">
                    <div class="col-md-6 col-sm-12">
                        <div id="piechartExam" style=" height: 500px;"></div>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <div id="barchartExam" style=" height: 500px;"></div>
                    </div>
                </div>
                
                <div class="row my-3">
                    <div class="col-md-6 col-sm-12">
                        <div id="piechartInterview" style=" height: 500px;"></div>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <div id="barchartInterview" style=" height: 500px;"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 0.0.1
    </div>
    <strong>Copyright &copy; 2021-2022 <a href="#">Sagar Variya Production</a>.</strong> All rights reserved.
  </footer>
</div>

<script src="<?= base_url("public/admin/");?>plugins/jquery/jquery.min.js"></script>
<script src="<?= base_url("public/admin/");?>plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<script src="<?= base_url("public/admin/");?>dist/js/adminlte.minSC.js"></script>
<script src="<?= base_url("public/stu-com/");?>assets/vendor/jquery/dist/jquery.min.js"></script>
<script src="<?= base_url("public/stu-com/");?>assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<script src="<?= base_url("public/stu-com/");?>assets/vendor/js-cookie/js.cookie.js"></script>
<script src="<?= base_url("public/stu-com/");?>assets/vendor/jquery.scrollbar/jquery.scrollbar.min.js"></script>
<script src="<?= base_url("public/stu-com/");?>assets/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js"></script>
<script src="<?= base_url("public/stu-com/");?>assets/js/argon.js?v=1.2.0"></script>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

    <script type="text/javascript">

      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Gender', 'Student Gender Ratio'],
          <?php if(!empty($applications[0])) { ?>['<?php if($applications[0]['status']==0) echo "Revoked";?>', <?= $applications[0]['application'];?>],<?php } ?>
          <?php if(!empty($applications[1])) { ?>['<?php if($applications[1]['status']==1) echo "Applies";?>', <?= $applications[1]['application'];?>],<?php } ?>
        ]);

        var options = {
          title: 'Student Application Ratio',
          is3D: true, 
          
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechartStudentApplications'));

        chart.draw(data, options);
      }
    </script>
    
    <script type="text/javascript">

      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Application', 'Student Application Ratio', { role: "style" }],
          <?php if(!empty($applications[0])) { ?>['<?php if($applications[0]['status']==0) echo "Revoked";?>', <?= $applications[0]['application'];?>, "#3366CC"],<?php } ?>
          <?php if(!empty($applications[1])) { ?>['<?php if($applications[1]['status']==1) echo "Applies";?>', <?= $applications[1]['application'];?>, "#DC3912"],<?php } ?>
        ]);

        var options = {
          title: 'Student Application Ratio',
          pieHole: 0.4,
          
        };

        var chart = new google.visualization.BarChart(document.getElementById('barchartStudentApplications'));

        chart.draw(data, options);
      }
    </script>
    
    <script type="text/javascript">

      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Exams', 'Status'],
          <?php if(!empty($exams[0])) { ?>['<?php if($exams[0]['exam']==0) echo "Deactive";?>', <?= $exams[0]['status'];?>],<?php } ?>
          <?php if(!empty($exams[1])) { ?>['<?php if($exams[1]['exam']==1) echo "Activate";?>', <?= $exams[1]['status'];?>],<?php } ?>
         
        ]);

        var options = {
          title: 'All Exams Status',
          pieHole: 0.4,
          
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechartExam'));

        chart.draw(data, options);
      }
    </script>
    
    <script type="text/javascript">

      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Exams', 'Status', { role: "style" }],
          <?php if(!empty($exams[0])) { ?>['<?php if($exams[0]['exam']==0) echo "Deactive";?>', <?= $exams[0]['status'];?>, "#3366CC"],<?php } ?>
          <?php if(!empty($exams[1])) { ?>['<?php if($exams[1]['exam']==1) echo "Activate";?>', <?= $exams[1]['status'];?>, "#DC3912"],<?php } ?>
        ]);

        var options = {
          title: 'All Exams Status',
          pieHole: 0.4,
          
        };

        var chart = new google.visualization.ColumnChart(document.getElementById('barchartExam'));

        chart.draw(data, options);
      }
    </script>
    
    <script type="text/javascript">

      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Interviews', 'Status'],
          <?php if(!empty($interviews[0])) { ?>['<?php if($interviews[0]['interview']==0) echo "Deactive";?>', <?= $interviews[0]['status'];?>],<?php } ?>
          <?php if(!empty($interviews[1])) { ?>['<?php if($interviews[1]['interview']==1) echo "Activate";?>', <?= $interviews[1]['status'];?>],<?php } ?>
         
        ]);

        var options = {
          title: 'All Interviews Status',
          pieHole: 0.4,
          
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechartInterview'));

        chart.draw(data, options);
      }
    </script>
    
    <script type="text/javascript">

      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Interviews', 'Status', { role: "style" }],
          <?php if(!empty($interviews[0])) { ?>['<?php if($interviews[0]['interview']==0) echo "Deactive";?>', <?= $interviews[0]['status'];?>, "#3366CC"],<?php } ?>
          <?php if(!empty($interviews[1])) { ?>['<?php if($interviews[1]['interview']==1) echo "Activate";?>', <?= $interviews[1]['status'];?>, "#DC3912"],<?php } ?>
        ]);

        var options = {
          title: 'All Interviews Status',
          pieHole: 0.4,
          
        };

        var chart = new google.visualization.ColumnChart(document.getElementById('barchartInterview'));

        chart.draw(data, options);
      }
    </script>



</body>
</html>
