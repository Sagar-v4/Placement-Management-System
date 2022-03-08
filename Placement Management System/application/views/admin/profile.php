<!DOCTYPE html>
<html lang="en">
<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= $userInfo['fname']." ".$userInfo['lname']?></title>

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
            <div class=" dropdown-header"><strong><?= $userInfo['fname']." ".$userInfo['lname']?></strong></div>
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
              <a href="<?= base_url().'admin/analytics/index';?>" class="nav-link">
                <i class="nav-icon fas fa-chart-bar"></i>
                <p>Analytics</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?= base_url().'admin/profile/index';?>" class="nav-link active">
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
              <h1 class="m-0">Profile</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="<?= base_url().'admin/home/index'; ?>">Home</a></li>
                <li class="breadcrumb-item active">Profile</li>
              </ol>
            </div>
          </div>
        </div>
      </div>
      
      <div class="content">
        <div class="container-fluid">
          <div class="col-12">
                        <?php
                        
                            if ( !empty($this->session->flashdata('updatePPFMsg')) ) {
                            echo "
                                <div class='alert alert-danger alert-dismissible fade show' role='alert'>
                                <span class='alert-icon'><i class='fas fa-ban'></i></span> Profile Picture
                                <span class='alert-text'>".$this->session->flashdata('updatePPFMsg')."</span>
                                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                <span aria-hidden='true'>&times;</span>
                                </button>
                                </div>";
                            } 
                            if ( !empty($this->session->flashdata('updateCPFMsg')) ) {
                            echo "
                                <div class='alert alert-danger alert-dismissible fade show' role='alert'>
                                <span class='alert-icon'><i class='fas fa-ban'></i></span> Cover Picture
                                <span class='alert-text'>".$this->session->flashdata('updateCPFMsg')."</span>
                                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                <span aria-hidden='true'>&times;</span>
                                </button>
                                </div>";
                            } 
                            
                            if ( !empty($this->session->flashdata('updatePPSMsg')) ) {
                            echo "
                                <div class='alert alert-success alert-dismissible fade show' role='alert'>
                                <span class='alert-icon'><i class='fas fa-check'></i></span> Profile Picture
                                <span class='alert-text'>".$this->session->flashdata('updatePPSMsg')."</span>
                                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                <span aria-hidden='true'>&times;</span>
                                </button>
                                </div>";
                            } 
                            if ( !empty($this->session->flashdata('updateCPSMsg')) ) {
                            echo "
                                <div class='alert alert-success alert-dismissible fade show' role='alert'>
                                <span class='alert-icon'><i class='fas fa-check'></i></span> Cover Picture
                                <span class='alert-text'>".$this->session->flashdata('updateCPSMsg')."</span>
                                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                <span aria-hidden='true'>&times;</span>
                                </button>
                                </div>";
                            }     
                            
                            if ( !empty($this->session->flashdata('updatePFMsg')) ) {
                            echo "
                                <div class='alert alert-danger alert-dismissible fade show' role='alert'>
                                <span class='alert-icon'><i class='fas fa-ban'></i></span>
                                <span class='alert-text'>".$this->session->flashdata('updatePFMsg')."</span>
                                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                <span aria-hidden='true'>&times;</span>
                                </button>
                                </div>";
                            }

                            if ( !empty($this->session->flashdata('updatePSMsg')) ) {
                                echo "
                                <div class='alert alert-success alert-dismissible fade show' role='alert'>
                                <span class='alert-icon'><i class='fas fa-check'></i></span>
                                <span class='alert-text'>".$this->session->flashdata('updatePSMsg')."</span>
                                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                <span aria-hidden='true'>&times;</span>
                                </button>
                                </div>";
                            } 
                        ?>
              <div class="card pb-3" style="">

                <img src="<?= base_url().$userInfo['cover'];?>" data-toggle="modal" data-target="#modal-form-cover-pic" alt="cover Image" style="width:100%; height:250px" >

                <div class="" style=" margin-top: -70px; margin-left: 20px">

                  <img class="img-circle" src="<?= base_url().$userInfo['profile'] ;?>" alt="User Avatar" data-toggle="modal" data-target="#modal-form-profile-pic"  style="z-index:5; width: 140px; height: 140px;">
                </div>
                
                <div class="mx-3 my-2">
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

                    <label class="form-control-label">Email</label>
                    <div class="mb-3">
                        <div class="form-control"><?= $userInfo['email'] ?></div>
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

                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-form-user">Edit profile</button>
                </div>
                
              </div>
            </div>

            <div class="row">
              <div class="col-12">
                <div class="modal fade" id="modal-form-cover-pic" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
                  <div class="modal-dialog modal- modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content">
                      <div class="modal-body p-0">
                        <div class="card bg-white border-0 mb-0"> 
                          <div class="card-body px-lg-5 py-lg-5">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                            <?= form_open_multipart(base_url().'admin/profile/covUpdate'); ?>
                              <img src="<?= base_url().$userInfo['cover'] ;?>" width="300" style="z-index:1;" class="text-center">
                              <div class="custom-file m-3 text-default">
                                <label for="coverPic" class=" text-default"><h3>Cover Picture :</h3></label>
                                <input type="file" name="coverPic" accept=".gif, .jpg, .jpeg, .png" id="coverPic">
                              </div>
                              <div class="row">
                                <div class="col-6 text-left text-default">
                                  <input type="submit" id="submit" name="pictureUpdate" class="btn btn-primary w-20 mb-2 text-white">
                                </div>    
                                <div class="col-6 text-right text-default">
                                  <a href="<?= base_url().'admin/profile/covRemove'?>" name="pictureUpdate" class="btn btn-secondary w-20 mb-2 text-white">Remove</a>
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

                <div class="row">
                  <div class="col-md-3">
                    <div class="modal fade" id="modal-form-profile-pic" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
                      <div class="modal-dialog modal- modal-dialog-centered modal-lg" role="document">
                        <div class="modal-content">
                          <div class="modal-body p-0">
                            <div class="card bg-white border-0 mb-0">
                              <div class="card-body px-lg-5 py-lg-5">

                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                          
                                <?= form_open_multipart(base_url().'admin/profile/proUpdate'); ?>

                                  <img src="<?= base_url().$userInfo['profile'] ;?>" width="300" style="z-index:1;" class="text-center">

                                  <div class="custom-file m-3 text-default">
                                      <label for="proPic" class=" text-default"><h3>Profile Picture :(Square Recommend)</h3></label>
                                      <input type="file" name="proPic" accept=".gif, .jpg, .jpeg, .png"  id="proPic">
                                  </div>

                                  <div class="row mt-4">
                                    <div class="col-6 text-left text-default">
                                      <input type="submit" id="submit" name="pictureUpdate" class="btn btn-primary w-20 mb-2 text-white">
                                    </div>    
                                    <div class="col-6 text-right text-default">
                                      <a href="<?= base_url().'admin/profile/proRemove'?>" name="pictureUpdate" class="btn btn-secondary w-20 mb-2 text-white">Remove</a>
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
        </div>
      </div>
    </div>

    <div class="modal fade" id="modal-form-user" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
      <div class="modal-dialog modal- modal-dialog-centered modal-lg" role="document">
        <div class="modal-content ">
            
          <div class="modal-body p-0">
          
            <div class="card bg-white border-0 mb-0">
              <div class="card-body px-lg-10 py-lg-10">

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>

                <h6 class="heading-small text-muted mb-4">Admin information</h6>
                
                <form action="<?= base_url().'admin/profile/personalUpdate'; ?>" name="registrationForm" id="registrationFormPersonal" method="POST" role="form text-left" autocomplete="off">
                  
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
                        <label for="email" class="form-control-label">Email <span class="text-danger">*</span></label>
                        <div class="mb-3">
                            <input class="form-control" value="<?= $userInfo['email'] ; ?>" disabled type="email" name="email"  id="email" Placeholder="Email" >
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
                      <input type="submit" class="btn bg-blue w-20 mb-2 text-white">
                    </div>

                  </div>
                </form>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>

              <div class="modal fade" id="modal-form-description" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
                <div class="modal-dialog modal- modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content ">
                          
                          <div class="modal-body p-0">
                          
                              <div class="card bg-white border-0 mb-0">
                                  <div class="card-body px-lg-10 py-lg-10">

                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                          <span aria-hidden="true">&times;</span>
                                      </button>
                                      <h6 class="heading-small text-muted mb-4">Description Updation</h6>
                                      <form action="<?= base_url().'admin/profile/descriptionUpdate'; ?>" name="registrationForm" id="registrationForm" method="POST" role="form text-left" autocomplete="off">
                                          <div class="pl-lg-4">

                                              <div class="form-group">
                                                  <label for="description" class="form-control-label">Description <span class="text-danger">*</span></label>
                                                  <div class="mb-3">
                                                      <textarea class="form-control " rows="5" name="description"type="text" name="description"  id="description" Placeholder="description" ><?= $userInfo['description'] ; ?></textarea>
                                                  </div>
                                              </div>
                                              <div class="text-left ">
                                                  <input type="submit" id="submit"  class="btn bg-default w-20 mb-2 text-black">
                                              </div>
                                          </div>
                                      </form>        
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

    <aside class="control-sidebar control-sidebar-dark">
    </aside>
  </div>
  
  <script src="<?= base_url("public/admin/");?>plugins/jquery/jquery.min.js"></script>
  <script src="<?= base_url("public/admin/");?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="<?= base_url("public/admin/");?>plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
  <script src="<?= base_url("public/admin/");?>dist/js/adminlte.min.js"></script>

</body>
</html>
