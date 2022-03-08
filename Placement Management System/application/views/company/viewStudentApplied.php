<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link rel="icon" type="image/png" href="<?= base_url().'uploads/system/logo.svg';?>">
    <link rel="icon" href="<?= base_url("public/stu-com/");?>assets/img/brand/favicon.png" type="image/png">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
    <link rel="stylesheet" href="<?= base_url("public/stu-com/");?>assets/vendor/nucleo/css/nucleo.css" type="text/css">
    <link rel="stylesheet" href="<?= base_url("public/stu-com/");?>assets/vendor/@fortawesome/fontawesome-free/css/all.min.css" type="text/css">
    <link rel="stylesheet" href="<?= base_url("public/stu-com/");?>assets/css/argon.css?v=1.2.0" type="text/css">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
    

    <title>Applied Students</title>


    <style>
            
        /* The Modal (background) */
        .modal {
        display: none; /* Hidden by default */
        position: fixed; /* Stay in place */
        z-index: 1; /* Sit on top */
        padding-top: 100px; /* Location of the box */
        left: 0;
        top: 0;
        width: 100%; /* Full width */
        height: 100%; /* Full height */
        overflow: auto; /* Enable scroll if needed */
        background-color: rgb(0,0,0); /* Fallback color */
        background-color: rgba(0,0,0,0.9); /* Black w/ opacity */
        }

        /* Modal Content (image) */
        .modal-content {
        margin: auto;
        display: block;
        width: 80%;
        max-width: 700px;
        }

        /* Caption of Modal Image */
        .caption {
        margin: auto;
        display: block;
        width: 80%;
        max-width: 700px;
        text-align: center;
        color: #ccc;
        padding: 10px 0;
        height: 150px;
        }

        /* Add Animation */
        .modal-content, .caption {  
        -webkit-animation-name: zoom;
        -webkit-animation-duration: 0.6s;
        animation-name: zoom;
        animation-duration: 0.6s;
        }

        @-webkit-keyframes zoom {
        from {-webkit-transform:scale(0)} 
        to {-webkit-transform:scale(1)}
        }

        @keyframes zoom {
        from {transform:scale(0)} 
        to {transform:scale(1)}
        }

        /* The Close Button */
        .close {
        position: absolute;
        top: 15px;
        right: 35px;
        color: #f1f1f1;
        font-size: 40px;
        font-weight: bold;
        transition: 0.3s;
        }

        .close:hover,
        .close:focus {
        color: #bbb;
        text-decoration: none;
        cursor: pointer;
        }

        /* 100% Image Width on Smaller Screens */
        @media only screen and (max-width: 700px){
            .modal-content {
                width: 100%;
            }
        }
        
    </style>
  </head>
  <body>

    <div class="table-responsive">
        
        <div class="card mx-1 px-2 my-2">
            
            <h6 class="heading-small text-muted mb-2">Requirement information</h6>
            <div class="px-4 ">

                <div class="row">
                    <div class="col-sm-4">
                        <label for="requirement_name" class="form-control-label">Company Name</label>
                        <div class="mb-3">
                            <div name="requirement_name" id="requirement_name" class="form-control " ><?= $requirement[0]['company_name'] ; ?></div>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <label for="requirement_name" class="form-control-label">Requirement Name</label>
                        <div class="mb-3">
                            <div name="requirement_name" id="requirement_name" class="form-control " ><?= $requirement[0]['company_requirement_name'] ; ?></div>
                        </div>
                    </div>
                    
                    <div class="col-sm-2">
                        <label for="post" class="form-control-label">Total Vacancy</label>
                        <div class="mb-3">
                            <div name="post" id="post" class="form-control " ><?= $requirement[0]['company_requirement_vacancy'] ; ?></div>
                        </div>
                    </div>
                </div>
                   
                <div class="row">
                    <div class="col-sm-4">
                        <label for="post" class="form-control-label">Post</label>
                        <div class="mb-3">
                            <div name="post" id="post" class="form-control " ><?= $requirement[0]['company_requirement_post'] ; ?></div>
                        </div>
                    </div>
                    
                    <div class="col-sm-2">
                        <label for="post" class="form-control-label">Total Students</label>
                        <div class="mb-3">
                            <div name="post" id="post" class="form-control " ><?= $totalStud ; ?></div>
                        </div>
                    </div>
                    
                    <div class="col-sm-2">
                        <label for="post" class="form-control-label">Total Applied</label>
                        <div class="mb-3">
                            <div name="post" id="post" class="form-control " ><?= $totalApplied ; ?></div>
                        </div>
                    </div>
                    
                    <div class="col-sm-2">
                        <label for="post" class="form-control-label">Total revoked</label>
                        <div class="mb-3">
                            <div name="post" id="post" class="form-control " ><?= $totalRevoked ; ?></div>
                        </div>
                    </div>
                    
                    <div class="col-sm-2">
                        <label for="post" class="form-control-label">Total Banned</label>
                        <div class="mb-3">
                            <div name="post" id="post" class="form-control " ><?= $totalBanned ; ?></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <form action="<?= base_url().'company/view/cancelExam/'.$requirement[0]['company_requirement_id'].'/'.$requirement[0]['company_id']; ?>" name="cancelExam" id="cancelExam" method="POST" role="form " autocomplete="off">
            
        <input type="submit" class="btn text-white m-2" id="submit" style="background-color: #565656;" name="submit" value="Update Ban" >
            
            <table class="table table-hover">
            
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Ban</th>
                        <th scope="col">Pic</th>
                        <th scope="col">Student Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Gender</th>
                        <th scope="col">DOB</th>
                        <th scope="col">Mobile No</th>
                        <th scope="col">10<sup>th</sup></th>
                        <th scope="col">12<sup>th</sup></th>
                        <th scope="col">Degree</th>
                        <th scope="col">University</th>
                        <th scope="col">Passing</th>
                        <th scope="col">Percentage</th>
                        <th scope="col">CGPA</th>
                    </tr>
                </thead>

                    <tbody>

                        <?php if ( !empty($totalStudentApplied) ) { $i = 0; foreach ($totalStudentApplied as $studentData) { ?> 

                            <tr class="<?= ( $studentApplieds[$i]['student_applied_req_status'] != 1) ? 'table-info' : '' ;?> <?= ( ( $studentApplieds[$i]['company_requirement_exam_status'] != 1) && ( $studentApplieds[$i]['company_requirement_interview_status'] != 1)) ? 'table-danger' : '' ;?>">
                                <th scope="row"><?= $i+1 ;?></th>
                                <td><input type="checkbox" id="Exam" name="<?= $studentApplieds[$i]['student_applied_req_id'];?>" value="<?= $studentApplieds[$i]['student_applied_req_id'];?>" <?= ($studentApplieds[$i]['company_requirement_exam_status'] == 1) ? '' : 'checked' ;?>></td>
                                <td class="p-1">
                                    <span class="avatar avatar-sm rounded-circle ">
                                        <img class="" id="myImg<?= $i;?>" alt="<?= $studentData['student_first_name'].' '.$studentData['student_middle_name'].' '.$studentData['student_last_name'] ;?>" src="<?= base_url().$studentData[0]['student_profile_pic'] ;?>">
                                    </span>
                                </td>
                                <td><?= $studentData['student_first_name'].' '.$studentData['student_middle_name'].' '.$studentData['student_last_name'] ;?></td>
                                <td><?= $studentData['student_email'] ;?></td>
                                <td><?= $studentData['student_gender'] ;?></td>
                                <td><?= date_format(date_create($studentData['student_dob']) ,"d-m-Y") ;?></td>
                                <td><?= $studentData['student_phone_number'] ;?></td>
                                <td><?= $studentData['student_percentage_10th'] ;?></td>
                                <td><?= $studentData['student_percentage_12th'] ;?></td>
                                <td><?= $studentData['student_high_degree'] ;?></td>
                                <td><?= $studentData['student_high_university'] ;?></td>
                                <td><?= date('F Y', strtotime($studentData['student_high_passing'])) ;?></td>
                                <td><?= $studentData['student_high_percentage'] ;?></td>
                                <td><?= $studentData['student_high_cgpa'] ;?></td>
                                
                            </tr>

                        <?php $i++; } } ?>

                    </tbody>
            </table>

        </form>
    </div>

    <?php if ( !empty($totalStudentApplied) ) { $i = 0; foreach ($totalStudentApplied as $studentData) { ?> 
    
        <div id="myModal<?= $i;?>" class="modal">
            <span  class="close">&times;</span>
            <img class="modal-content" id="img01<?= $i;?>">
            <div class="caption" id="caption<?= $i;?>"></div>
        </div>
    
    <?php $i++; } } ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
    <script src="<?= base_url("public/stu-com/");?>assets/vendor/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
    <script src="<?= base_url("public/stu-com/");?>assets/vendor/jquery/dist/jquery.min.js"></script>
    <script src="<?= base_url("public/stu-com/");?>assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url("public/stu-com/");?>assets/vendor/js-cookie/js.cookie.js"></script>
    <script src="<?= base_url("public/stu-com/");?>assets/vendor/jquery.scrollbar/jquery.scrollbar.min.js"></script>
    <script src="<?= base_url("public/stu-com/");?>assets/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js"></script>
    <script src="<?= base_url("public/stu-com/");?>assets/js/argon.js?v=1.2.0"></script>
    
    <script>

        <?php if ( !empty($totalStudentApplied) ) { $i = 0; foreach ($totalStudentApplied as $studentData) { ?> 

            var span = document.getElementsByClassName("close");

            var modal<?= $i;?> = document.getElementById("myModal<?= $i;?>");

            var img<?= $i;?> = document.getElementById("myImg<?= $i;?>");
            var modalImg<?= $i;?> = document.getElementById("img01<?= $i;?>");
            var captionText<?= $i;?> = document.getElementById("caption<?= $i;?>");

            img<?= $i;?>.onclick = function(){
            modal<?= $i;?>.style.display = "block";
            modalImg<?= $i;?>.src = this.src;
            captionText<?= $i;?>.innerHTML = this.alt;
            }

            modal<?= $i;?>.onclick = function() { 
                modal<?= $i;?>.style.display = "none";
            }

        <?php $i++; } } ?>

    </script>

  </body>
</html>