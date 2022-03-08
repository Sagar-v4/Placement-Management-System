<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>View Requirements</title>
    
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
    <nav class="main-header navbar navbar-top fixed-top navbar-expand navbar-dark bg-info border-bottom">
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
                        <a href="<?= base_url().'company/view/index';?>" class="nav-link pt-2 pb-2 rounded active">
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

    <div class="content-wrapper mt-5" >
        <span class=" position-fixed pb-6 bg-info " style="top:0px ; height:55%; width: 100%;">
        </span>


        <div class="row col-12 pt-2" style="margin-left:0px; margin-top: 90px;">

            <?php
                if ( !empty($this->session->flashdata('updateRFMsg')) ) {
                echo "
                    <div class='alert alert-danger col-12 alert-dismissible fade show' role='alert'>
                    <span class='alert-icon'><i class='fas fa-ban'></i></span>
                    <span class='alert-text'>".$this->session->flashdata('updateRFMsg')."</span>
                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                    <span aria-hidden='true'>&times;</span>
                    </button>
                    </div>";
                }

                if ( !empty($this->session->flashdata('updateRSMsg')) ) {
                    echo "
                    <div class='alert alert-success col-12 alert-dismissible fade show' role='alert'>
                    <span class='alert-icon'><i class='fas fa-check'></i></span>
                    <span class='alert-text'>".$this->session->flashdata('updateRSMsg')."</span>
                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                    <span aria-hidden='true'>&times;</span>
                    </button>
                    </div>";
                }           
            ?>

            <?php if ( !empty($requirements) ) { $i = 0; rsort($requirements); foreach ($requirements as $requirement) { ?>
            
                <div class="col-xl-3 col-lg-4 col-md-4 col-sm-6">
                    <div class="card ">
                        <div class="card-header example" style="max-height: 100px; overflow:auto;">
                            <div class="row align-items-center">
                                <div class="col-12">
                                    <h4 class="mb-0"><?= $requirement['company_requirement_name'] ;?></h4>
                                </div>
                                <div class="col-12">
                                    <h5 class="mb-0"><?= $requirement['company_requirement_post'] ;?> - <span class="card-text"><?= $requirement['company_requirement_vacancy'] ;?></span></h5>
                                </div>
                            </div>
                        </div>
                        <div class="card-body example" style="max-height:150px; overflow:auto; ">
                            <p class=" card-text mb-0">Min Salary : <?= $requirement['company_requirement_min_salary'] ;?></p>
                            <p class=" card-text mb-0">Last Date : <?= date('d-m-Y',strtotime($requirement['company_requirement_last_date'])) ;?></p>
                        </div>
                        <div class="row card-body">
                            <div class="col-6 text-left">
                                <button type="button" class="col-11 btn btn-sm <?= ($requirement['company_requirement_status'] == 1) ? 'btn-primary' : 'btn-default' ;?> " data-toggle="modal" data-target="#modal-requirement<?= $i++;?>">Edit</button>
                            </div>
                            <div class="col-6 text-right"> 
                                <a href="<?= base_url().'company/view/studentApplied/'.$requirement['company_requirement_id'].'/'.$requirement['company_id'] ;?>" target="_blank" class="col-11 btn btn-outline-primary btn-sm">View</a>
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
                                        <h6 class="heading-small text-muted mb-4">Requirement information</h6>
                                        <form action="<?= base_url().'company/view/requirementUpdate/'.$requirement['company_requirement_id'] ; ?>" name="registrationForm" id="registrationForm" method="POST" role="form text-left" autocomplete="off">
                                            <div class="pl-lg-4">

                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <label for="requirement_name" class="form-control-label">Requirement Name <span class="text-danger">*</span></label>
                                                        <div class="mb-3">
                                                            <input type="text" required value="<?= $requirement['company_requirement_name'] ; ?>" name="requirement_name" id="requirement_name" class="form-control " placeholder="Requirement name">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <label for="post" class="form-control-label">Requirement Post <span class="text-danger">*</span></label>
                                                        <div class="mb-3">
                                                            <input type="text" required value="<?= $requirement['company_requirement_post'] ; ?>" name="post" id="post" class="form-control " placeholder="Requirement Post">
                                                        </div>
                                                    </div>
                                                </div>

                                                <label for="description" class="form-control-label">Requirement Description <span class="text-danger">*</span></label>
                                                <div class="mb-3">
                                                    <textarea type="text" required name="description" rows="3" id="description" class="form-control example" placeholder="Company Description"><?= $requirement['company_requirement_description'] ; ?></textarea>
                                                </div>

                                                <div class="row">
                                                    <div class="col-sm-4">
                                                        <label for="percentage" class="form-control-label">Percentage  <span class="text-danger">*</span></label>
                                                        <div class="input-group mb-3">
                                                            <input type="number" required class="form-control " step="0.01" min="33" max="100" onKeyPress="if(this.value.length==5) return false;" value="<?= $requirement['company_requirement_min_percentage'] ; ?>" name="percentage" id="percentage" placeholder="Min Percentage">
                                                            <span class="input-group-text ">%</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <label for="cgpa" class="form-control-label">CGPA <span class="text-danger">*</span></label>
                                                        <div class="input-group mb-3">
                                                            <input type="number" required class="form-control " step="0.01" min="3" max="10" onKeyPress="if(this.value.length==4) return false;" value="<?= $requirement['company_requirement_min_cgpa'] ; ?>" name="cgpa" id="cgpa" placeholder="Min CGPA">
                                                            <span class="input-group-text ">%</span>
                                                        </div>                                                
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <label for="percentage_12" class="form-control-label">12<sup>th</sup> Percentage <span class="text-danger">*</span></label>
                                                        <div class="input-group mb-3">
                                                            <input type="number" required class="form-control" step="0.01" min="33" max="100" onKeyPress="if(this.value.length==5) return false;" value="<?= $requirement['company_requirement_min_percentage_12th'] ; ?>" name="percentage_12" id="percentage_12" placeholder="Min 12th Percentage">
                                                            <span class="input-group-text">%</span>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-sm-5">
                                                        <label for="salary" class="form-control-label">Min Salary <span class="text-danger">*</span></label>
                                                        <div class="input-group">
                                                            <input type="number" required value="<?= $requirement['company_requirement_min_salary'] ; ?>" name="salary" id="salary" class="form-control " placeholder="Min Salary">
                                                            <span class="input-group-text">/-</span>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="col-sm-2">
                                                        <label for="vacancy" class="form-control-label">Vacancy <span class="text-danger">*</span></label>
                                                        <input type="number" required class="form-control mb-3" min="1" max="1000" onKeyPress="if(this.value.length==4) return false;" value="<?= $requirement['company_requirement_vacancy'] ;?>" name="vacancy" id="vacancy">
                                                    </div>

                                                    <div class="col-sm-5">
                                                        <label for="date_last" class="form-control-label">Last Date <span class="text-danger">*</span></label>
                                                        <input type="date" required class="form-control mb-3" value="<?= $requirement['company_requirement_last_date'] ;?>" name="date_last" id="date_last<?= $j;?>">
                                                    </div>
                                                </div>
                                                
                                                <div class="row">
                                                    <div class="col-sm-3">
                                                        <div class="form-group">
                                                            <label for="date_exam" class="form-control-label">Exam Date-Time <span class="text-danger">*</span></label>
                                                            <input type="datetime-local" required class="form-control date  mb-3" value="<?= date('Y-m-d\TH:i', strtotime($requirement['company_requirement_exam_date'])) ;?>" name="date_exam" id="date_exam<?= $j;?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <div class="form-group">
                                                            <label for="date_exam_end" class="form-control-label">Exam End <span class="text-danger">*</span></label>
                                                            <input type="datetime-local" required class="form-control date  mb-3" value="<?= date('Y-m-d\TH:i', strtotime($requirement['company_requirement_exam_date_end'])) ;?>" name="date_exam_end" id="date_exam_end<?= $j;?>">
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="col-sm-3">
                                                        <div class="form-group">
                                                            <label for="date_interview" class="form-control-label">Interview Date-Time <span class="text-danger">*</span></label>
                                                            <input type="datetime-local" required class="form-control date  mb-3" value="<?= date('Y-m-d\TH:i', strtotime($requirement['company_requirement_interview_date'])) ;?>" name="date_interview" id="date_interview<?= $j;?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <div class="form-group">
                                                            <label for="date_interview_end" class="form-control-label">Interview End <span class="text-danger">*</span></label>
                                                            <input type="datetime-local" required class="form-control date  mb-3" value="<?= date('Y-m-d\TH:i', strtotime($requirement['company_requirement_interview_date_end'])) ;?>" name="date_interview_end" id="date_interview_end<?= $j;?>">
                                                        </div>
                                                    </div>
                                                </div>

                                                <script type="text/javascript">
                                                    var today = new Date();
                                                    var dd = today.getDate();
                                                    var mm = today.getMonth()+1; //January is 0!
                                                    var yyyy = today.getFullYear();
                                                    var h = today.getHours();
                                                    var m = today.getMinutes();
                                                    var s = today.getSeconds();

                                                    if(dd<10){
                                                            dd='0'+dd
                                                        } 
                                                        if(mm<10){
                                                            mm='0'+mm
                                                        } 

                                                    max = yyyy+1+'-'+mm+'-'+dd+'T23:59';
                                                    min = yyyy+'-'+mm+'-'+dd+'T23:59';

                                                    maxtime = yyyy+1+'-'+mm+'-'+dd;
                                                    mintime = yyyy+'-'+mm+'-'+dd;
                                                    
                                                    document.getElementById("date_last<?= $j;?>").setAttribute("max", maxtime);
                                                    document.getElementById("date_last<?= $j;?>").setAttribute("min", mintime);
                                                    document.getElementById("date_exam<?= $j;?>").setAttribute("max", max);
                                                    document.getElementById("date_exam<?= $j;?>").setAttribute("min", min);
                                                    document.getElementById("date_interview<?= $j;?>").setAttribute("max", max);
                                                    document.getElementById("date_interview<?= $j;?>").setAttribute("min", min);
                                                    document.getElementById("date_exam_end<?= $j;?>").setAttribute("max", max);
                                                    document.getElementById("date_exam_end<?= $j;?>").setAttribute("min", min);
                                                    document.getElementById("date_interview_end<?= $j;?>").setAttribute("max", max);
                                                    document.getElementById("date_interview_end<?= $j;?>").setAttribute("min", min);
                                                </script>
                                                
                                                <div class="row">
                                                    <div class="col-5 text-left">
                                                        <input type="submit" id="submit<?= $j;?>" name="submit" class="btn bg-primary w-20 mb-2 text-white">
                                                    </div>

                                                    <div class="col-7 text-right">
                                                        <a href="<?= base_url().'company/view/activation/'.$requirement['company_requirement_id'] ; ?>" type="button" class="btn bg-default w-20 mb-2 text-white"><?= ($requirement['company_requirement_status'] == 1) ? 'Deactivate' : 'Activate' ;?></a>
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

  <footer class="main-footer ">
    <div class="float-right d-none d-sm-block">
      <b>Version</b>1.0.0
    </div>
    <strong>Copyright &copy; 2021-2022 <a href="#">Sagar Variya Production</a>.</strong> All rights reserved.
  </footer>

</div>

<script src="<?= base_url("public/admin/");?>plugins/jquery/jquery.min.js"></script>
<script src="<?= base_url("public/admin/");?>plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<script src="<?= base_url("public/admin/");?>dist/js/adminlte.minSC.js"></script>
<script src="<?= base_url("public/stu-com/");?>assets/vendor/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<script src="<?= base_url("public/stu-com/");?>assets/vendor/jquery/dist/jquery.min.js"></script>
<script src="<?= base_url("public/stu-com/");?>assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<script src="<?= base_url("public/stu-com/");?>assets/vendor/js-cookie/js.cookie.js"></script>
<script src="<?= base_url("public/stu-com/");?>assets/vendor/jquery.scrollbar/jquery.scrollbar.min.js"></script>
<script src="<?= base_url("public/stu-com/");?>assets/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js"></script>
<script src="<?= base_url("public/stu-com/");?>assets/js/argon.js?v=1.2.0"></script>


</body>
</html>
