<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
  <link rel="icon" type="image/png" href="<?= base_url().'uploads/system/logo.svg';?>">
    <title>Interview Conduct</title>
    
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
  <body>


                    <div class="m-4 table-responsive">
                        <div class="card mx-1 px-2 my-2">
            
                            <h6 class="heading-small text-muted mb-2">Requirement information</h6>
                            <div class="px-4 ">
                
                                <div class="row">
                                    <div class="col-sm-4">
                                        <label for="requirement_name" class="form-control-label">Company Name</label>
                                        <div class="mb-3">
                                            <div name="requirement_name" id="requirement_name" class="form-control " ><?= $requirement['company_name'] ; ?></div>
                                        </div>
                                    </div>
                
                                    <div class="col-sm-6">
                                        <label for="requirement_name" class="form-control-label">Requirement Name</label>
                                        <div class="mb-3">
                                            <div name="requirement_name" id="requirement_name" class="form-control " ><?= $requirement['company_requirement_name'] ; ?></div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-sm-2">
                                        <label for="post" class="form-control-label">Total Vacancy</label>
                                        <div class="mb-3">
                                            <div name="post" id="post" class="form-control " ><?= $requirement['company_requirement_vacancy'] ; ?></div>
                                        </div>
                                    </div>
                                </div>
                                   
                                <div class="row">
                                    <div class="col-sm-4">
                                        <label for="post" class="form-control-label">Post</label>
                                        <div class="mb-3">
                                            <div name="post" id="post" class="form-control " ><?= $requirement['company_requirement_post'] ; ?></div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-sm-3">
                                        <label for="post" class="form-control-label">Interview Start </label>
                                        <div class="mb-3">
                                            <div name="post" id="post" class="form-control " ><?= date('j-n-Y H:i A', strtotime($requirement['company_requirement_interview_date'])) ;?></div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-sm-3">
                                        <label for="post" class="form-control-label">Interview End</label>
                                        <div class="mb-3">
                                            <div name="post" id="post" class="form-control " ><?= date('j-n-Y H:i A', strtotime($requirement['company_requirement_interview_date_end'])) ;?></div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-sm-2">
                                        <label for="post" class="form-control-label">Total Candidates</label>
                                        <div class="mb-3">
                                            <div name="post" id="post" class="form-control " ><?= $totalCandidates ; ?></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                                <?php
                                if ( !empty($this->session->flashdata('queESave')) ) {
                                echo "
                                    <div class='alert alert-danger alert-dismissible fade show' role='alert'>
                                    <span class='alert-icon'><i class='fas fa-ban'></i></span>
                                    <span class='alert-text'>".$this->session->flashdata('queESave')."</span>
                                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                    <span aria-hidden='true'>&times;</span>
                                    </button>
                                    </div>";
                                }

                                if ( !empty($this->session->flashdata('queSSave')) ) {
                                    echo "
                                    <div class='alert alert-success alert-dismissible fade show' role='alert'>
                                    <span class='alert-icon'><i class='fas fa-check'></i></span>
                                    <span class='alert-text'>".$this->session->flashdata('queSSave')."</span>
                                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                    <span aria-hidden='true'>&times;</span>
                                    </button>
                                    </div>";
                                }           
                                ?>

                        
                        <table class="table table-hover">
                        
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
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

                                    <form action="<?= base_url().'company/InterviewConduct/save/'.$requirement['company_requirement_id'].'/'.$requirement['company_id'] ; ?>"  method="POST" autocomplete="off">
                                        
                                        <input type="submit" class="btn text-white m-2" id="submit" style="background-color: #565656;" name="submit" value="Update Interview Sessions" >
                                        
                                        <?php $i = 0; if ( !empty($interviewStudents) ) { foreach ($interviewStudents as $interviewStudent) { ?> 

                                            <tr>

                                                <th scope="row" rowspan="2"><?= $i+1 ;?></th>
                                                <td><?= $interviewStudent[0]['student_first_name']." ".$interviewStudent[0]['student_middle_name']." ".$interviewStudent[0]['student_last_name'] ;?></td>
                                                <td><?= $interviewStudent[0]['student_email'] ;?></td>
                                                <td><?= $interviewStudent[0]['student_gender'] ;?></td>
                                                <td><?= date_format(date_create($interviewStudent[0]['student_dob']) ,"d-m-Y") ;?></td>
                                                <td><?= $interviewStudent[0]['student_phone_number'] ;?></td>
                                                <td><?= $interviewStudent[0]['student_percentage_10th'] ;?></td>
                                                <td><?= $interviewStudent[1]['student_percentage_12'] ;?></td>
                                                <td><?= $interviewStudent[0]['student_high_degree'] ;?></td>
                                                <td><?= $interviewStudent[0]['student_high_university'] ;?></td>
                                                <td><?= $interviewStudent[0]['student_high_passing'] ;?></td>
                                                <td><?= $interviewStudent[1]['student_percentage'] ;?></td>
                                                <td><?= $interviewStudent[1]['student_cgpa'] ;?></td>

                                            </tr>   
                                            <tr>
                                                <td>
                                                    <input type="datetime-local" class="form-control date mb-3" value="<?php if(!empty($interviewStudent['interview_time'])) echo date('Y-m-d\TH:i', strtotime($interviewStudent['interview_time'])) ;?>" name="date<?= $interviewStudent['interview_pass_id']; ?>" id="date<?= $interviewStudent['interview_pass_id']; ?>">
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control mb-3" value="<?= $interviewStudent['interview_link'] ;?>" name="link<?= $interviewStudent['interview_pass_id']; ?>" id="link<?= $interviewStudent['interview_pass_id']; ?>" placeholder="Interview Link">
                                                </td>
                                                <td>
                                                    <input type="number" class="form-control mb-3" value="<?= $interviewStudent['candidates_marks'] ;?>" name="mark<?= $interviewStudent['interview_pass_id']; ?>" id="mark<?= $interviewStudent['interview_pass_id']; ?>" placeholder="Marks">
                                                </td>
                                                <td colspan="9">
                                                    <div class="form-group">
                                                        <textarea class="form-control" rows="1" name="details<?= $interviewStudent['interview_pass_id']; ?>" id="details<?= $interviewStudent['interview_pass_id']; ?>" placeholder="Extra Details"><?= $interviewStudent['candidates_extra_detail']; ?></textarea>
                                                    </div>
                                                </td>
                                                
                                            </tr>

                                        <?php $i++; } } ?>

                                    </form>

                                </tbody>
                        </table>
                    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
    
    <script>


    </script>

  </body>
</html>