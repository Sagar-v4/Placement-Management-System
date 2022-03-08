<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>New Requirement</title>
    
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

                                <!-- View all -->
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
                                <h6 class="text-overflow m-0"><?= $userInfo['name'];?></h6>
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
                        <a href="<?= base_url().'company/new_requirement/index';?>" class="nav-link pt-2 pb-2 rounded active">
                            <i class="nav-icon ni ni-fat-add text-info"></i>
                            <span class="nav-link-text">New</span>
                        </a>
                    </li>

                    <li class="nav-header m-2" >OTHERS</li>
                    
                    <li class="nav-item mt-1 mb-1">
                        <a href="<?= base_url().'company/changepassword/index';?>" class="nav-link pt-2 pb-2 rounded ">
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
    <div class=" position-fixed pb-6 bg-info " style="top:0px ; height:55%; width: 100%;">
    </div>
    
            <div class="row col-12 pt-2" style="margin-left:0px; margin-top: 90px;">
                <div class="col-md-12">
                    <div class="card " >
                    <div class="card-header bg-primary">
                        <span class="card-title text-white mb-0">New Requirement</span>
                    </div>
                        <form action="<?= base_url().'company/new_requirement/new_requirement' ; ?>" name="newRequirementForm" id="newRequirementForm" method="POST" autocomplete="off">
                            <div class="card-body">

                                <?php
                                    if ( !empty($this->session->flashdata('newReqFMsg')) ) {
                                    echo "
                                        <div class='alert alert-danger alert-dismissible fade show' role='alert'>
                                        <span class='alert-icon'><i class='fas fa-ban'></i></span>
                                        <span class='alert-text'>".$this->session->flashdata('newReqFMsg')."</span>
                                        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                        <span aria-hidden='true'>&times;</span>
                                        </button>
                                        </div>";
                                    }

                                    if ( !empty($this->session->flashdata('newReqSMsg')) ) {
                                        echo "
                                        <div class='alert alert-success alert-dismissible fade show' role='alert'>
                                        <span class='alert-icon'><i class='fas fa-check'></i></span>
                                        <span class='alert-text'>".$this->session->flashdata('newReqSMsg')."</span>
                                        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                        <span aria-hidden='true'>&times;</span>
                                        </button>
                                        </div>";
                                    }           
                                ?>

                                    <div class="form-group">
                                        <label for="name" >Company Name <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control <?= form_error('name') ? 'is-invalid' : '';?>" value="<?= (empty(set_value('name'))) ? $userInfo['name'] : set_value('name') ; ?>" name="name" id="name" placeholder="name" disabled>
                                    </div>

                                    <div class="form-group">
                                        <label for="requirement_name">Requirement Name <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control <?= form_error('requirement_name') ? 'is-invalid' : '';?>" value="<?= set_value('requirement_name') ;?>" name="requirement_name" id="requirement_name" placeholder="Requirement Name">
                                    </div>

                                    <div class="form-group">
                                        <label for="description">Requirement Description <span class="text-danger">*</span></label>
                                        <textarea type="text" class="form-control <?= form_error('description') ? 'is-invalid' : '';?>" rows="5" name="description" id="description" placeholder="Description"><?= set_value('description') ;?></textarea>
                                    </div>

                                    <div class="form-group">
                                        <label for="post">Requirement Post <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control <?= form_error('post') ? 'is-invalid' : '';?>" value="<?= set_value('post') ;?>" name="post" id="post" placeholder="Post Name">
                                    </div> 
                                    
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label for="percentage">Percentage <span class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <input type="number" class="form-control <?= form_error('percentage') ? 'is-invalid' : '';?>" step="0.01" min="33" max="100" onKeyPress="if(this.value.length==5) return false;" value="<?= set_value('percentage') ;?>" name="percentage" id="percentage" placeholder="Min Percentage">
                                                    <span class="input-group-text <?= form_error('percentage') ? 'border-danger' : '';?>">%</span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label for="cgpa">CGPA <span class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <input type="number" class="form-control <?= form_error('cgpa') ? 'is-invalid' : '';?>" step="0.01" min="3" max="10" onKeyPress="if(this.value.length==4) return false;" value="<?= set_value('cgpa') ;?>" name="cgpa" id="cgpa" placeholder="Min CGPA">
                                                    <span class="input-group-text <?= form_error('cgpa') ? 'border-danger' : '';?>">%</span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label for="percentage_12">12<sup>th</sup> Percentage <span class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <input type="number" class="form-control <?= form_error('percentage_12') ? 'is-invalid' : '';?>" step="0.01" min="33" max="100" onKeyPress="if(this.value.length==5) return false;" value="<?= set_value('percentage_12') ;?>" name="percentage_12" id="percentage_12" placeholder="Min 12th Percentage">
                                                    <span class="input-group-text <?= form_error('percentage_12') ? 'border-danger' : '';?>">%</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-5">
                                            <div class="form-group">
                                                <label for="salary">Min Salary <span class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <input type="number" class="form-control <?= form_error('salary') ? 'is-invalid' : '';?>" value="<?= set_value('salary') ;?>" step="500" min="0" max="" onKeyPress="if(this.value.length==7) return false;" name="salary" id="salary" placeholder="Min Salary">
                                                    <span class="input-group-text <?= form_error('salary') ? 'border-danger' : '';?>">/-</span>
                                                </div>
                                            </div> 
                                        </div> 
                                        
                                        <div class="col-sm-2">
                                            <div class="form-group">
                                                <label for="salary">Vacancy <span class="text-danger">*</span></label>
                                                <input type="number" class="form-control <?= form_error('vacancy') ? 'is-invalid' : '';?>" value="<?= set_value('vacancy') ;?>" min="1" max="1000" onKeyPress="if(this.value.length==4) return false;" name="vacancy" id="vacancy" placeholder="Vacancy">
                                            </div> 
                                        </div> 
                                        
                                        <div class="col-sm-5">
                                            <div class="form-group">
                                                <label for="salary">Last Date <span class="text-danger">*</span></label>
                                                <input type="date" class="form-control <?= form_error('date_last') ? 'is-invalid' : '';?>" value="<?= set_value('date_last') ;?>" name="date_last" id="date_last" placeholder="Last Date">
                                            </div> 
                                        </div> 
                                    </div> 

                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="date_exam">Exam Date-Time(Expected) <span class="text-danger">*</span></label>
                                                <input type="datetime-local" class="form-control <?= form_error('date_exam') ? 'is-invalid' : '';?>" value="<?= set_value('date_exam') ;?>" name="date_exam" id="date_exam">
                                            </div>
                                        </div>

                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="date_interview">Interview Date-Time(Expected) <span class="text-danger">*</span></label>
                                                <input type="datetime-local" class="form-control <?= form_error('date_interview') ? 'is-invalid' : '';?>" value="<?= set_value('date_interview') ;?>" name="date_interview" id="date_interview">
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="date_exam_end">Exam End(Expected) <span class="text-danger">*</span></label>
                                                <input type="datetime-local" class="form-control <?= form_error('date_exam_end') ? 'is-invalid' : '';?>" value="<?= set_value('date_exam_end') ;?>" name="date_exam_end" id="date_exam_end">
                                            </div>
                                        </div>

                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="date_interview_end">Interview End(Expected) <span class="text-danger">*</span></label>
                                                <input type="datetime-local" class="form-control <?= form_error('date_interview_end') ? 'is-invalid' : '';?>" value="<?= set_value('date_interview_end') ;?>" name="date_interview_end" id="date_interview_end">
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

                                        document.getElementById("date_last").setAttribute("max", maxtime);
                                        document.getElementById("date_last").setAttribute("min", mintime);
                                        document.getElementById("date_exam").setAttribute("max", max);
                                        document.getElementById("date_exam").setAttribute("min", min);
                                        document.getElementById("date_exam_end").setAttribute("max", max);
                                        document.getElementById("date_exam_end").setAttribute("min", min);
                                        document.getElementById("date_interview").setAttribute("max", max);
                                        document.getElementById("date_interview").setAttribute("min", min);
                                        document.getElementById("date_interview_end").setAttribute("max", max);
                                        document.getElementById("date_interview_end").setAttribute("min", min);
                                    </script>
                                    </div>

                                <div class="card-footer">
                                    <input type="submit" class="btn text-white bg-primary" id="submit" name="New Requirement" >
                                </div>

                            </div>
                        </form>
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
