<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Add Admin</title>

    <link rel="stylesheet"
      href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="icon" type="image/png" href="<?= base_url().'uploads/system/logo.svg';?>">
    <link rel="stylesheet" href="<?= base_url(" public/admin/");?>plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="<?= base_url(" public/admin/");?>
    plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <link rel="stylesheet" href="<?= base_url(" public/admin/");?>dist/css/adminlte.min.css">
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
                  <img src="<?= base_url().$profile_thumb ;?>" class="img-circle elevation-2" alt="User Image">
                </div>
              </div>
            </a>

            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
              <div class=" dropdown-header"><strong>
                  <?= $fname." ".$lname?>
                </strong></div>
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
              <div class="dropdown-divider "></div>
              <a href="<?= base_url().'login/login/logout/admin';?>" class="dropdown-item">
                <i class="fas fa-running mr-2"></i> Log Out
              </a>
            </div>

          </li>

        </ul>
      </nav>

      <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <a href="<?= base_url().'home/home/index'; ?>" class="brand-link">
          <img src="<?= base_url().'uploads/system/adminLogo.svg';?>" alt="Admin Logo"
            class="brand-image img-circle elevation-3" style="opacity: .8">
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
              <li class="nav-item menu-open">
                <a href="#" class="nav-link active">
                  <i class="nav-icon fas fa-user-cog"></i>
                  <p>Admins
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <?php if ( $power == 1 ) { ?>
                  <li class="nav-item">
                    <a href="<?= base_url().'admin/addadmin/index';?>" class="nav-link active">
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
                <a href="#" class="nav-link">
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
                  <?php if ( $power == 1 ) { ?>
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

              <?php if ( $power == 1 ) { ?>
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
                <h1 class="m-0">Add Admin</h1>
              </div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="<?= base_url().'home/home/index'; ?>">Home</a></li>
                  <li class="breadcrumb-item active">Add admin</li>
                </ol>
              </div>
            </div>
          </div>
        </div>

        <section class="content">
          <div class="container-fluid">
            <div class="row">
              <div class="col-md-12">

                <?php
                if ( !empty($this->session->flashdata('signupAMsg')) ) {
                  echo "
                  <div class='alert alert-danger alert-dismissible'>
                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                    <i class='icon fas fa-ban'></i>
                    ".$this->session->flashdata('signupAMsg')."
                  </div>";
                }

                if ( !empty($this->session->flashdata('signuplogAMsg')) ) {
                  echo "
                  <div class='alert alert-success alert-dismissible'>
                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                    <i class='icon fas fa-check'></i>
                    ".$this->session->flashdata('signuplogAMsg')."
                  </div>";
                }           
              ?>

                <div class="card card-primary">
                  <div class="card-header">
                    <h3 class="card-title">New Admin Registration</h3>
                  </div>
                  <form action="<?= base_url().'admin/addadmin/authenticate'; ?>" name="adminRegistrationForm"
                    id="adminRegistrationForm" method="POST" autocomplete="off">
                    <div class="card-body">
                      <div class="row">
                        <div class="col-sm-4">
                          <div class="form-group">
                            <label for="first_name">First Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control <?= form_error('first_name') ? 'is-invalid' : '';?>"
                              value="<?= set_value('first_name'); ?>" id="first_name" name="first_name"
                              placeholder="Admin name">
                          </div>
                        </div>

                        <div class="col-sm-4">
                          <div class="form-group">
                            <label for="middle_name">Middle Name</label>
                            <input type="text" class="form-control <?= form_error('middle_name') ? 'is-invalid' : '';?>"
                              value="<?= set_value('middle_name'); ?>" id="middle_name" name="middle_name"
                              placeholder="Father's name">
                          </div>
                        </div>

                        <div class="col-sm-4">
                          <div class="form-group">
                            <label for="last_name">Last Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control <?= form_error('last_name') ? 'is-invalid' : '';?>"
                              value="<?= set_value('last_name'); ?>" id="last_name" name="last_name"
                              placeholder="Surname">
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-sm-3">
                          <div class="form-group">
                            <label class="<?= form_error('gender') ? 'text-danger' : '';?>">Gender <span
                                class="text-danger">*</span></label>
                          </div>
                        </div>

                        <div class="col-sm-3">
                          <div class="form-group">
                            <div class="custom-control custom-radio">
                              <input class="custom-control-input" type="radio" value="male" id="male" name="gender"
                                <?php if(set_value('gender')=="male" ) echo "checked" ;?>>
                              <label for="male" class="custom-control-label">Male</label>
                            </div>
                          </div>
                        </div>

                        <div class="col-sm-3">
                          <div class="form-group">
                            <div class="custom-control custom-radio">
                              <input class="custom-control-input" type="radio" value="female" id="female" name="gender"
                                <?php if(set_value('gender')=="female" ) echo "checked" ;?>>
                              <label for="female" class="custom-control-label">Female</label>
                            </div>
                          </div>
                        </div>

                        <div class="col-sm-3">
                          <div class="form-group">
                            <div class="custom-control custom-radio">
                              <input class="custom-control-input" type="radio" value="other" id="other" name="gender"
                                <?php if(set_value('gender')=="other" ) echo "checked" ;?>>
                              <label for="other" class="custom-control-label">Other</label>
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="dob" class="form-control-label">Date Of Birth <span
                            class="text-danger">*</span></label>
                        <input class="form-control <?= form_error('dob') ? 'is-invalid' : '';?>"
                          value="<?= set_value('dob');?>" name="dob" id="dob" type="date">
                      </div>

                      <div class="form-group">
                        <label for="email">Email <span class="text-danger">*</span></label>
                        <input type="email" class="form-control <?= form_error('email') ? 'is-invalid' : '';?>"
                          value="<?= set_value('email');?>" name="email" id="email" placeholder="Email">
                      </div>

                      <div class="form-group">
                        <label for="password">Password <span class="text-danger">*</span></label>
                        <input type="password" class="form-control <?= form_error('password') ? 'is-invalid' : '';?>"
                          value="<?= set_value('password');?>" name="password" id="password" placeholder="Password">
                      </div>
                    </div>
                    <div class="card-footer">
                      <input type="submit" class="btn btn-primary" id="submit" name="Create Admin">
                    </div>
                  </form>
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

    <script src="<?= base_url(" public/admin/");?>plugins / jquery / jquery.min.js"></script>
    <script src="<?= base_url(" public/admin/");?>plugins / bootstrap / js / bootstrap.bundle.min.js"></script>
    <script src="<?= base_url("
      public/admin/");?>plugins / overlayScrollbars / js / jquery.overlayScrollbars.min.js"></script>
    <script src="<?= base_url(" public/admin/");?>dist / js / adminlte.min.js"></script>
    <script src="<?= base_url(" public/admin/");?>dist / js / demo.js"></script>

  </body>

</html>
