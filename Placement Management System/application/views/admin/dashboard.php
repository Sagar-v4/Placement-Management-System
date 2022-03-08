<!DOCTYPE html>
<html lang="en">
<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Dashboard</title>

  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="icon" type="image/png" href="<?= base_url().'uploads/system/logo.svg';?>">
  <link rel="stylesheet" href="<?= base_url("public/admin/");?>plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="<?= base_url("public/admin/");?>plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
  <link rel="stylesheet" href="<?= base_url("public/admin/");?>plugins/toastr/toastr.min.css">
  <link rel="stylesheet" href="<?= base_url("public/admin/");?>plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <link rel="stylesheet" href="<?= base_url("public/admin/");?>dist/css/adminlte.min.css">
  
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
          <div class=" dropdown-header"><strong><?= $userInfo['fname']." ".$userInfo['lname'] ;?></strong></div>
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
            <a href="<?= base_url().'admin/profile/index';?>" class="nav-link">
              <i class="nav-icon fas fa-user-shield"></i>
              <p>Profile</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= base_url().'admin/home/index';?>" class="nav-link active">
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
                <a href="<?= base_url().'admin/studentdetail/index';?>" class="nav-link">
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
            <h1 class="m-0">Dashboard</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?= base_url().'home/home/index'; ?>">Home</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
            </ol>
          </div>
        </div>
      </div>
    </div>
    
    <div class="content">
      <div class="container-fluid">
        <div class="row col-12 p-2">

          <?php if ( !empty($requirements) ) { $i = 0; rsort($requirements); foreach ($requirements as $requirement) { ?>
        
            <div class="col-xl-3 col-lg-4 col-md-4 col-sm-6">
              <div class="card <?= ($requirement['company_requirement_status'] == 1) ? 'card-primary' : 'card-secondary' ; ?> card-outline">
                <div class="card-header">
                  <h5 class="m-0"><?= $requirement['company_name'] ; ?></h5>
                </div>
                <div class="card-body">
                  <h6 class="card-title"><?= $requirement['company_requirement_name'] ; ?></h6>
                  <p class="card-text mb-1"><?= $requirement['company_requirement_post'] ; ?> - <?= $requirement['company_requirement_vacancy'] ; ?></p>
                  <p class="card-text mb-1"><?= date('d-m-Y' ,strtotime($requirement['company_requirement_last_date'])) ;?></p>
                  
                  <button type="button" class="btn <?= ($requirement['company_requirement_status'] == 1) ? 'btn-primary' : 'btn-secondary' ;?> text-right" data-toggle="modal" data-target="#modal-xl<?= $i;?>">Edit</button>
                  
                </div>
              </div>
            </div>

          <?php $i++; } } ?>

          <?php if ( !empty($requirements) ) { $j = 0; foreach ($requirements as $requirement) { ?>

            <div class="modal fade" id="modal-xl<?= $j;?>">
              <div class="modal-dialog modal-xl">
                <div class="modal-content">
                  <form action="<?= base_url().'admin/home/updateRequirement/'.$requirement['company_requirement_id'] ; ?>" name="registrationForm" id="registrationForm" method="POST" role="form text-left" autocomplete="off" >

                    <div class="modal-header">
                      <h4 class="col-sm-8 modal-title"><?= $requirement['company_name'] ; ?></h4>
                      <h6 class="col-sm-3 text-right modal-title"><?= date('j-n-Y h:i:s A', strtotime($requirement['company_requirement_created_at'])) ;?></h6>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>

                    <div class="modal-body  ">

                        <div class="row">
                            <div class="col-sm-5">
                                <label for="requirement_name" class="form-control-label">Name <span class="text-danger">*</span></label>
                                <div class="mb-3">
                                    <input type="text" required value="<?= $requirement['company_requirement_name'] ; ?>" name="requirement_name" id="requirement_name" class="form-control " placeholder="Requirement name">
                                </div>
                            </div>
                            <div class="col-sm-5">
                                <label for="post" class="form-control-label">Post <span class="text-danger">*</span></label>
                                <div class="mb-3">
                                    <input type="text" required value="<?= $requirement['company_requirement_post'] ; ?>" name="post" id="post" class="form-control " placeholder="Requirement Post">
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <label for="reuirement_status" class="form-control-label">Status</label>
                                <div class="mb-3">
                                    <a href="<?= base_url().'admin/home/updateRequirementStatus/'.$requirement['company_requirement_id'].'/company_requirement_status' ; ?>" name="reuirement_status" id="reuirement_status" class="form-control <?= ($requirement['company_requirement_status'] == 1) ? 'bg-success' : 'bg-danger' ; ?> text-center " >Status</a>
                                </div>
                            </div>
                        </div>

                        <label for="description" class="form-control-label">Requirement Description <span class="text-danger">*</span></label>
                        <div class="mb-3">
                            <textarea type="text" required name="description" rows="2" id="description" class="form-control example" placeholder="Company Description"><?= $requirement['company_requirement_description'] ; ?></textarea>
                        </div>

                        <div class="row">
                            <div class="col-sm-4">
                                <label for="percentage" class="form-control-label">Percentage <span class="text-danger">*</span></label>
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
                            <div class="col-sm-5">
                                <div class="form-group">
                                    <label for="date_exam" class="form-control-label">Exam Start <span class="text-danger">*</span></label>
                                    <input type="datetime-local" required class="form-control date  mb-3" value="<?= date('Y-m-d\TH:i', strtotime($requirement['company_requirement_exam_date'])) ;?>" name="date_exam" id="date_exam<?= $j;?>">
                                </div>
                            </div>
                            
                            <div class="col-sm-5">
                                <div class="form-group">
                                    <label for="date_exam_end" class="form-control-label">Exam End <span class="text-danger">*</span></label>
                                    <input type="datetime-local" required class="form-control date  mb-3" value="<?= date('Y-m-d\TH:i', strtotime($requirement['company_requirement_exam_date_end'])) ;?>" name="date_exam_end" id="date_exam_end<?= $j;?>">
                                </div>
                            </div>
                            
                            <div class="col-sm-2">
                                <div class="form-group">
                                    <label for="exam_status" class="form-control-label">Status</label>
                                    <a href="<?= base_url().'admin/home/updateRequirementStatus/'.$requirement['company_requirement_id'].'/company_requirement_exam_status' ; ?>" class="form-control text-center <?= ($requirement['company_requirement_exam_status'] == 1) ? 'bg-success' : 'bg-danger' ;?> date mb-3" name="exam_status" id="exam_status<?= $j;?>">Status</a>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-5">
                                <div class="form-group">
                                    <label for="date_interview" class="form-control-label">Interview Start <span class="text-danger">*</span></label>
                                    <input type="datetime-local" required class="form-control date  mb-3" value="<?= date('Y-m-d\TH:i', strtotime($requirement['company_requirement_interview_date'])) ;?>" name="date_interview" id="date_interview<?= $j;?>">
                                </div>
                            </div>
                            
                            <div class="col-sm-5">
                                <div class="form-group">
                                    <label for="date_interview_end" class="form-control-label">Interview End <span class="text-danger">*</span></label>
                                    <input type="datetime-local" required class="form-control date  mb-3" value="<?= date('Y-m-d\TH:i', strtotime($requirement['company_requirement_interview_date_end'])) ;?>" name="date_interview_end" id="date_interview_end<?= $j;?>">
                                </div>
                            </div>
                            
                            <div class="col-sm-2">
                                <div class="form-group">
                                    <label for="interview_status" class="form-control-label">Status</label>
                                    <a href="<?= base_url().'admin/home/updateRequirementStatus/'.$requirement['company_requirement_id'].'/company_requirement_interview_status' ; ?>" href="#" class="form-control text-center <?= ($requirement['company_requirement_interview_status'] == 1) ? 'bg-success' : 'bg-danger' ;?> date mb-3" name="interview_status" id="interview_status<?= $j;?>">Status</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer justify-content-between">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                      <button type="submit" id="submit<?= $j;?>" name="submit" class="btn btn-primary">Save changes</button>
                    </div>

                  </form>
                </div>
              </div>
            </div>

          <?php $j++; } } ?>

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
  <script src="<?= base_url("public/admin/");?>plugins/sweetalert2/sweetalert2.min.js"></script>
  <script src="<?= base_url("public/admin/");?>plugins/toastr/toastr.min.js"></script>
  <script src="<?= base_url("public/admin/");?>plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
  <script src="<?= base_url("public/admin/");?>dist/js/adminlte.min.js"></script>
  <script src="<?= base_url("public/admin/");?>dist/js/demo.js"></script>
 
  <script type="text/javascript">
    $(function() {
      var Toast = Swal.mixin({
        toast: true,
        position: 'top',
        showConfirmButton: false,
        timer: 3000
      });

      <?php if ( !empty($this->session->flashdata('updateRSMsg')) ) { ?>

        Toast.fire({
          icon: 'success',
          title: '<?= $this->session->flashdata('updateRSMsg');?>'
        })

      <?php } ?>
      
      <?php if ( !empty($this->session->flashdata('updateRFMsg')) ) { ?>
      
        Toast.fire({
          icon: 'error',
          title: '<?= $this->session->flashdata('updateRFMsg');?>'
        })
      
      <?php } ?>
    });
  </script>

</body>
</html>
