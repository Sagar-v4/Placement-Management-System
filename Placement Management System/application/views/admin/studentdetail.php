<!DOCTYPE html>
<html lang="en">
<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Student Details</title>

  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="icon" type="image/png" href="<?= base_url().'uploads/system/logo.svg';?>">
  <link rel="stylesheet" href="<?= base_url("public/admin/");?>plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="<?= base_url("public/admin/");?>plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
  <link rel="stylesheet" href="<?= base_url("public/admin/");?>plugins/toastr/toastr.min.css">
  <link rel="stylesheet" href="<?= base_url("public/admin/");?>plugins/overlayScrollbars/css/OverlayScrollbars.min.css">>
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
          <li class="nav-item menu-open">
            <a href="#" class="nav-link active">
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
                <a href="<?= base_url().'admin/studentdetail/index';?>" class="nav-link active">
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
            <h1 class="m-0">Students Details</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?= base_url().'home/home/index'; ?>">Home</a></li>
              <li class="breadcrumb-item active">Students</li>
              <li class="breadcrumb-item active">Details</li>
            </ol>
          </div>
        </div>
      </div>
    </div>
    
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">All Students</h3>
                
                <div class="card-tools">
                  <div class="input-group input-group-sm" style="width: 150px;">
                    <input type="text" name="table_search" id="table_search" class="form-control float-right" placeholder="Search">

                    <div class="input-group-append">
                      <button type="submit" class="btn btn-default">
                        <i class="fas fa-search"></i>
                      </button>
                    </div>
                  </div>
                </div>

              </div>
              <div class="card-body table-responsive p-2" style="min-height: 310px; max-height: 540px;">
                <table class="table table-head-fixed text-nowrap table-bordered table-hover" id="studentTable">
                  <thead>
                    <tr>
                      <th onclick="w3.sortHTML('#studentTable', '.item', 'td:nth-child(1)')" style="cursor:pointer"># <i class="fa fa-sort" style="font-size:13px;"></i></th>
                      <th onclick="w3.sortHTML('#studentTable', '.item', 'td:nth-child(2)')" style="cursor:pointer">First Name <i class="fa fa-sort" style="font-size:13px;"></i></th>
                      <th onclick="w3.sortHTML('#studentTable', '.item', 'td:nth-child(3)')" style="cursor:pointer">Middle Name <i class="fa fa-sort" style="font-size:13px;"></i></th>
                      <th onclick="w3.sortHTML('#studentTable', '.item', 'td:nth-child(4)')" style="cursor:pointer">Last Name <i class="fa fa-sort" style="font-size:13px;"></i></th>
                      <th onclick="w3.sortHTML('#studentTable', '.item', 'td:nth-child(5)')" style="cursor:pointer">Gender <i class="fa fa-sort" style="font-size:13px;"></i></th>
                      <th onclick="w3.sortHTML('#studentTable', '.item', 'td:nth-child(6)')" style="cursor:pointer">Email <i class="fa fa-sort" style="font-size:13px;"></i></th>
                      <th onclick="w3.sortHTML('#studentTable', '.item', 'td:nth-child(7)')" style="cursor:pointer">Date of Birth <i class="fa fa-sort" style="font-size:13px;"></i></th>
                      <th onclick="w3.sortHTML('#studentTable', '.item', 'td:nth-child(8)')" style="cursor:pointer">Registered On <i class="fa fa-sort" style="font-size:13px;"></i></th>
                      <th onclick="w3.sortHTML('#studentTable', '.item', 'td:nth-child(9)')" style="cursor:pointer">Status <i class="fa fa-sort" style="font-size:13px;"></i></th>
                      <th onclick="w3.sortHTML('#studentTable', '.item', 'td:nth-child(10)')" style="cursor:pointer">Password <i class="fa fa-sort" style="font-size:13px;"></i></th>
                    </tr>
                  </thead>

                  <tbody id="students">
                      
                      <?php if ( !empty($students) ) { $i = 0; foreach ($students as $student) { $i++;?>
                        <tr class="item">
                          <td><?= $i ;?></td>
                          <td><?= $student['student_first_name'] ;?></td>
                          <td><?= $student['student_middle_name'] ;?></td>
                          <td><?= $student['student_last_name'] ;?></td>
                          <td><?= $student['student_gender'] ;?></td>
                          <td><?= $student['student_email'] ;?></td>
                          <td><?= $student['student_dob'] ;?></td>
                          <td><?= date('Y-n-j h:i:s A', strtotime($student['student_created_at'])) ;?></td>
                          
                        <?php if ( !empty($status) ) { foreach ($status as $stat) { if ( $stat['student_id'] == $student['student_id'] ) { if ( $stat['user_status'] == 1) { ?>
                          <td><a href="<?= base_url().'admin/studentdetail/changeStatus/'.$stat['user_id'] ;?>" class="bg-lime rounded p-2"><i class="fas fa-walking pl-2 pr-2"></i></a></td>
                        <?php } elseif ( $stat['user_status'] == 0) { ?>
                          <td><a href="<?= base_url().'admin/studentdetail/changeStatus/'.$stat['user_id'] ;?>" class="bg-danger rounded p-2"><i class="fas fa-ban pl-1 pr-1"></i></a></td>
                        <?php } } } } ?>

                          <td><a href="<?= base_url().'admin/studentdetail/resetPW/'.$student['student_id'] ;?>" class="bg-primary rounded p-2">Reset</a></td>

                        </tr>
                      <?php } } else { ?>
                        <tr>
                          <td colspan="8">Records Not Found</td>
                        </tr>
                      <?php }?>
                  
                  </tbody>

                  <tfoot>
                    <tr>
                      <th>#</th>
                      <th>First Name</th>
                      <th>Middle Name</th>
                      <th>Last Name</th>
                      <th>Gender</th>
                      <th>Email</th>
                      <th>Date of Birth</th>
                      <th>Registered On</th>
                      <th>Status</th>
                      <th>Password</th>
                    </tr>
                  </tfoot>
                </table>
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
  <script src="<?= base_url("public/admin/");?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="<?= base_url("public/admin/");?>plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
  <script src="<?= base_url("public/admin/");?>plugins/sweetalert2/sweetalert2.min.js"></script>
  <script src="<?= base_url("public/admin/");?>plugins/toastr/toastr.min.js"></script>
  <script src="<?= base_url("public/admin/");?>dist/js/adminlte.min.js"></script>
  <script src="<?= base_url("public/admin/");?>dist/js/demo.js"></script>
  <script src="https://www.w3schools.com/lib/w3.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script>
  $(document).ready(function(){
    $("#table_search").on("keyup", function() {
      var value = $(this).val().toLowerCase();
      $("#students tr").filter(function() {
        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
      });
    });
  });
  </script>

  <script>
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
