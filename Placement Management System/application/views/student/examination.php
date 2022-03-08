<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <title>Examination</title>
    
    <meta name="author" content="Sagar Variya">
     <link rel="stylesheet" href="<?= base_url("public/admin/");?>plugins/fontawesome-free/css/all.min.css"> 
    <link rel="stylesheet" href="<?= base_url("public/admin/");?>plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <link rel="stylesheet" href="<?= base_url("public/admin/");?>dist/css/adminlte.min.css">

    
    <link rel="icon" type="image/png" href="<?= base_url().'uploads/system/logo.svg';?>">



    <script type="text/javascript">
        var countDownDateE = new Date("<?= date($requirement['company_requirement_exam_date_end']);?>").getTime();

        var xE = setInterval(function() {

            var now = new Date().getTime();
                
            var distanceE = countDownDateE - now;
                
            var days = Math.floor(distanceE / (1000 * 60 * 60 * 24));
            var hours = Math.floor((distanceE % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            var minutes = Math.floor((distanceE % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((distanceE % (1000 * 60)) / 1000);
                
            document.getElementById("timer").innerHTML = "Time : " + days + "d " + hours + "h "
            + minutes + "m " + seconds + "s ";

            if (distanceE < 0) {
                clearInterval(xE);
                document.getElementById("timer").innerHTML = "Time : Over";
                document.getElementById("timer").style.color = "#f5365c";
                
                var i;
                for (i = 0; i < <?= $totalExamQues ; ?>; i++) {
                    document.getElementById("submit"+i).style.pointerEvents = "none";
                    document.getElementById("submit"+i).style.backgroundColor = "#f5365c";
                    document.getElementById("submit"+i).style.borderColor = "#f5365c";
                    document.getElementById("submit"+i).disabled = "true";
                }
            }
            
        }, 1000);
    </script>

</head>

<body>
    
    <nav class="navbar sticky-top navbar-light bg-light">
        <div class="container-fluid">
            <div class="col-8">
                <p id="timer" class="font-weight-bold"></p>
                <p id="totalTime" class="font-weight-bold">Total Time: <?php 
                $t2=strtotime($requirement['company_requirement_exam_date_end']);
                $t1=strtotime($requirement['company_requirement_exam_date']);
                $hours = ($t2 - $t1)/3600;
                echo floor((($t2 - $t1)/60)/60)."h : ".(($hours - floor($hours)) * 60 )."m" ; ?></p>
            </div>
        
            <div class="col-4">
                
                <div class="text-right">
                    
                        <img alt="Image placeholder" src="<?= base_url().$userInfo['profile_thumb'] ;?>">

                        <span class="d-none d-sm-block mb-0 text-sm font-weight-bold"><?= $userInfo['fname']." ".$userInfo['mname']." ".$userInfo['lname'] ;?></span>
 
                </div>
            
            </div>
        </div>
    </nav>

                <div class="card-body pt-0" >

                    <h6 class="heading-small text-muted mb-4">Requirement information</h6>
                    <div class="pl-lg-4 ">
    
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
                                <label for="post" class="form-control-label">Total Questions</label>
                                <div class="mb-3">
                                    <div name="post" id="post" class="form-control " ><?= $totalExamQues ; ?></div>
                                </div>
                            </div>
                        </div>
                           
                        <div class="row">
                            <div class="col-sm-3">
                                <label for="post" class="form-control-label">Post</label>
                                <div class="mb-3">
                                    <div name="post" id="post" class="form-control " ><?= $requirement['company_requirement_post'] ; ?></div>
                                </div>
                            </div>
    
                            <div class="col-sm-3">
                                <label for="date_exam" class="form-control-label">Exam Date</label>
                                <div class="form-control date  mb-3" name="date_exam" id="date_exam<?//echo $j;?>"><?= date('d-m-Y', strtotime($requirement['company_requirement_exam_date'])) ;?></div>
                            </div>
    
                            <div class="col-sm-4">
                                <label for="time_exam" class="form-control-label">Total Time</label>
                                <p class="form-control time mb-3" name="time_exam" id="time_exam<?//echo $j;?>"><?= 
                                date('H:i A', strtotime($requirement['company_requirement_exam_date']))." - ".date('H:i A', strtotime($requirement['company_requirement_exam_date_end'])) ;?></p>
                            </div>
                            
                            <div class="col-sm-2">
                                <label for="post" class="form-control-label">Total Answered</label>
                                <div class="mb-3">
                                    <div name="post" id="post" class="form-control " ><?= $totalAnsSubmited ; ?></div>
                                </div>
                            </div>
                            
                        </div>
                           
                           <?php
                                    if ( !empty($this->session->flashdata('queESave')) ) {
                                    echo "
                                        <div class='alert alert-danger alert-dismissible fade show' role='alert'>
                                        <span class='alert-icon'><i class='fas fa-ban'></i></span>
                                        <span class='alert-text'>".$this->session->flashdata('queESave')."</span>
                                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                        <span aria-hidden='true'>&times;</span>
                                        </button>
                                        </div>";
                                    }
    
                                    if ( !empty($this->session->flashdata('queSSave')) ) {
                                        echo "
                                        <div class='alert alert-success alert-dismissible fade show' role='alert'>
                                        <span class='alert-icon'><i class='fas fa-check'></i></span>
                                        <span class='alert-text'>".$this->session->flashdata('queSSave')."</span>
                                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                        <span aria-hidden='true'>&times;</span>
                                        </button>
                                        </div>";
                                    }           
                            ?>
    
                        <h6 class="heading-small text-muted mb-4 ">Exam Quetions</h6>
                        
                        <div class="card">
                            <table class="table table-hover">
                            
                            <thead>
                                <tr>
                                    <th scope="col" style="width:2%;" >No.</th>
                                    <th scope="col" style="width:92%;">Questions</th>
                                    <th scope="col" style="width:5%;" >#</th>
                                </tr>
                            </thead>
    
                                <tbody>
    
                                    <?php $i = 0; if ( !empty($examQues) ) { foreach ($examQues as $examQue) { ?> 
    
                                        <form action="<?= base_url().'student/examination/save/'.$requirement['company_requirement_id'].'/'.$requirement['company_id'].'/'.$examQue['exam_question_id'].'/'.$userInfo['sid'] ; ?>"  method="POST" autocomplete="off">
    
                                            <tr class="fw-bolder bg-gray" >
                                                <th><?= $i+1 ;?></th>
                                                <td><label  class="form-control-label ml-0"><?= $examQue['question_description'] ;?></label></td>
                                                <td><button type="submit" id="submit<?= $i;?>" class="btn-primary">Submit</button></td>
                                            </tr>
                                            <tr class="bg-light"><td colspan="3" class="pl-4"><input class="form-check-input" <?= ( ($examQue['ansSubmitted'] == $examQue['option_1'] ) ? "checked" : "" ) ;?> type="radio" value="<?= $examQue['option_1'] ;?>" name="que<?= $examQue['exam_question_id'];?>" id="que<?= $i;?>1" ><label class="ml-1" for="que<?= $i;?>1" ><?= $examQue['option_1'] ;?></label></td></tr>
                                            
                                            <tr class="bg-light"><td colspan="3" class="pl-4"><input class="form-check-input" <?= ( ($examQue['ansSubmitted'] == $examQue['option_2'] ) ? "checked" : "" ) ;?> type="radio" value="<?= $examQue['option_2'] ;?>" name="que<?= $examQue['exam_question_id'];?>" id="que<?= $i;?>2" ><label  class="ml-1" for="que<?= $i;?>2" ><?= $examQue['option_2'] ;?></label></td></tr>
                                            
                                            <tr class="bg-light"><td colspan="3" class="pl-4"><input class="form-check-input" <?= ( ($examQue['ansSubmitted'] == $examQue['option_3'] ) ? "checked" : "" ) ;?> type="radio" value="<?= $examQue['option_3'] ;?>" name="que<?= $examQue['exam_question_id'];?>" id="que<?= $i;?>3" ><label class="ml-1" for="que<?= $i;?>3" ><?= $examQue['option_3'] ;?></label></td></tr>
                                            
                                            <tr class="bg-light"><td colspan="3" class="pl-4"><input class="form-check-input" <?= ( ($examQue['ansSubmitted'] == $examQue['option_4'] ) ? "checked" : "" ) ;?> type="radio" value="<?= $examQue['option_4'] ;?>" name="que<?= $examQue['exam_question_id'];?>" id="que<?= $i;?>4" ><label  class="ml-1" for="que<?= $i;?>4" ><?= $examQue['option_4'] ;?></label></td></tr>
                                            
                                            
                                        </form>
    
                                    <?php $i++; } } ?>
    
                                </tbody>
                        </table>
                        </div>
    
                    </div>

            </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>

<script src="<?= base_url("public/admin/");?>plugins/jquery/jquery.min.js"></script>

<script src="<?= base_url("public/admin/");?>plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>

<script src="<?= base_url("public/admin/");?>dist/js/adminlte.min.js"></script>



</body>
</html>
