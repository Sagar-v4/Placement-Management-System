
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  
  <link rel="icon" type="image/png" href="<?= base_url().'uploads/system/logo.svg';?>">
  <title>Sign Up</title>
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <link href="<?= base_url("public/login/");?>assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="<?= base_url("public/login/");?>assets/css/nucleo-svg.css" rel="stylesheet" />
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <link href="<?= base_url("public/login/");?>assets/css/nucleo-svg.css" rel="stylesheet" />
  <link id="pagestyle" href="<?= base_url("public/login/");?>assets/css/soft-ui-dashboard.css?v=1.0.1" rel="stylesheet" />
  
  <style type="text/css">

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


<body class="g-sidenav-show  bg-gradient-light"  >
  <div class="container position-sticky z-index-sticky top-0">
    <div class="row">
      <div class="col-12">
        <nav class="navbar navbar-expand-lg blur blur-rounded top-0 z-index-3 shadow position-absolute my-3 py-2 start-0 end-0 mx-4">
          <div class="container-fluid">
            <a class="navbar-brand font-weight-bolder col-xl-1 col-lg-1 col-md-2 col-sm-4 col-4  " href="<?= base_url().'home/home/index'; ?>">
              <img src="<?= base_url().'uploads/system/logo.svg';?>" class=" w-35">
            </a>
            <button class="navbar-toggler shadow-none ms-2" type="button" data-bs-toggle="collapse" data-bs-target="#navigation" aria-controls="navigation" aria-expanded="false" aria-label="Toggle navigation">
              <div>
                <span class="navbar-toggler-icon mt-2">
                  <span class="navbar-toggler-bar bar1"></span>
                  <span class="navbar-toggler-bar bar2"></span>
                  <span class="navbar-toggler-bar bar3"></span>
                </span>
              </div>
            </button>
            <div class="collapse navbar-collapse" id="navigation">
              <ul class="navbar-nav mx-auto">
                <li class="nav-item">
                  <a class="nav-link d-flex align-items-center me-2" id="home" aria-current="page" href="<?= base_url().'home/home/index'; ?>">
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
                  <a href="<?= base_url().'registration/register/index'; ?>" class="btn btn-sm btn-round mb-0 me-1 bg-gradient-dark">Sign Up</a>
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
      <div class="container">
        <div class="row">
          <div class="col-xl-10 col-lg-8 col-md-10 d-flex flex-column mt-8 mx-auto">

              <?php
                if ( !empty($this->session->flashdata('signupMsg')) ) {

                  echo "<div class='alert alert-danger alert-dismissible mb-5 fade show' role='alert'>
                  <span class='alert-text'><strong class='text-white text-bold'>".$this->session->flashdata('signupMsg')."</strong></>
                  <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'>
                  </button></div>";
                }
              ?>
            <form action="<?= base_url().'registration/register/authenticate'; ?>" name="registrationForm" id="registrationForm" method="POST" role="form text-left" autocomplete="off">
            
              <div class="card z-index-1 ">
                <div class="card-header text-center pt-3 pb-3">
                  <h5>Personal Details</h5>
                </div>
                <div class="card-body pt-3 pb-3">
                  
                  <div class="row">
                    <div class="col-sm-4">
                      <div class="form-group">
                        <label for="first_name" class="form-control-label">First Name <span class="text-danger">*</span></label>
                        <div class="mb-3">
                          <input type="text" value="<?= set_value('first_name'); ?>" name="first_name" id="first_name" class="form-control <?= form_error('first_name') ? 'is-invalid' : '';?> " placeholder="Your name">
                        </div>
                      </div>
                    </div>
                    
                    <div class="col-sm-4">
                      <div class="form-group">
                        <label for="middle_name" class="form-control-label">Middle Name</label>
                        <div class="mb-3">
                          <input type="text" value="<?= set_value('middle_name');?>" name="middle_name" id="middle_name" class="form-control <?= form_error('middle_name') ? 'is-invalid' : '';?>" placeholder="Father's name(Optional)">
                        </div>
                      </div>
                    </div>
                      
                    <div class="col-sm-4">
                      <div class="form-group">
                        <label for="last_name" class="form-control-label">Last Name <span class="text-danger">*</span></label>
                        <div class="mb-3">
                          <input type="text" value="<?= set_value('last_name');?>" name="last_name" id="last_name" class="form-control <?= form_error('last_name') ? 'is-invalid' : '';?>" placeholder="Surname">
                        </div>
                      </div>
                    </div>

                  </div>

                  <div class="row">
                    <div class="col-sm-3">
                      <div class="form-group">
                        <label class="form-control-label <?= form_error('gender') ? 'text-danger' : '';?>">Gender <span class="text-danger">*</span></label>
                      </div>
                    </div>

                    <div class="col-sm-3" >
                      <div class="form-group">
                        <div class="form-check mb-3">
                          <input class="form-check-input" <?php if(set_value('gender') == "male") echo "checked";?> type="radio" value="male" name="gender" id="male">
                          <label class="custom-control-label" for="male">Male</label>
                        </div>
                      </div>
                    </div>

                    <div class="col-sm-3">
                      <div class="form-group">
                        <div class="form-check mb-3">
                          <input class="form-check-input" <?php if(set_value('gender') == "female") echo "checked";?> type="radio" value="female" name="gender" id="female">
                          <label class="custom-control-label" for="female">Female</label>
                        </div>                   
                      </div>
                    </div>

                    <div class="col-sm-3">
                      <div class="form-group">
                        <div class="form-check mb-3">
                          <input class="form-check-input" <?php if(set_value('gender') == "other") echo "checked";?> type="radio" value="other" name="gender" id="other">
                          <label class="custom-control-label" for="other">Other</label>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="dob" class="form-control-label">Date Of Birth <span class="text-danger">*</span></label>
                    <div class="mb-3">
                      <input class="form-control example <?= form_error('dob') ? 'is-invalid' : '';?>" value="<?= set_value('dob');?>" name="dob" id="dob" type="date"  >
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

                </div>
              </div>

              <div class="card z-index-1 mt-5">
                <div class="card-header text-center pt-3 pb-3">
                  <h5>Contact Information</h5>
                </div>
                <div class="card-body pt-3 pb-3">

                  <div class="form-group">
                    <label for="phone" class="form-control-label">Phone Number <span class="text-danger">*</span></label>
                    <div class="mb-3">
                      <input class="form-control example <?= form_error('phone') ? 'is-invalid' : '';?>" value="<?= set_value('phone');?>" type="number" onKeyPress="if(this.value.length==10) return false;" name="phone"  id="phone" Placeholder="Phone Number" >
                    </div>
                  </div>
                
                  <div class="row">
                    <div class="col-sm-3">          
                      <div class="form-group">
                        <label for="std" class="form-control-label">STD Code</label>
                        <div class="mb-3">
                          <input class="form-control example <?= form_error('std') ? 'is-invalid' : '';?>" value="<?= set_value('std');?>" type="number" onKeyPress="if(this.value.length==5) return false;" name="std"  id="std" Placeholder="STD Code(Optional)" >
                        </div>
                      </div>
                    </div>
                      
                    <div class="col-sm-9">          
                      <div class="form-group">
                        <label for="telephone" class="form-control-label">Telephone Number</label>
                        <div class="mb-3">
                          <input class="form-control example <?= form_error('telephone') ? 'is-invalid' : '';?>" value="<?= set_value('telephone');?>" type="number" onKeyPress="if(this.value.length==8) return false;" name="telephone"  id="telephone" Placeholder="Telephone Number(Optional)" >
                        </div>
                      </div>
                    </div>
                  </div>
                  
                  <div class="form-group">
                    <label for="email" class="form-control-label">Email <span class="text-danger">*</span></label>
                    <div class="mb-3">
                      <input class="form-control <?= form_error('email') ? 'is-invalid' : '';?>" value="<?= set_value('email');?>" type="email" name="email"  id="email" Placeholder="Email" >
                    </div>
                  </div>
                  <?= (strip_tags(form_error('email')) == "This email address is already taken. Please choose another.") ? form_error('email') : ' '; ?>
                  
                  <div class="form-group">
                    <label for="password" class="form-control-label">Password <span class="text-danger">*</span></label>
                    <div class="mb-3">
                      <input class="form-control <?= form_error('password') ? 'is-invalid' : '';?>" value="<?= set_value('password');?>" type="password" name="password"  id="password" Placeholder="Password" >
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="cpassword" class="form-control-label">Confirm Password <span class="text-danger">*</span></label>
                    <div class="mb-3">
                      <input class="form-control <?= form_error('cpassword') ? 'is-invalid' : '';?>" value="<?= set_value('cpassword');?>" type="password" name="cpassword"  id="cpassword" Placeholder="Confirm Password" >
                    </div>
                  </div>
                  <?= (strip_tags(form_error('cpassword')) == "Password and Confirm Password Doesn't Matches.") ? form_error('cpassword') : ' '; ?>
                </div>
              </div>

              <div class="card z-index-1 mt-5 mb-5">
                <div class="card-header text-center pt-3 pb-3">
                  <h5>Declaration</h5>
                </div>
                <div class="card-body pt-3 pb-3">
                  
                  <div class="form-check form-check-info text-left">
                    <input class="form-check-input" type="checkbox" value="Checked" id="checkme" >
                    <label class="form-check-label" for="checkme">
                      I agree the <a href="<?= base_url().'others/Terms_conditions/Terms_conditions/index'; ?>" class="text-dark font-weight-bolder">Terms and Conditions</a>
                    </label>
                  </div>

                  <div class="text-center">
                    <input type="submit" id="signup" name="Sign up" class="btn bg-gradient-dark w-100 my-4 mb-2" disabled>
                  </div>
                  <p class="text-sm mt-3 mb-0">Already have an account? <a href="<?= base_url().'login/login/index'; ?>" class="text-dark font-weight-bolder">Sign in</a></p>
                  
                  <script type="text/javascript">
                    var checker = document.getElementById('checkme');
                    var sendbtn = document.getElementById('signup');
                    checker.onchange = function() {
                      if (this.checked) {
                          sendbtn.disabled = false;
                      } else {
                          sendbtn.disabled = true;
                      }
                    }            
                  </script>

                </div>
              </div>

            </form>
          </div>

        </div>
      </div>
    </div>
  </section>

  <footer class="footer py-5 ">
    <div class="container">
      <div class="row">
        <div class="col-8 mx-auto text-center mt-1 ">
          <p class="mb-0 text-secondary text-dark">
            Copyright © <script>
              document.write(new Date().getFullYear())
            </script> Sagar Variya Productions Inc
          </p>
        </div>
      </div>
    </div>
  </footer>

  <script src="<?= base_url("public/login/");?>assets/js/core/popper.min.js"></script>
  <script src="<?= base_url("public/login/");?>assets/js/core/bootstrap.min.js"></script>
  <script src="<?= base_url("public/login/");?>assets/js/plugins/smooth-scrollbar.min.js"></script>
  
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