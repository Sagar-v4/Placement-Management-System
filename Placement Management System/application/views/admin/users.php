<!DOCTYPE html>
<html lang="en">
<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>All Users</title>

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
            <a href="<?= base_url().'admin/home/index';?>" class="nav-link">
              <i class="nav-icon fas fa-columns"></i>
              <p>Dashboard</p>
            </a>
          </li>

          <li class="nav-header">MANAGE</li>

          <li class="nav-item">
            <a href="<?= base_url().'admin/users/index';?>" class="nav-link active">
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
            <h1 class="m-0">Users</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?= base_url().'home/home/index'; ?>">Home</a></li>
              <li class="breadcrumb-item active">All Users</li>
            </ol>
          </div>
        </div>
      </div>
    </div>
    
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">

            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Admins</h3>
                <div class="card-tools">
                  <div class="input-group input-group-sm" style="width: 150px;">
                    <input type="text" name="table_search" id="table_search_admin" class="form-control float-right" placeholder="Search">

                    <div class="input-group-append">
                      <button type="submit" class="btn btn-default">
                        <i class="fas fa-search"></i>
                      </button>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-body table-responsive p-0" style="min-height: 310px; max-height: 538px;">
                <table class="table table-head-fixed text-nowrap table-hover" id="adminTable">
                  <thead>
                    <tr>
                      <th onclick="w3.sortHTML('#adminTable', '.item', 'td:nth-child(1)')" style="cursor:pointer">#</th>
                      <th onclick="w3.sortHTML('#adminTable', '.item', 'td:nth-child(2)')" style="cursor:pointer">First Name</th>
                      <th onclick="w3.sortHTML('#adminTable', '.item', 'td:nth-child(3)')" style="cursor:pointer">Middle Name</th>
                      <th onclick="w3.sortHTML('#adminTable', '.item', 'td:nth-child(4)')" style="cursor:pointer">Last Name</th>
                      <th onclick="w3.sortHTML('#adminTable', '.item', 'td:nth-child(5)')" style="cursor:pointer">Gender</th>
                      <th onclick="w3.sortHTML('#adminTable', '.item', 'td:nth-child(6)')" style="cursor:pointer">Email</th>
                      <th onclick="w3.sortHTML('#adminTable', '.item', 'td:nth-child(7)')" style="cursor:pointer">Date of Birth</th>
                      <th onclick="w3.sortHTML('#adminTable', '.item', 'td:nth-child(8)')" style="cursor:pointer">Registered Time</th>
                    </tr>
                  </thead>

                  <tbody id="admins">
                      
                      <?php if ( !empty($admins) ) { $i = 0; foreach ($admins as $admin) { $i++;?>
                        <tr class="item" >
                          <td><?= $i ;?></td>
                          <td><?= $admin['admin_first_name'] ;?></td>
                          <td><?= $admin['admin_middle_name'] ;?></td>
                          <td><?= $admin['admin_last_name'] ;?></td>
                          <td><?= $admin['admin_gender'] ;?></td>
                          <td><?= $admin['admin_email'] ;?></td>
                          <td><?= $admin['admin_dob'] ;?></td>
                          <td><?= date('j-n-Y h:i:s A', strtotime($admin['admin_created_at'])) ;?></td>
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
                      <th>Registered Time</th>
                    </tr>
                  </tfoot>
                </table>
              </div>
            </div>

            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Companies</h3>
                <div class="card-tools">
                  <div class="input-group input-group-sm" style="width: 150px;">
                    <input type="text" name="table_search" id="table_search_company" class="form-control float-right" placeholder="Search">

                    <div class="input-group-append">
                      <button type="submit" class="btn btn-default">
                        <i class="fas fa-search"></i>
                      </button>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-body table-responsive p-0" style="min-height: 310px; max-height: 538px;">
                <table class="table table-head-fixed text-nowrap table-hover" id="companyTable">
                  <thead>
                    <tr>
                      <th onclick="w3.sortHTML('#companyTable', '.item', 'td:nth-child(1)')" style="cursor:pointer">#</th>
                      <th onclick="w3.sortHTML('#companyTable', '.item', 'td:nth-child(2)')" style="cursor:pointer">Name</th>
                      <th onclick="w3.sortHTML('#companyTable', '.item', 'td:nth-child(3)')" style="cursor:pointer">Email</th>
                      <th onclick="w3.sortHTML('#companyTable', '.item', 'td:nth-child(4)')" style="cursor:pointer">Link</th>
                      <th onclick="w3.sortHTML('#companyTable', '.item', 'td:nth-child(5)')" style="cursor:pointer">Registered Time</th>
                    </tr>
                  </thead>

                  <tbody id="companies">
                    <?php if ( !empty($companys) ) { $i = 0; foreach ($companys as $company) { $i++;?>
                      <tr class="item" >
                        <td><?= $i ;?></td>
                        <td><?= $company['company_name'] ;?></td>
                        <td><?= $company['company_email'] ;?></td>
                        <td><a href="<?= $company['company_link'] ;?>" target="_blank"><?= $company['company_link'] ;?></a></td>
                        <td><?= date('j-n-Y h:i:s A', strtotime($company['company_created_at'])) ;?></td>
                      </tr>
                      <?php } } else { ?>
                      <tr>
                        <td colspan="4">Records Not Found</td>
                      </tr>
                      <?php }?>
                  </tbody>

                  <tfoot>
                    <tr>
                    <th>#</th> 
                    <th>Name</th> 
                    <th>Email</th>
                    <th>Link</th>
                    <th>Registered Time</th>
                    </tr>
                  </tfoot>
                </table>
              </div>
            </div>

            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Students</h3>
                <div class="card-tools">
                  <div class="input-group input-group-sm" style="width: 150px;">
                    <input type="text" name="table_search" id="table_search_student" class="form-control float-right" placeholder="Search">

                    <div class="input-group-append">
                      <button type="submit" class="btn btn-default">
                        <i class="fas fa-search"></i>
                      </button>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-body table-responsive p-0" style="min-height: 310px; max-height: 538px;">
                <table class="table table-head-fixed text-nowrap table-hover" id="studentTable">
                  <thead>
                    <tr>
                      <th onclick="w3.sortHTML('#studentTable', '.item', 'td:nth-child(1)')" style="cursor:pointer">#</th>
                      <th onclick="w3.sortHTML('#studentTable', '.item', 'td:nth-child(2)')" style="cursor:pointer">First Name</th>
                      <th onclick="w3.sortHTML('#studentTable', '.item', 'td:nth-child(3)')" style="cursor:pointer">Middle Name</th>
                      <th onclick="w3.sortHTML('#studentTable', '.item', 'td:nth-child(4)')" style="cursor:pointer">Last Name</th>
                      <th onclick="w3.sortHTML('#studentTable', '.item', 'td:nth-child(5)')" style="cursor:pointer">Gender</th>
                      <th onclick="w3.sortHTML('#studentTable', '.item', 'td:nth-child(6)')" style="cursor:pointer">Email</th>
                      <th onclick="w3.sortHTML('#studentTable', '.item', 'td:nth-child(7)')" style="cursor:pointer">Date of Birth</th>
                      <th onclick="w3.sortHTML('#studentTable', '.item', 'td:nth-child(8)')" style="cursor:pointer">Registered Time</th>
                    </tr>
                  </thead>

                  <tbody id="students">
                      
                      <?php if ( !empty($students) ) { $i = 0; foreach ($students as $student) { $i++;?>
                      <tr class="item" >
                        <td><?= $i ;?></td>
                        <td><?= $student['student_first_name'] ;?></td>
                        <td><?= $student['student_middle_name'] ;?></td>
                        <td><?= $student['student_last_name'] ;?></td>
                        <td><?= $student['student_gender'] ;?></td>
                        <td><?= $student['student_email'] ;?></td>
                        <td><?= $student['student_dob'] ;?></td>
                        <td><?= date('j-n-Y h:i:s A', strtotime($student['student_created_at'])) ;?></td>
                     
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
                      <th>Registered Time</th>
                    </tr>
                  </tfoot>
                </table>
              </div>
            </div>

          </div>
        </div>
      </div>
    </section>
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
  <script src="https://www.w3schools.com/lib/w3.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script>
  $(document).ready(function(){
    $("#table_search_admin").on("keyup", function() {
      var value = $(this).val().toLowerCase();
      $("#admins tr").filter(function() {
        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
      });
    });
  });
  
  $(document).ready(function(){
    $("#table_search_company").on("keyup", function() {
      var value = $(this).val().toLowerCase();
      $("#companies tr").filter(function() {
        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
      });
    });
  });
  
  $(document).ready(function(){
    $("#table_search_student").on("keyup", function() {
      var value = $(this).val().toLowerCase();
      $("#students tr").filter(function() {
        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
      });
    });
  });
  </script>

</body>
</html>
