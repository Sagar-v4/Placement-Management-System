<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard</title>
    
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
    
    <nav class="main-header navbar navbar-top fixed-top navbar-expand navbar-dark bg-primary border-bottom">
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
                        <a href="<?= base_url().'company/analytics/index';?>" class="nav-link pt-2 pb-2 rounded ">
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
                        <a href="<?= base_url().'company/home/index';?>" class="nav-link pt-2 pb-2 rounded active">
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

    <div class="content-wrapper mt-5">
        <span class=" position-fixed pb-6  bg-primary  " style="top:0px ; height:55%; width: 100%;">
        </span>
        <div class="row col-12 pt-2" style="margin-left:0px; margin-top: 90px;">

        
        <?php if ( !empty($requirements) ) { $i = 0; rsort($requirements); foreach ($requirements as $requirement) { ?>

            <div class="col-xl-3 col-lg-4 col-md-4 col-sm-6">
                <div class="card ">
                    <div class="card-header  example" style="max-height: 100px; overflow:auto;">
                        <div class="row align-items-center">
                            <div class="col-12">
                                <h4 class="mb-0"><?= $requirement['company_requirement_name'] ;?></h4>
                            </div>
                            <div class="col-12 ">
                                <h5 class="mb-0" class="btn btn-sm btn-neutral"><?= $requirement['company_requirement_post'] ;?> - <span class="card-text"><?= $requirement['company_requirement_vacancy'] ;?></span></h5>
                            </div>
                        </div>
                    </div>
                    <div class="card-body example" style="max-height:250px; overflow:auto; ">
                        <p class=" card-text mb-0"><strong>Starting Salary : </strong><?= $requirement['company_requirement_min_salary'] ;?></p>
                        <p class=" card-text mb-0"><strong>Last Date : </strong><?= date('d-m-Y' ,strtotime($requirement['company_requirement_last_date'])) ;?></p>
                    </div>
                    <div class="row card-body">
                        <div class="col-12 text-center">
                            <button type="button" class="col-8 btn btn-sm btn-primary "  data-toggle="modal" data-target="#modal-requirement<?= $i++;?>">View</button>
                        </div>
                    </div>
                </div>
            </div>

        <?php } } ?>

        
        <?php if ( !empty($requirements) ) { $j = 0; foreach ($requirements as $requirement) { ?>

            <div class="modal fade" id="modal-requirement<?= $j;?>" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
                <div class="modal-dialog modal- modal-dialog-centered modal-xl " role="document">
                    <div class="modal-content ">
                        
                        <div class="modal-body p-0">
                        
                            <div class="card bg-secondary border-0 mb-0">
                                <div class="card-body px-lg-10 py-lg-10">

                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    <h6 class="heading-small text-muted mb-4"><?= $requirement['company_name'] ; ?></h6>
                                        <div class="pl-lg-4">

                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <label for="requirement_name" class="form-control-label">Requirement Name</label>
                                                    <div class="mb-3">
                                                        <div name="requirement_name" id="requirement_name" class="form-control "><?= $requirement['company_requirement_name'] ; ?></div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <label for="post" class="form-control-label">Requirement Post</label>
                                                    <div class="mb-3">
                                                        <div name="post" id="post" class="form-control "><?= $requirement['company_requirement_post'] ; ?></div>
                                                    </div>
                                                </div>
                                            </div>

                                            <label for="description" class="form-control-label">Requirement Description</label>
                                            <div class="mb-3">
                                                <div name="description " style="overflow:auto;" id="description" class="form-control pb-6 example"><?= $requirement['company_requirement_description'] ; ?></div>
                                            </div>

                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <label for="percentage" class="form-control-label">Percentage</label>
                                                    <div class="input-group mb-3">
                                                        <div class="form-control " name="percentage" id="percentage"><?= $requirement['company_requirement_min_percentage'] ; ?></div>
                                                        <span class="input-group-text ">%</span>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <label for="cgpa" class="form-control-label">CGPA</label>
                                                    <div class="input-group mb-3">
                                                        <div class="form-control " name="cgpa" id="cgpa"><?= $requirement['company_requirement_min_cgpa'] ; ?></div>
                                                        <span class="input-group-text ">%</span>
                                                    </div>                                                
                                                </div>
                                                <div class="col-sm-4">
                                                    <label for="percentage_12" class="form-control-label">12<sup>th</sup> Percentage</label>
                                                    <div class="input-group mb-3">
                                                        <div class="form-control" name="percentage_12" id="percentage_12"><?= $requirement['company_requirement_min_percentage_12th'] ; ?></div>
                                                        <span class="input-group-text">%</span>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-sm-5">
                                                    <label for="salary" class="form-control-label">Min Salary</label>
                                                    <div class="input-group">
                                                        <div name="salary" id="salary" class="form-control "><?= $requirement['company_requirement_min_salary'] ; ?></div>
                                                        <span class="input-group-text">/-</span>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <label for="vacancy" class="form-control-label">Vacancy</label>
                                                    <div class="form-control mb-3" name="vacancy" id="vacancy"><?= $requirement['company_requirement_vacancy'] ;?></div>
                                                </div>

                                                <div class="col-sm-5">
                                                    <label for="date_last" class="form-control-label">Last Date</label>
                                                    <div class="form-control mb-3" name="date_last" id="date_last<?= $j;?>"><?= date('d-m-Y h:i A', strtotime($requirement['company_requirement_last_date'])) ;?></div>
                                                </div>
                                            </div>
                                            
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label for="date_exam" class="form-control-label">Exam Date-Time</label>
                                                        <div class="form-control" name="date_exam" id="date_exam<?= $j;?>"><?= date('d-m-Y h:i A', strtotime($requirement['company_requirement_exam_date'])) ;?></div>
                                                    </div>
                                                </div>
                                                
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label for="date_interview" class="form-control-label">Interview Date-Time</label>
                                                        <div class="form-control" name="date_interview" id="date_interview<?= $j++;?>"><?= date('d-m-Y h:i A', strtotime($requirement['company_requirement_interview_date'])) ;?></div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        <?php } } ?>

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


</body>
</html>
