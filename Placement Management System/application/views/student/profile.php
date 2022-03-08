<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $userInfo['fname']." ".$userInfo['lname'] ;?></title>
    
    <meta name="author" content="Sagar Variya">
    
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
    <nav class="main-header navbar navbar-top fixed-top navbar-expand navbar-dark bg-default border-bottom">
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
                                                <i class="<?= $notification['student_notification_class']; ?> px-1 " style="transform: scale(1.5, 1.5);"></i>
                                            </div>
                                            <div class="col ml--2">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <div class="text-right text-muted">
                                                        <small><?= $notification['time']?></small>
                                                    </div>
                                                </div>
                                                <p class="text-sm mb-0"><?= $notification['student_notification_detail']?></p>
                                            </div>
                                        </div>
                                    </a>

                                <?php $i++; if ( $i >= 3) break; } } else { ?>
                                    <div class="text-center"><h4>You Have No Notifications.</h4></div>
                                <?php } ?>

                                <a href="<?= base_url().'student/notifications/index';?>" class="dropdown-item text-center text-primary font-weight-bold py-3">View all</a>
                            </div>
                        </div>
                    </li>
                </ul>
                <ul class="navbar-nav align-items-center  ml-auto ml-md-0 ">
                    <li class="nav-item dropdown">
                        <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <div class="media align-items-center">
                                <span class="avatar avatar-sm rounded-circle">
                                    <img alt="Image placeholder" src="<?= base_url().$userInfo['profile_thumb'] ;?>">
                                </span>
                                <div class="media-body  ml-2  d-none d-lg-block">
                                    <span class="mb-0 text-sm  font-weight-bold"><?= $userInfo['fname']." ".$userInfo['lname'] ;?></span>
                                </div>
                            </div>
                        </a>
                        <div class="dropdown-menu  dropdown-menu-right ">
                            <div class="dropdown-header noti-title">
                                <h6 class="text-overflow m-0"><?= $userInfo['fname']." ".$userInfo['lname'] ;?></h6>
                            </div>
                            <a href="<?= base_url().'home/home/index'; ?>" class="dropdown-item">
                                <i class="ni ni-world"></i>
                                <span>Home</span>
                            </a>
                            <a href="<?= base_url().'student/profile/index';?>" class="dropdown-item">
                                <i class="ni ni-single-02"></i>
                                <span>My profile</span>
                            </a>
                            <a href="<?= base_url().'student/changepassword/index';?>" class="dropdown-item">
                                <i class="ni ni-lock-circle-open"></i>
                                <span>Change Password</span>
                            </a>
                                <div class="dropdown-divider"></div>
                            <a href="<?= base_url().'login/login/logout/student';?>" class="dropdown-item">
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
                                <a href="<?= base_url().'student/home/index';?>" class="nav-link pt-2 pb-2 rounded ">
                                    <i class="nav-icon ni ni-tv-2 text-primary"></i>
                                    <span class="nav-link-text">Dashboard</span>
                                </a>
                            </li>
                            <li class="nav-item mt-1 mb-1">
                                <a href="<?= base_url().'student/profile/index';?>" class="nav-link pt-2 pb-2 rounded active">
                                    <i class="nav-icon fas fa-user-graduate text-default "></i>
                                    <span class="nav-link-text">Profile</span>
                                </a>
                            </li>
                            <li class="nav-item mt-1 mb-1">
                                <a href="<?= base_url().'student/notifications/index';?>" class="nav-link pt-2 pb-2 rounded">
                                    <i class="nav-icon fas fa-bell text-orange"></i>
                                    <span class="nav-link-text">Notifications</span>
                                </a>
                            </li> 
                            <li class="nav-item mt-1 mb-1">
                                <a href="<?= base_url().'student/applied/index';?>" class="nav-link pt-2 pb-2 rounded">
                                    <i class="nav-icon fas fa-tasks text-info"></i>
                                    <span class="nav-link-text">Applied</span>
                                </a>
                            </li> 

                            <li class="nav-header m-2" >OTHERS</li>
                            
                            <li class="nav-item mt-1 mb-1">
                                <a href="<?= base_url().'student/changepassword/index';?>" class="nav-link pt-2 pb-2 rounded">
                                    <i class="nav-icon fas fa-fingerprint text-success"></i>
                                    <span class="nav-link-text">Change Password</span>
                                </a>
                            </li> 
                            <li class="nav-item mt-1 mb-1">
                                <a href="<?= base_url().'login/login/logout/student';?>" class="nav-link pt-2 pb-2 rounded">
                                    <i class="nav-icon fas fa-sign-out-alt text-danger"></i>
                                    <span class="nav-link-text">SIGN OUT</span>
                                </a>
                            </li> 
                        </ul>
                    </div>
        </div>
    </nav>

    <div class="content-wrapper mt-5" >
        <div class=" position-fixed pb-6 bg-default " style="top:0px ; height:55%; width: 100%;">
        </div>
        <div class="row col-12 pt-2" style="margin-left:0px; margin-top: 90px;">  
        
                        <?php
                            if ( !empty($this->session->flashdata('ProMsg')) ) {
                            echo "
                                <div class='alert col-12 alert-info alert-dismissible fade show' role='alert'>
                                <span class='alert-icon'><i class='fas fa-info'></i></span>
                                <span class='alert-text'>".$this->session->flashdata('ProMsg')."</span>
                                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                <span aria-hidden='true'>&times;</span>
                                </button>
                                </div>";
                            }
          
                        ?>
            
            <div class="col-xl-4 order-xl-2">
                        <?php
                            if ( !empty($this->session->flashdata('updatePPFMsg')) ) {
                            echo "
                                <div class='alert alert-danger alert-dismissible fade show' role='alert'>
                                <span class='alert-icon'>Profile Picture</span>
                                <span class='alert-text'>".$this->session->flashdata('updatePPFMsg')."</span>
                                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                <span aria-hidden='true'>&times;</span>
                                </button>
                                </div>";
                            } 
                            if ( !empty($this->session->flashdata('updateCPFMsg')) ) {
                            echo "
                                <div class='alert alert-danger alert-dismissible fade show' role='alert'>
                                <span class='alert-icon'>Cover Picture</span>
                                <span class='alert-text'>".$this->session->flashdata('updateCPFMsg')."</span>
                                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                <span aria-hidden='true'>&times;</span>
                                </button>
                                </div>";
                            } 
                            if ( !empty($this->session->flashdata('updatePPSMsg')) ) {
                            echo "
                                <div class='alert alert-success alert-dismissible fade show' role='alert'>
                                <span class='alert-icon'>Profile Picture</span>
                                <span class='alert-text'>".$this->session->flashdata('updatePPSMsg')."</span>
                                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                <span aria-hidden='true'>&times;</span>
                                </button>
                                </div>";
                            } 
                            if ( !empty($this->session->flashdata('updateCPSMsg')) ) {
                            echo "
                                <div class='alert alert-success alert-dismissible fade show' role='alert'>
                                <span class='alert-icon'>Cover Picture</span>
                                <span class='alert-text'>".$this->session->flashdata('updateCPSMsg')."</span>
                                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                <span aria-hidden='true'>&times;</span>
                                </button>
                                </div>";
                            }         
                        ?>
                <div class="card card-profile">
                    <img src="<?= base_url().$userInfo['cover'];?>" data-toggle="modal" data-target="#modal-form-cover-pic" alt="Image placeholder" class="card-img-top">

                        <div class="col-md-4">
                            <div class="modal fade" id="modal-form-profile-pic" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
                                <div class="modal-dialog modal- modal-dialog-centered modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-body p-0">
                                            <div class="card bg-secondary border-0 mb-0">
                                                <div class="card-body px-lg-5 py-lg-5">

                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                    
                                                    <?= form_open_multipart(base_url().'student/profile/proUpdate'); ?>

                                                        <img src="<?= base_url().$userInfo['profile'] ;?>" width="300" style="z-index:1;" class="img-center">

                                                        <div class="custom-file m-3 text-default">
                                                            <label for="proPic" class=" text-default"><h3>Profile Picture : (Square Recommend)</h3></label>
                                                            <input type="file" name="proPic" accept=".gif, .jpg, .jpeg, .png" class="custom-file-input" id="proPic">
                                                        </div>

                                                        <div class="row" style="margin-top:10px;">
                                                            <div class="col-6 text-left text-default">
                                                                <input type="submit" id="submit" name="pictureUpdate" class="btn btn-primary w-20 mb-2 text-white">
                                                            </div>    
                                                            <div class="col-6 text-right text-default">
                                                                <a href="<?= base_url().'student/profile/proRemove'?>" name="pictureUpdate" class="btn btn-default w-20 mb-2 text-white">Remove</a>
                                                            </div>      
                                                        </div>                                                     

                                                    </form>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal fade" id="modal-form-cover-pic" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
                                <div class="modal-dialog modal- modal-dialog-centered modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-body p-0">
                                            <div class="card bg-secondary border-0 mb-0">
                                                <div class="card-body px-lg-5 py-lg-5">

                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                    
                                                    <?= form_open_multipart(base_url().'student/profile/covUpdate'); ?>

                                                        <img src="<?= base_url().$userInfo['cover'] ;?>" width="300" style="z-index:1;" class="img-center">

                                                        <div class="custom-file m-3 text-default">
                                                            <label for="coverPic" class=" text-default"><h3>Cover Picture :</h3></label>
                                                            <input type="file" name="coverPic" accept=".gif, .jpg, .jpeg, .png" class="custom-file-input" id="coverPic">
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-6 text-left text-default">
                                                                <input type="submit" id="submit" name="pictureUpdate" class="btn btn-primary w-20 mb-2 text-white">
                                                            </div>    
                                                            <div class="col-6 text-right text-default">
                                                                <a href="<?= base_url().'student/profile/covRemove'?>" name="pictureUpdate" class="btn btn-default w-20 mb-2 text-white">Remove</a>
                                                            </div>      
                                                        </div>                                                  

                                                    </form>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    
                    <div class="row justify-content-center">
                        <div class="col-lg-4 order-lg-2">
                            <div class="card-profile-image">
                                <img src="<?= base_url().$userInfo['profile'] ;?>" data-toggle="modal" data-target="#modal-form-profile-pic" height="100" width="100" style="z-index:1;" class="rounded-circle">
                            </div>
                        </div>
                    </div>
                    <div class="card-header text-center border-0 pt-6 pt-md-6 pb-0 pb-md-0 ">
                        <div class="d-flex justify-content-center">
                            <h2><?= $userInfo['fname']." ".$userInfo['mname']." ".$userInfo['lname'] ;?></h2>
                        </div>
                    </div>
                    <div class="card-body pt-0">
                        <div class="row">
                            <div class="col">
                                <div class="card-profile-stats  justify-content-center">
                                    <div>
                                        <span class="heading">Gender</span>
                                        <span class="description"><?= $userInfo['gender'] ?></span>
                                    </div>
                                    <div>
                                        <span class="heading">E-mail</span>
                                        <span class="description"><?= $userInfo['email'] ?></span>
                                    </div>
                                    <div>
                                        <span class="heading">Mobile Number</span>
                                        <span class="description"><?= $userInfo['mobile'] ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php if(!empty($userInfo['district']) && !empty($userInfo['state']) ) { ?>
                            <div class="text-center">
                                <div class="h5 font-weight-300">
                                    <i class="ni location_pin mr-2"></i><?= $userInfo['district'].", ".$userInfo['state']; ?>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>

            <div class="col-xl-8 order-xl-1 " >
                
                        <?php
                            if ( !empty($this->session->flashdata('updatePFMsg')) ) {
                            echo "
                                <div class='alert alert-danger alert-dismissible fade show' role='alert'>
                                <span class='alert-icon'><i class='fas fa-ban'></i></span>
                                <span class='alert-text'>User information<br>".$this->session->flashdata('updatePFMsg')."</span>
                                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                <span aria-hidden='true'>&times;</span>
                                </button>
                                </div>";
                            }

                            if ( !empty($this->session->flashdata('updatePSMsg')) ) {
                                echo "
                                <div class='alert alert-success alert-dismissible fade show' role='alert'>
                                <span class='alert-icon'><i class='fas fa-check'></i></span>
                                <span class='alert-text'>User information<br>".$this->session->flashdata('updatePSMsg')."</span>
                                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                <span aria-hidden='true'>&times;</span>
                                </button>
                                </div>";
                            }           
                        ?>
                
                        <?php
                            if ( !empty($this->session->flashdata('updateCFMsg')) ) {
                            echo "
                                <div class='alert alert-danger alert-dismissible fade show' role='alert'>
                                <span class='alert-icon'><i class='fas fa-ban'></i></span>
                                <span class='alert-text'>Contact<br>".$this->session->flashdata('updateCFMsg')."</span>
                                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                <span aria-hidden='true'>&times;</span>
                                </button>
                                </div>";
                            }

                            if ( !empty($this->session->flashdata('updateCSMsg')) ) {
                                echo "
                                <div class='alert alert-success alert-dismissible fade show' role='alert'>
                                <span class='alert-icon'><i class='fas fa-check'></i></span>
                                <span class='alert-text'>Contact<br>".$this->session->flashdata('updateCSMsg')."</span>
                                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                <span aria-hidden='true'>&times;</span>
                                </button>
                                </div>";
                            }           
                        ?>
                        
                        <?php
                            if ( !empty($this->session->flashdata('updateAFMsg')) ) {
                            echo "
                                <div class='alert alert-danger alert-dismissible fade show' role='alert'>
                                <span class='alert-icon'><i class='fas fa-ban'></i></span>
                                <span class='alert-text'>Address<br>".$this->session->flashdata('updateAFMsg')."</span>
                                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                <span aria-hidden='true'>&times;</span>
                                </button>
                                </div>";
                            }

                            if ( !empty($this->session->flashdata('updateASMsg')) ) {
                                echo "
                                <div class='alert alert-success alert-dismissible fade show' role='alert'>
                                <span class='alert-icon'><i class='fas fa-check'></i></span>
                                <span class='alert-text'>Address<br>".$this->session->flashdata('updateASMsg')."</span>
                                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                <span aria-hidden='true'>&times;</span>
                                </button>
                                </div>";
                            }           
                        ?>
                        
                        <?php
                            if ( !empty($this->session->flashdata('updatePrFMsg')) ) {
                            echo "
                                <div class='alert alert-danger alert-dismissible fade show' role='alert'>
                                <span class='alert-icon'><i class='fas fa-ban'></i></span>
                                <span class='alert-text'>Percentages<br>".$this->session->flashdata('updatePrFMsg')."</span>
                                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                <span aria-hidden='true'>&times;</span>
                                </button>
                                </div>";
                            }

                            if ( !empty($this->session->flashdata('updatePrSMsg')) ) {
                                echo "
                                <div class='alert alert-success alert-dismissible fade show' role='alert'>
                                <span class='alert-icon'><i class='fas fa-check'></i></span>
                                <span class='alert-text'>Percentages<br>".$this->session->flashdata('updatePrSMsg')."</span>
                                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                <span aria-hidden='true'>&times;</span>
                                </button>
                                </div>";
                            }           
                        ?>
                        
                        <?php
                            if ( !empty($this->session->flashdata('updateHdFMsg')) ) {
                            echo "
                                <div class='alert alert-danger alert-dismissible fade show' role='alert'>
                                <span class='alert-icon'><i class='fas fa-ban'></i></span>
                                <span class='alert-text'>Highest Academic Qualifying Degree<br>".$this->session->flashdata('updateHdFMsg')."</span>
                                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                <span aria-hidden='true'>&times;</span>
                                </button>
                                </div>";
                            }

                            if ( !empty($this->session->flashdata('updateHdSMsg')) ) {
                                echo "
                                <div class='alert alert-success alert-dismissible fade show' role='alert'>
                                <span class='alert-icon'><i class='fas fa-check'></i></span>
                                <span class='alert-text'>Highest Academic Qualifying Degree<br>".$this->session->flashdata('updateHdSMsg')."</span>
                                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                <span aria-hidden='true'>&times;</span>
                                </button>
                                </div>";
                            }           
                        ?>
                <div class="card ">
                    <div class="card-header rounded">
                        <div class="row align-items-center">
                            <div class="col-12">
                                <h3 class="mb-0">Profile </h3>
                            </div>                            
                        </div>
                    </div>

                    <div class="card-body" >
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h6 class="heading-small text-muted mb-3">User information</h6>
                            </div>
                            <div class="col-4 text-right">
                                <button type="button" class="btn btn-sm btn-default mb-4" data-toggle="modal" data-target="#modal-form-user">Edit</button>
                            </div>
                        </div>
                        <div class="pl-lg-4">
                            <div class="row">
                                <div class="col-sm-4">
                                    <label >First Name</label>
                                    <div class="mb-3">
                                        <div class="form-control"><?= $userInfo['fname'] ?></div>
                                    </div>
                                </div>
                                
                                <div class="col-sm-4">
                                    <label >Middle Name</label>
                                    <div class="mb-3">
                                        <div class="form-control"><?= $userInfo['mname'] ?></div>
                                    </div>
                                </div>
                                
                                <div class="col-sm-4">
                                    <label >Last Name</label>
                                    <div class="mb-3">
                                        <div class="form-control"><?= $userInfo['lname'] ?></div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-6">
                                    <label class="form-control-label">Gender</label>
                                    <div class="mb-3">
                                        <div class="form-control"><?= $userInfo['gender'] ?></div>
                                    </div>
                                </div>
                                
                                <div class="col-sm-6">
                                    <label for="dob" class="form-control-label">Date Of Birth</label>
                                    <div class="mb-3">
                                        <div class="form-control"><?= date('j F Y', strtotime($userInfo['dob'])) ;?></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr class="my-4" />

                        <div class="row align-items-center">
                            <div class="col-8">
                                <h6 class="heading-small text-muted mb-3">Contact</h6>
                            </div>
                            <div class="col-4 text-right">
                                <button type="button" class="btn btn-sm btn-default mb-4" data-toggle="modal" data-target="#modal-form-contact">Edit</button>
                            </div>
                        </div>
                        <div class="pl-lg-4">

                            <label >Phone Number</label>
                            <div class="mb-3">
                                <div class="form-control" ><?= $userInfo['mobile'];?></div>
                            </div>
                            
                            <div class="row">
                                <div class="col-sm-3">          
                                    <label >STD Code</label>
                                    <div class="mb-3">
                                        <div class="form-control"><?= $userInfo['std'];?></div>
                                    </div>
                                </div>
                                
                                <div class="col-sm-9">          
                                    <label >Telephone Number</label>
                                    <div class="mb-3">
                                        <div class="form-control "  ><?= $userInfo['telephone'];?></div>
                                    </div>
                                </div>
                            </div>
                            
                            <label >Email</label>
                            <div class="mb-3">
                                <div class="form-control"  ><?= $userInfo['email'];?></div>
                            </div>
                        </div> 
                        <hr class="my-4" />

                        <div class="row align-items-center">
                            <div class="col-8">
                                <h6 class="heading-small text-muted mb-3">Address</h6>
                            </div>
                            <div class="col-4 text-right">
                                <button type="button" class="btn btn-sm btn-default mb-4" data-toggle="modal" data-target="#modal-form-address">Edit</button>
                            </div>
                        </div>
                        <div class="pl-lg-4">

                            <label >Address</label>
                            <div class="mb-3">
                                <div class="form-control" ><?= $userInfo['address'] ;?></div>
                            </div>

                            <div class="row">
                                <div class="col-sm-6">
                                    <label >Locality</label>
                                    <div class="mb-3">
                                        <div class="form-control" ><?= $userInfo['locality'] ;?></div>
                                    </div>
                                </div>
                            
                                <div class="col-sm-6">
                                    <label >City / Town / Village</label>
                                    <div class="mb-3">
                                        <div class="form-control" ><?= $userInfo['city'];?></div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-6">
                                    <label >District</label>
                                    <div class="mb-3">
                                        <div class="form-control"><?= $userInfo['district'] ;?></div>
                                    </div>
                                </div>

                                <div class="col-sm-6" >
                                    <label >Pincode</label>
                                    <div class="mb-3">
                                        <div class="form-control" ><?= $userInfo['pincode'] ;?></div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-sm-6">
                                    <label>State</label>
                                    <div class="mb-3">
                                        <div class="form-control" ><?= $userInfo['state'] ;?></div>
                                    </div>
                                </div>
                            
                                <div class="col-sm-6">
                                    <label >Country</label>
                                    <div class="mb-3">
                                        <div class="form-control" ><?= $userInfo['country'] ;?></div>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                        <hr class="my-4" />
                        
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h6 class="heading-small text-muted mb-3">Percentages</h6>
                            </div>
                            <div class="col-4 text-right">
                                <button type="button" class="btn btn-sm btn-default mb-4" data-toggle="modal" data-target="#modal-form-percentages">Edit</button>
                            </div>
                        </div>
                        <div class="pl-lg-4">

                            <div class="row">
                                <div class="col-sm-6" >
                                        <label >10<sup>th</sup> Aggregate Percentage</label>
                                        <div class="input-group mb-3">
                                            <div  class="form-control text-right" ><?= $userInfo['r10'];?></div>
                                            <span class="input-group-text">%</span>
                                        </div>
                                </div>

                                <div class="col-sm-6">
                                        <label >12<sup>th</sup> Aggregate Percentage</label>
                                        <div class="input-group mb-3">
                                            <div class="form-control text-right "  ><?= $userInfo['r12'];?></div>
                                            <span class="input-group-text">%</span>
                                        </div>
                                </div>
                            </div>    

                        </div> 
                        <hr class="my-4" />

                        <div class="row align-items-center">
                            <div class="col-8">
                                <h6 class="heading-small text-muted mb-3">Highest Academic Qualifying Degree</h6>
                            </div>
                            <div class="col-4 text-right">
                                <button type="button" class="btn btn-sm btn-default mb-4" data-toggle="modal" data-target="#modal-form-high-degree">Edit</button>
                            </div>
                        </div>
                        <div class="pl-lg-4">

                            <div class="row">
                                <div class="col-sm-6">
                                    <label>Degree / Diploma</label>
                                    <div class="mb-3">
                                        <div class="form-control" ><?= $userInfo['degree_h'] ;?></div>
                                    </div>
                                </div>
                            
                                <div class="col-sm-6">
                                    <label >Discipline</label>
                                    <div class="mb-3">
                                        <div class="form-control" ><?= $userInfo['discipline_h'] ;?></div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label >University / Institute</label>
                                <div class="mb-3">
                                    <div class="form-control " ><?= $userInfo['university_h'] ;?></div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-sm-6">
                                    <label >City</label>
                                    <div class="mb-3">
                                        <div class="form-control " ><?= $userInfo['city_h'] ;?></div>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <label >State</label>
                                    <div class="mb-3">
                                        <div class="form-control " ><?= $userInfo['state_h'] ;?></div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-6">
                                    <label >Month & Year (Obtained/Expected)</label>
                                    <div class="mb-3">
                                        <div class="form-control "><?= (!empty($userInfo['month_h']) ? date('F Y', strtotime($userInfo['month_h'])) : "") ;?></div>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <label class="form-control-label">Latest Cumulative Percentage / CGPA</label>
                                    <div class="input-group mb-3">
                                        <div class="form-control text-right"><?= (empty($userInfo['percentage_h'])) ? $userInfo['cgpa_h'] : $userInfo['percentage_h'] ;?> </div>
                                        <span class="input-group-text">%</span>
                                    </div>
                                </div>
                            </div>
                        </div> 
                    </div>
                </div>
            </div>

            <div class="modal fade" id="modal-form-user" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
                <div class="modal-dialog modal- modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content ">
                        
                        <div class="modal-body p-0">
                        
                            <div class="card bg-secondary border-0 mb-0">
                                <div class="card-body px-lg-10 py-lg-10">

                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    <h6 class="heading-small text-muted mb-4">User information</h6>
                                    <form action="<?= base_url().'student/profile/personalUpdate'; ?>" name="registrationForm" id="registrationFormPersonal" method="POST" role="form text-left" autocomplete="off">
                                        <div class="pl-lg-4">

                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label for="first_name" class="form-control-label">First Name <span class="text-danger">*</span></label>
                                                        <div class="mb-3">
                                                            <input type="text" value="<?= $userInfo['fname'] ; ?>" name="first_name" id="first_name" class="form-control " placeholder="Your name">
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label for="middle_name" class="form-control-label">Middle Name</label>
                                                        <div class="mb-3">
                                                            <input type="text" value="<?= $userInfo['mname'] ; ?>" name="middle_name" id="middle_name" class="form-control " placeholder="Father's name">
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label for="last_name" class="form-control-label">Last Name <span class="text-danger">*</span></label>
                                                        <div class="mb-3">
                                                            <input type="text" value="<?= $userInfo['lname'] ; ?>" name="last_name" id="last_name" class="form-control " placeholder="Surname">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <div class="form-group">
                                                        <label class="form-control-label ">Gender <span class="text-danger">*</span></label>
                                                    </div>
                                                </div>

                                                <div class="col-sm-3" >
                                                    <div class="form-group">
                                                        <div class="form-check mb-3">
                                                            <input class="form-check-input" <?= ( ($userInfo['gender'] == 'male') ? "checked" : "" ) ;?> type="radio" value="male" name="gender" id="male">
                                                            <label class="form-control-label" for="male">Male</label>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-sm-3">
                                                    <div class="form-group">
                                                        <div class="form-check mb-3">
                                                            <input class="form-check-input" <?= ( ($userInfo['gender'] == 'female') ? "checked" : "" ) ;?> type="radio" value="female" name="gender" id="female">
                                                            <label class="form-control-label" for="female">Female</label>
                                                        </div>                   
                                                    </div>
                                                </div>

                                                <div class="col-sm-3">
                                                    <div class="form-group">
                                                        <div class="form-check mb-3">
                                                            <input class="form-check-input" <?= ( ($userInfo['gender'] == 'other') ? "checked" : "" ) ;?> type="radio" value="other" name="gender" id="other">
                                                            <label class="form-control-label" for="other">Other</label>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                                
                                            <div class="form-group">
                                                <label for="dob" class="form-control-label">Date Of Birth <span class="text-danger">*</span></label>
                                                <div class="mb-3">
                                                    <input class="form-control " value="<?= $userInfo['dob'] ;?>" name="dob" id="dob" type="date"  >
                                                </div>
                                            </div>  
                                            
                                            <script type="text/javascript">
                                                var today = new Date();
                                                var dd = today.getDate();
                                                var mm = today.getMonth()+1; //January is 0!
                                                var yyyy = today.getFullYear();
                                                if(dd<10){
                                                        dd='0'+dd
                                                    } 
                                                    if(mm<10){
                                                        mm='0'+mm
                                                    } 

                                                max = yyyy-20+'-'+mm+'-'+dd;
                                                min = yyyy-50+'-'+mm+'-'+dd;
                                                document.getElementById("dob").setAttribute("max", max);
                                                document.getElementById("dob").setAttribute("min", min);
                                            </script>

                                                <div class="text-left">
                                                    <input type="submit" class="btn bg-default w-20 mb-2 text-white">
                                                </div>
                                        </div>
                                    </form>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            
            <div class="modal fade" id="modal-form-contact" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
                <div class="modal-dialog modal- modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content ">
                        
                        <div class="modal-body p-0">
                        
                            <div class="card bg-secondary border-0 mb-0">
                                <div class="card-body px-lg-10 py-lg-10">

                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    <h6 class="heading-small text-muted mb-4">Contact information</h6>
                                    <form action="<?= base_url().'student/profile/contactUpdate'; ?>" name="registrationForm" id="registrationFormContact" method="POST" role="form text-left" autocomplete="off">
                                        <div class="pl-lg-4">

                                            <div class="form-group">
                                                <label for="phone" class="form-control-label">Phone Number <span class="text-danger">*</span></label>
                                                <div class="mb-3">
                                                    <input class="form-control" value="<?= $userInfo['mobile'] ; ?>" type="number" onKeyPress="if(this.value.length==10) return false;" name="phone"  id="phone" Placeholder="Phone Number" >
                                                </div>
                                            </div>
                                            
                                            <div class="row">
                                                <div class="col-sm-3">          
                                                    <div class="form-group">
                                                        <label for="std" class="form-control-label">STD Code</label>
                                                        <div class="mb-3">
                                                            <input class="form-control" value="<?= $userInfo['std'] ; ?>" type="number" onKeyPress="if(this.value.length==5) return false;" name="std"  id="std" Placeholder="STD Code" >
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <div class="col-sm-9">          
                                                    <div class="form-group">
                                                        <label for="telephone" class="form-control-label">Telephone Number</label>
                                                        <div class="mb-3">
                                                            <input class="form-control " value="<?= $userInfo['telephone'] ; ?>" type="number" onKeyPress="if(this.value.length==8) return false;" name="telephone"  id="telephone" Placeholder="Telephone Number" >
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="form-group">
                                                <label for="email" class="form-control-label">Email <span class="text-danger">*</span></label>
                                                <div class="mb-3">
                                                    <input class="form-control" value="<?= $userInfo['email'] ; ?>" disabled type="email" name="email"  id="email" Placeholder="Email" >
                                                </div>
                                            </div>

                                            <div class="text-left">
                                                <input type="submit" class="btn bg-default w-20 mb-2 text-white">
                                            </div>
                                        </div> 
                                    </form>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            
            <div class="modal fade" id="modal-form-address" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
                <div class="modal-dialog modal- modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content ">
                        
                        <div class="modal-body p-0">
                        
                            <div class="card bg-secondary border-0 mb-0">
                                <div class="card-body px-lg-10 py-lg-10">

                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    <h6 class="heading-small text-muted mb-4">Address information</h6>
                                    <form action="<?= base_url().'student/profile/addressUpdate'; ?>" name="registrationForm" id="registrationFormAddress" method="POST" role="form text-left" autocomplete="off">
                                        <div class="pl-lg-4">

                                            <div class="form-group">
                                                <label for="address" class="form-control-label">Address <span class="text-danger">*</span></label>
                                                <div class="mb-3">
                                                    <textarea class="form-control" name="address" id="address" rows="3"><?= $userInfo['address'] ; ?></textarea>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label for="locality" class="form-control-label">Locality <span class="text-danger">*</span></label>
                                                        <div class="mb-3">
                                                            <input type="text" value="<?= $userInfo['locality'] ; ?>" name="locality" id="locality" class="form-control" placeholder="Locality">
                                                        </div>
                                                    </div>
                                                </div>
                                            
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label for="city" class="form-control-label">City / Town / Village <span class="text-danger">*</span></label>
                                                        <div class="mb-3">
                                                            <input type="text" value="<?=  $userInfo['city'] ; ?>" name="city" id="city" class="form-control" placeholder="City / Town / Village">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label for="district" class="form-control-label">District <span class="text-danger">*</span></label>
                                                        <div class="mb-3">
                                                            <input type="text" value="<?= $userInfo['district'] ; ?>" name="district" id="district" class="form-control" placeholder="District">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-sm-6" >
                                                    <div class="form-group">
                                                        <label for="pincode" class="form-control-label">Pincode <span class="text-danger">*</span></label>
                                                        <div class="mb-3">
                                                            <input type="number" value="<?= $userInfo['pincode'] ; ?>" onKeyPress="if(this.value.length==6) return false;" name="pincode" id="pincode" class="form-control" placeholder="Pincode">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label for="state" class="form-control-label">State <span class="text-danger">*</span></label>
                                                        <select class="form-control" name="state" id="state">
                                                        <option value=" " <?php if($userInfo['state'] == " ") echo "selected";?>>-- select --</option>
                                                        <option value="gujarat"  <?php if($userInfo['state'] == "gujarat") echo "selected"; ?>>Gujarat</option>
                                                        <option value="maharashtra"  <?php if($userInfo['state'] == "maharashtra") echo 'selected'; ?>>Maharashtra</option>
                                                        <option value="madhya pradesh"  <?php if($userInfo['state'] == "madhya pradesh") echo 'selected'; ?>>Madhya pradesh</option>
                                                        <option value="rajashthan"  <?php if($userInfo['state'] == "rajashthan") echo 'selected'; ?>>Rajashthan</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label for="country" class="form-control-label">Country <span class="text-danger">*</span></label>
                                                        <div class="mb-3">
                                                            <input type="text" value="<?= $userInfo['country'] ; ?>" name="country" id="country" class="form-control" placeholder="Country">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="text-left">
                                                    <input type="submit" class="btn bg-default w-20 mb-2 text-white">
                                                </div>
                                        </div>
                                    </form>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            
            <div class="modal fade" id="modal-form-percentages" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
                <div class="modal-dialog modal- modal-dialog-centered modal-md" role="document">
                    <div class="modal-content ">
                        
                        <div class="modal-body p-0">
                        
                            <div class="card bg-secondary border-0 mb-0">
                                <div class="card-body px-lg-10 py-lg-10">

                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    <h6 class="heading-small text-muted mb-4">Percentage</h6>
                                    <form action="<?= base_url().'student/profile/percentageUpdate'; ?>" name="registrationForm" id="registrationFormPercentage" method="POST" role="form text-left" autocomplete="off">
                                        <div class="pl-lg-4">

                                            <div class="form-group">
                                                <label for="std_10" class="form-control-label">10<sup>th</sup> Aggregate Percentage <span class="text-danger">*</span></label>
                                                <div class="input-group mb-3">
                                                    <input type="number" value="<?= $userInfo['r10'] ; ?>" step="0.01" min="33" max="100" onKeyPress="if(this.value.length==5) return false;" name="std_10" id="std_10" class="form-control" placeholder="99.99">
                                                    <span class="input-group-text">%</span>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="std_12" class="form-control-label">12<sup>th</sup> Aggregate Percentage <span class="text-danger">*</span></label>
                                                <div class="input-group mb-3">
                                                    <input type="number" value="<?= $userInfo['r12'] ; ?>" step="0.01"  min="33" max="100" onKeyPress="if(this.value.length==5) return false;" name="std_12" id="std_12" class="form-control " placeholder="99.99" >
                                                    <span class="input-group-text">%</span>
                                                </div>
                                            </div>

                                            <div class="text-left">
                                                <input type="submit" class="btn bg-default w-20 mb-2 text-white">
                                            </div>
                                        </div> 
                                    </form>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            
            <div class="modal fade" id="modal-form-high-degree" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
                <div class="modal-dialog modal- modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content ">
                        
                        <div class="modal-body p-0">
                        
                            <div class="card bg-secondary border-0 mb-0">
                                <div class="card-body px-lg-10 py-lg-10">

                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    <h6 class="heading-small text-muted mb-4">Highest Academic Qualifying Degree</h6>
                                    <form action="<?= base_url().'student/profile/highDegreeUpdate'; ?>" name="registrationForm" id="registrationFormAcademic" method="POST" role="form text-left" autocomplete="off">
                                        <div class="pl-lg-4">

                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label for="high_degree" class="form-control-label">Degree / Diploma <span class="text-danger">*</span></label>
                                                        <div class="mb-3">
                                                            <input type="text" value="<?= $userInfo['degree_h'] ; ?>" name="high_degree" id="high_degree" class="form-control " placeholder="Degree / Diploma">
                                                        </div>
                                                    </div>
                                                </div>
                                            
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label for="high_discipline" class="form-control-label">Discipline <span class="text-danger">*</span></label>
                                                        <div class="mb-3">
                                                            <input type="text" value="<?= $userInfo['discipline_h'] ; ?>" name="high_discipline" id="high_discipline" class="form-control " placeholder="Discipline">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="form-group">
                                                <label for="high_university" class="form-control-label">University / Institute <span class="text-danger">*</span></label>
                                                <div class="mb-3">
                                                    <input type="text" value="<?= $userInfo['university_h'] ; ?>" name="high_university" id="high_university" class="form-control " placeholder="University / Institute">
                                                </div>
                                            </div>
                                            
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label for="high_city" class="form-control-label">City <span class="text-danger">*</span></label>
                                                        <div class="mb-3">
                                                            <input type="text" value="<?= $userInfo['city_h'] ; ?>" name="high_city" id="high_city" class="form-control " placeholder="City">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label for="high_state" class="form-control-label">State <span class="text-danger">*</span></label>
                                                        <select class="form-control" name="high_state" id="high_state">
                                                            <option value=" " <?php if($userInfo['state_h'] == " ") echo "selected";?>>-- select --</option>
                                                            <option value="gujarat"  <?php if($userInfo['state_h'] == "gujarat") echo "selected"; ?>>Gujarat</option>
                                                            <option value="maharashtra"  <?php if($userInfo['state_h'] == "maharashtra") echo 'selected'; ?>>Maharashtra</option>
                                                            <option value="madhya pradesh"  <?php if($userInfo['state_h'] == "madhya pradesh") echo 'selected'; ?>>Madhya pradesh</option>
                                                            <option value="rajashthan"  <?php if($userInfo['state_h'] == "rajashthan") echo 'selected'; ?>>Rajashthan</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="high_mm_yyyy" class="form-control-label">Month & Year (Obtained/Expected) <span class="text-danger">*</span></label>
                                                <div class="mb-3">
                                                    <input name="high_mm_yyyy" value="<?= $userInfo['month_h'] ; ?>" id="high_mm_yyyy" name="high_mm_yyyy" type="date" class="form-control" >
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="form-control-label">Latest Cumulative Percentage / CGPA <span class="text-danger">*</span></label>
                                            </div>

                                            <div class="row">
                                                <div class="col-sm-4" >
                                                    <div class="form-group">
                                                        <div class="form-check mb-3">
                                                        <input class="form-check-input" <?php  if(!empty($userInfo['percentage_h'])) echo "checked" ;?> type="radio" onclick="h_mark()"  value="high_percentage" name="marks" id="high_percentage">
                                                            <label class="form-control-label" for="high_percentage">Percentage</label>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <div class="form-check mb-3">
                                                            <input class="form-check-input" <?php if(!empty($userInfo['cgpa_h'])) echo "checked" ;?> type="radio" onclick="h_mark()" value="high_cgpa" name="marks" id="high_cgpa">
                                                            <label class="form-control-label" for="high_cgpa">CGPA</label>
                                                        </div>                   
                                                    </div>
                                                </div>

                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <div class="input-group mb-3">
                                                            <input type="number" value="<?= ((empty($userInfo['percentage_h'])) ? $userInfo['cgpa_h'] : $userInfo['percentage_h'] ) ;?>" disabled step="0.01" name="high_marks" id="high_marks" class="form-control" placeholder="result">
                                                            <span class="input-group-text">%</span>
                                                        </div>
                                                    </div>
                                                </div>    

                                                <script>
                                                    function h_mark() { 
                                                    var result = document.querySelector('input[name="marks"]:checked').value;
                                                    if ( result=="high_percentage" ) {
                                                        document.getElementById("high_marks").removeAttribute("disabled"); 
                                                        document.getElementById("high_marks").placeholder = "99.99";
                                                        document.getElementById("high_marks").min = 33;
                                                        document.getElementById("high_marks").max = 100;
                                                    } else if ( result=="high_cgpa" ) {
                                                        document.getElementById("high_marks").removeAttribute("disabled"); 
                                                        document.getElementById("high_marks").placeholder = "9.9";
                                                        document.getElementById("high_marks").min = 3;
                                                        document.getElementById("high_marks").max = 10;
                                                    }
                                                    }
                                                </script>
                                            
                                                <div class="text-left">
                                                        <input type="submit" class="btn bg-default w-20 mb-2 text-white">
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