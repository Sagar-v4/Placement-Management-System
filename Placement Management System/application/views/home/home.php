<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="icon" type="image/png" href="<?= base_url('uploads/system/logo.svg');?>">
  <title>Home</title>
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <link rel="stylesheet" href="<?= base_url('public/login/assets/css/nucleo-icons.css'); ?>" />
  <link "stylesheet" href="<?= base_url('public/login/assets/css/nucleo-svg.css');?>" />
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <link "stylesheet" href="<?= base_url('public/login/assets/css/nucleo-svg.css');?>"  />
  <link id="pagestyle" href="<?= base_url('public/login/assets/css/soft-ui-dashboard.css?v=1.0.1');?>" rel="stylesheet" />
  <link "stylesheet" rel="stylesheet" href="<?= base_url('public/footer/css/footer.css');?>">

</head>


<body class="g-sidenav-show  bg-gradient-light"  >
  <div class="container position-sticky z-index-sticky top-0">
    <div class="row">
      <div class="col-12">
        <nav class="navbar navbar-expand-lg blur blur-rounded top-0 z-index-3 shadow position-absolute my-3 py-2 start-0 end-0 mx-4">
          <div class="container-fluid">
            <a class="navbar-brand font-weight-bolder col-xl-1 col-lg-1 col-md-2 col-sm-4 col-4 " href="<?= base_url('home/home/index'); ?>">
              <img src="<?= base_url('uploads/system/logo.svg');?>" class="w-35">
            </a>
            <button class="navbar-toggler shadow-none ms-2" type="button" data-bs-toggle="collapse" data-bs-target="#navigation" aria-controls="navigation" aria-expanded="false" aria-label="Toggle navigation">
              <div>
                <span class="navbar-toggler-icon mt-1 pt-1">
                  <span class="navbar-toggler-bar bar1"></span>
                  <span class="navbar-toggler-bar bar2"></span>
                  <span class="navbar-toggler-bar bar3"></span>
                </span>
              </div>
            </button>
            <div class="collapse navbar-collapse" id="navigation">
              <ul class="navbar-nav mx-auto">
                <li class="nav-item">
                  <a class="nav-link d-flex align-items-center me-2" id="home" aria-current="page" href="<?= base_url('home/home/index'); ?>">
                    <i class="fa fa-home opacity-6 text-info text-gradient me-1"></i>
                    Home
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link d-flex align-items-center me-2 active" id="signUp" href="<?= base_url().'registration/register/index'; ?>">
                    <i class="fas fa-user-plus opacity-6 text-dark text-gradient me-1"></i>
                    Sign Up
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link d-flex align-items-center me-2" id="signIn" href="<?= base_url().'login/login/index'; ?>">
                    <i class="fas fa-key opacity-6 text-primary text-gradient me-1"></i>
                    Sign In
                  </a>
                </li>
              </ul>
              <ul class="navbar-nav d-lg-block d-none">
                <li class="nav-item">
                  <a href="<?= base_url().'home/home/index'; ?>" class="btn btn-sm btn-round mb-0 me-1 bg-gradient-info">Home</a>
                </li>
              </ul>
            </div>
          </div>
        </nav>
      </div>
    </div>
  </div>
  

  <section>
    <div class="page-header section-height-100">
      <div class="container ">

        <div class="row mt-8">

          <?php if ( !empty($requirements) ) { $i = 0; rsort($requirements); foreach ($requirements as $requirement) { ?>
            
            <div class="col-xl-4 col-lg-6 col-md-6 mb-4">
              <a href="<?= base_url().'login/login/index'; ?>">
                <div class="card card-background move-on-hover">
                  <div class="full-background" style="background-image: url('<?= base_url().$requirements[$i++]['company_requirement_pic'] ;?>')"></div>
                  <div class="card-body h-10 pt-8">
                    <h4 class="text-white"><?= $requirement['company_name'] ;?></h4>
                    <h3 class="text-white"><?= $requirement['company_requirement_post'] ;?></h3>
                    <p><?= $requirement['company_requirement_name'] ;?></p>
                  </div>
                </div>
              </a>
            </div>

          <?php } } ?>

        </div>
      </div>
    </div>
  </section>

    <footer class="footer-39201">
      <div class="container">
        <div class="row">
          <div class="col-md mb-4 mb-md-0">
            <h3>Get Started</h3>
            <ul class="list-unstyled nav-links">
              <li><a href="<?= base_url('home/home/index'); ?>">Home</a></li>
              <li><a href="<?= base_url().'registration/register/index'; ?>">Sign up</a></li>
              <li><a href="<?= base_url('login/login/index'); ?>">Sign in</a></li>
            </ul>
          </div>
          <div class="col-md mb-4 mb-md-0">
            <h3>PMS</h3>
            <ul class="list-unstyled nav-links">
              <li><a href="<?= base_url('others/About_us/About_us/index'); ?>">About us</a></li>
              <li><a href="<?= base_url('others/Terms_conditions/Terms_conditions/index'); ?>">Terms &amp; Conditions</a></li>
                           <li><a href="<?= base_url('others/Privacy_policy/Privacy_policy/index'); ?>">Privacy Policy</a></li>
              <li><a href="<?= base_url('others/FaQ/FaQ/index'); ?>">FaQ</a></li>
            </ul>
          </div>
          <div class="col-md-4 mb-4 mb-md-0">
            <h3>Subscribe</h3>
            <ul class="list-unstyled nav-links">
            <li class="mb-4">E-mail: pms.project.39@gmail.com</li>
            <li class="mb-4"><strong><em>Project By Sagar Variya & Bhumit Prajapati</em></strong></li>

          </div>
        </div>
      </div>
      </div>
    </footer>

  <script src="<?= base_url("public/login/");?>assets/js/core/popper.min.js"></script>
  <script src="<?= base_url("public/login/");?>assets/js/core/bootstrap.min.js"></script>
  <script src="<?= base_url("public/login/");?>assets/js/plugins/smooth-scrollbar.min.js"></script>
  <script src="<?= base_url("public/footer/");?>js/jquery-footer.min.js"></script>
  <script src="<?= base_url("public/footer/");?>js/popper.min.footer.js"></script>
  
  <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/mousetrap/1.4.6/mousetrap.min.js"></script>
  <script type="text/javascript" >
  
  Mousetrap.bind('ctrl+alt+h', home);
  Mousetrap.bind('ctrl+alt+u', signUp);
  Mousetrap.bind('ctrl+alt+i', signIn);
  
  function home() {
  document.getElementById("home").click();
  }
  
  function signUp() {
  document.getElementById("signUp").click();
  }
  
  function signIn() {
  document.getElementById("signIn").click();
  }
  </script>
  
  <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
  </script>
  <script async defer src="https://buttons.github.io/buttons.js"></script>
</body>

</html>