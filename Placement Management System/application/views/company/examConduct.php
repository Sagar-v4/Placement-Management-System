<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link rel="icon" type="image/png" href="<?= base_url().'uploads/system/logo.svg';?>">
     <link rel="stylesheet" href="<?= base_url("public/stu-com/");?>assets/vendor/@fortawesome/fontawesome-free/css/all.min.css" type="text/css"> 

    <title>Exam Conduct</title>


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
                    
                    <div class="col-sm-2">
                        <label for="post" class="form-control-label">Exam Date</label>
                        <div class="mb-3">
                            <div name="post" id="post" class="form-control " ><?= date('j-n-Y', strtotime($requirement['company_requirement_exam_date'])) ;?></div>
                        </div>
                    </div>
                    
                    <div class="col-sm-2">
                        <label for="post" class="form-control-label">Exam Time</label>
                        <div class="mb-3">
                            <div name="post" id="post" class="form-control " ><?= date('H:i A', strtotime($requirement['company_requirement_exam_date'])) ;?></div>
                        </div>
                    </div>
                    
                    <div class="col-sm-2">
                        <label for="post" class="form-control-label">Total Hrs</label>
                        <div class="mb-3">
                            <div name="post" id="post" class="form-control "><?php 
                                $t2=strtotime($requirement['company_requirement_exam_date_end']);
                                $t1=strtotime($requirement['company_requirement_exam_date']);
                                $hours = ($t2 - $t1)/3600;
                                echo floor((($t2 - $t1)/60)/60)."h : ".(($hours - floor($hours)) * 60 )."m" ; ?></div>
                        </div>
                    </div>
                    
                    <div class="col-sm-2">
                        <label for="post" class="form-control-label">Total Questions</label>
                        <div class="mb-3">
                            <div name="post" id="post" class="form-control " ><?= $totalQues ; ?></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

                <?php
                if ( !empty($this->session->flashdata('queESave')) ) {
                    echo "
                    <div class='alert alert-danger alert-dismissible fade show' role='alert'>
                      <i class='icon fas fa-ban'></i> ".$this->session->flashdata('queESave')."
                      <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                    </div>";
                }

                if ( !empty($this->session->flashdata('queSSave')) ) {
                    echo "
                    <div class='alert alert-success alert-dismissible fade show' role='alert'>
                      <i class='icon fas fa-check'></i> ".$this->session->flashdata('queSSave')."
                      <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                    </div>";
                }           
                ?>

        <!--<h2><?= $requirement['company_name'] ;?> - <?= $requirement['company_requirement_name'] ;?> - <?= $requirement['company_requirement_post'] ;?> - <?= $requirement['company_requirement_vacancy'] ;?></h2>-->
        
        <table class="table table-hover">
        
            <thead>
                <tr>
                    <th scope="col">No.</th>
                    <th scope="col">Question</th>
                    <th scope="col">Option 1</th>
                    <th scope="col">Option 2</th>
                    <th scope="col">Option 3</th>
                    <th scope="col">Option 4</th>
                    <th scope="col">Option Correct</th>
                    <th scope="col">#</th>
                </tr>
            </thead>

                <tbody>

                    <?php $i = 0; if( !empty($examQues) ) { foreach ($examQues as $examQue) { ?> 

                        <tr >
                            <th scope="row"><?= $i+1 ;?></th>
                            <td><?= $examQue['question_description'] ;?></td>
                            <td><?= $examQue['option_1'] ;?></td>
                            <td><?= $examQue['option_2'] ;?></td>
                            <td><?= $examQue['option_3'] ;?></td>
                            <td><?= $examQue['option_4'] ;?></td>
                            <td><?= $examQue['option_correct'] ;?></td>
                            <td>
                                <button type="button" data-bs-toggle="modal" data-bs-target="#model-que<?= $i;?>" class="btn btn-info rounded p-2 text-white "><i class="fas fa-edit"></i></button>
                                <a type="button" href="<?= base_url().'company/ExamConduct/delete/'.$requirement['company_requirement_id'].'/'.$requirement['company_id'].'/'.$examQue['exam_question_id']  ;?>"><button class="btn btn-danger rounded p-2 text-white "><i class="fas fa-trash"></i> </button> </a>
                            </td>
                        </tr>
                        
                        <div class="modal fade" id="model-que<?= $i;?>" role="dialog">
                            <div class="modal-dialog modal-xl">
                                
                                <div class="modal-content">
                                    <div class="modal-body">
                                        <div class="container-fluid">

                                            <form action="<?= base_url().'company/ExamConduct/edit/'.$requirement['company_requirement_id'].'/'.$requirement['company_id'].'/'.$examQue['exam_question_id'] ; ?>"  method="POST" autocomplete="off">
                                            
                                                <div class="row">
                                                    <label for="question_edit" class="form-control-label">Question</label>
                                                    <div class="mb-3">
                                                        <textarea type="text" required name="question_edit" id="question_edit" class="form-control " placeholder="question"><?= $examQue['question_description'] ;?></textarea>
                                                    </div>
                                                </div>
                                                
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <label for="option_1_edit" class="form-control-label">Option 1</label>
                                                        <div class="mb-3">
                                                            <textarea type="text" required name="option_1_edit" id="option_1_edit" class="form-control " placeholder="option 1"><?= $examQue['option_1'] ;?></textarea>
                                                        </div>
                                                    </div>
                                                
                                                    <div class="col-sm-6">
                                                        <label for="option_2_edit" class="form-control-label">Option 2</label>
                                                        <div class="mb-3">
                                                            <textarea type="text" required name="option_2_edit" id="option_2_edit" class="form-control " placeholder="option 2"><?= $examQue['option_2'] ;?></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <div class="row">
                                                    <div class="col-sm-6">

                                                        <label for="option_3_edit" class="form-control-label">Option 3</label>
                                                        <div class="mb-3">
                                                            <textarea type="text" required name="option_3_edit" id="option_3_edit" class="form-control " placeholder="option 3"><?= $examQue['option_3'] ;?></textarea>
                                                        </div>
                                                    </div>
                                                
                                                    <div class="col-sm-6">
                                                        <label for="option_4_edit" class="form-control-label">Option 4</label>
                                                        <div class="mb-3">
                                                            <textarea type="text" required name="option_4_edit" id="option_4_edit" class="form-control " placeholder="option 4"><?= $examQue['option_4'] ;?></textarea>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <label for="option_correct_edit" class="form-control-label">Option Correct</label>
                                                    <div class="mb-3">
                                                        <textarea type="text" required name="option_correct_edit" id="option_correct_edit" class="form-control " placeholder="correct option"><?= $examQue['option_correct'] ;?></textarea>
                                                    </div>
                                                </div>

                                                 <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    <button type="submiy" class="btn btn-primary">Update</button>
                                                 </div>

                                            </form>
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php $i++; } } ?>
                    
                    <form action="<?= base_url().'company/ExamConduct/save/'.$requirement['company_requirement_id'].'/'.$requirement['company_id'] ; ?>"  method="POST" autocomplete="off">

                        <tr>

                            <th scope="row"><?= $i+1; ?></th>
                            <td><div class="form-group"><textarea class="form-control <?= form_error('question') ? 'is-invalid' : '';?>" name="question" id="question" rows="3" placeholder="Question" required></textarea></div></td>
                            <td><div class="form-group"><textarea class="form-control <?= form_error('option_1') ? 'is-invalid' : '';?>" name="option_1" id="option_1" rows="3" placeholder="Option 1" required></textarea></div></td>
                            <td><div class="form-group"><textarea class="form-control <?= form_error('option_2') ? 'is-invalid' : '';?>" name="option_2" id="option_2" rows="3" placeholder="Option 2" required></textarea></div></td>
                            <td><div class="form-group"><textarea class="form-control <?= form_error('option_3') ? 'is-invalid' : '';?>" name="option_3" id="option_3" rows="3" placeholder="Option 3" required></textarea></div></td>
                            <td><div class="form-group"><textarea class="form-control <?= form_error('option_4') ? 'is-invalid' : '';?>" name="option_4" id="option_4" rows="3" placeholder="Option 4" required></textarea></div></td>
                            <td><div class="form-group"><textarea class="form-control <?= form_error('option_correct') ? 'is-invalid' : '';?>" name="option_correct" id="option_correct" rows="3" placeholder="Option Correct" required></textarea></div></td>
                            <td>
                                <button type="submit" id="submit" class="btn btn-primary">Submit</button>
                            </td>                                            

                        </tr>                                    
                    
                    </form>

                    


                </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>

</body>
</html>