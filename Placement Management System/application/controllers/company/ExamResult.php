<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ExamResult extends CI_Controller {

	public function __construct() {

		// Session expire OR try to Login from the URL (Preventing)
		parent::__construct();

		// Session expire OR try to Login from the URL (Preventing)
		$company = $this->session->userdata( 'company' );

		if ( empty($company) ) {
			$this->session->set_flashdata('msg', 'Your Session has been expired. Please try again.');
			redirect(base_url().'login/login/index');
		}

		// Acount Active / Deactive
		$this->load->model('Check_status_model');
		$companyStatus = $this->Check_status_model->checkStatus( $this->session->userdata['company']['email'] );

		if ( $companyStatus != 1 ) {

			// Destroy session
			$this->session->set_flashdata('msg', 'Your account has been deactivated. Please contact administrator.');
			$this->session->unset_userdata( 'company' );
			redirect(base_url().'login/login/index');
		}
	}

    public function index( $comReqId, $comId ) {
        
        date_default_timezone_set('Asia/Kolkata');
                
		$this->load->model('Get_user_info_model');
		$userInfo = $this->Get_user_info_model->get_user_info( $this->session->userdata['company']['email'] );

		$this->db->where('company_requirement_id', $comReqId );
		$this->db->where('company_id', $comId );
		$requirement = $this->db->get('pms_company_requirements')->row_array();
            
        $this->db->select('COUNT(student_id) AS total_correct_ans');
        $this->db->select('student_id');
        $this->db->where('company_id', $comId );
        $this->db->where('company_requirement_id', $comReqId );
        $this->db->where('option_submitted = option_correct');
        $this->db->where('exam_question_submitted_at >=', $requirement['company_requirement_exam_date']);
        $this->db->where('exam_question_submitted_at <=', $requirement['company_requirement_exam_date_end']);
        $this->db->group_by('student_id');
        $studentPass = $this->db->get('pms_company_requirement_exam_submitted')->result_array();
        
		$this->db->where('company_requirement_id', $comReqId );
		$this->db->where('company_id', $comId );
		$totalCandidates = $this->db->count_all_results('pms_exam_pass');

        foreach ($studentPass as $student) {

            $insertData = array();
            $insertData['company_id'] = $comId;
            $insertData['company_requirement_id'] = $comReqId;
            $insertData['student_id'] = $student['student_id'];
            $insertData['total_correct_ans'] = $student['total_correct_ans'];
            $insertData['exam_pass_created_at'] = date('Y/m/d H:i:s', time());

            $this->db->where('company_id', $insertData['company_id']);
            $this->db->where('company_requirement_id', $insertData['company_requirement_id']);
            $this->db->where('student_id', $insertData['student_id']);
            $checkPassedStatus = $this->db->get('pms_exam_pass')->row_array();

            if ( empty($checkPassedStatus) ) {
                $this->db->insert('pms_exam_pass', $insertData);
            }        
        }

		$this->db->where('company_requirement_id', $comReqId);
		$this->db->where('company_id', $comId);
		$totalStudentApplied = $this->db->get('pms_student_applied_req')->result_array();

		$this->db->where('company_requirement_id', $comReqId );
		$this->db->where('company_id', $comId );
        $this->db->order_by('total_correct_ans', 'DESC');
		$studentPassed = $this->db->get('pms_exam_pass')->result_array();

        $studentPassInfos = array();
        $i = 0;
        foreach ( $studentPassed as $studentPass ) {

            $this->db->where('student_id', $studentPass['student_id'] );
            $studentPassInfos[$i] = $this->db->get('pms_student_info')->row_array();

            $this->db->where('student_id', $studentPass['student_id'] );
			$this->db->where('company_requirement_id', $comReqId);
			$this->db->where('company_id', $comId);
			$studentAppliedInfo = $this->db->get('pms_student_applied_req')->row_array();

			$studentPassInfos[$i]['student_high_percentage'] = $studentAppliedInfo['student_percentage'];
			$studentPassInfos[$i]['student_high_cgpa'] = $studentAppliedInfo['student_cgpa'];
			$studentPassInfos[$i]['student_percentage_12th'] = $studentAppliedInfo['student_percentage_12'];

			$this->db->where('student_id', $studentPass['student_id'] );
			array_push( $studentPassInfos[$i], $this->db->get('pms_student_media')->row_array() );

			array_push( $studentPassInfos[$i], $studentPassed[$i] );
            
            $i++;
        }
		
		foreach ( $totalStudentApplied as $studentApplied ) {

			$this->db->where('student_id', $studentApplied['student_id']);
			$studentCheck = $this->db->get('pms_exam_pass');

			if ( empty($studentCheck) ) {
				$update = array('company_requirement_interview_status' => 0);
				
				$this->db->where('student_id', $studentApplied['student_id']);
				$this->db->where('company_requirement_id', $comReqId);
				$this->db->where('company_id', $comId);
				$this->db->update('pms_student_applied_req', $update);
			}
		}

		$data['requirement'] = $requirement;
		$data['studentPassInfos'] = $studentPassInfos;
		$data['studentPassed'] = $studentPassed;
		$data['totalCandidates'] = $totalCandidates;
		
		date_default_timezone_set("Asia/Kolkata");
		$current = strtotime(date("Y-m-d H:i:s", time()));
		$end = strtotime( $requirement['company_requirement_exam_date_end'] );
		
        if ( $current > $end ) {
		
    		if ( $userInfo['cid'] == $comId ) {
    			$this->load->view('company/examresult', $data);
    		} else {
    			$data['heading'] = "404";
    			$data['message'] = "Page Not Found";
    
    			$this->load->view('errors/html/error_404', $data);
    		}
        }

    }

	public function interviewCall( $comReqId, $comId ) {

        $this->load->library('form_validation');
        date_default_timezone_set('Asia/Kolkata');

		$this->db->where('company_id', $comId);
		$this->db->where('company_requirement_id', $comReqId);
		$allStudents = $this->db->get('pms_exam_pass')->result_array();
		
		$this->db->where('company_requirement_id', $comReqId);
		$requirementInfo = $this->db->get('pms_company_requirements')->row_array();
		
		$this->db->where('company_id', $comId);
		$comInfo = $this->db->get('pms_company_info')->row_array();

		if( !empty($allStudents) ) {
			foreach ($allStudents as $student) {

				$result = $this->input->post($student['exam_pass_id'],TRUE)==null ? 0 : 1;

				$update = array(
					'pms_interview_call' => $result
				);
				
				$this->db->where('exam_pass_id', $student['exam_pass_id']);
				$this->db->update('pms_exam_pass', $update);

				$this->db->where('exam_pass_id', $student['exam_pass_id']);
				$sid = $this->db->get('pms_exam_pass')->row_array();
				
				$update = array(
					'company_requirement_interview_status' => $result
				);

				$this->db->where('student_id', $sid['student_id'] );
				$this->db->where('company_requirement_id', $comReqId);
				$this->db->where('company_id', $comId);
				$this->db->update('pms_student_applied_req', $update);
				
				$this->db->where('student_id', $sid['student_id'] );
				$this->db->where('company_requirement_id', $comReqId);
				$this->db->where('company_id', $comId);
				$checkInterview = $this->db->get('pms_interview_pass')->row_array();

				$notiEArray['student_id'] = $sid['student_id'];
				$notiEArray['student_notification_class'] = "fas fa-list-ol text-primary";
				$notiEArray['student_notification_detail'] = "You passed the exam for <strong>".$requirementInfo['company_requirement_name']."</strong> for ".$requirementInfo['company_requirement_post']." post at <i>".$requirementInfo['company_name']." </i>\nSend Your Resume to ".$comInfo['company_email']." before interview starts.";
				$notiEArray['student_notification_created_at'] = date('Y/m/d H:i:s', time());

				$notiIArray['student_id'] = $sid['student_id'];
				$notiIArray['student_notification_class'] = "fas fa-calendar-day text-danger";
				$notiIArray['student_notification_detail'] = "Interview starts from ".date('j F Y h:i A', strtotime($requirementInfo['company_requirement_exam_date']))." for <strong>".$requirementInfo['company_requirement_name']."</strong> for ".$requirementInfo['company_requirement_post']." post at <i>".$requirementInfo['company_name']."</i>";
				$notiIArray['student_notification_created_at'] = date('Y/m/d H:i:s', time());
					

				if ( ( empty($checkInterview) ) and ( $result == 1 ) ) {
					
					$data['student_id'] = $sid['student_id'] ;
					$data['company_requirement_id'] = $comReqId;
					$data['company_id'] = $comId;
					$this->db->insert('pms_interview_pass', $data);

					$this->db->insert( 'pms_student_notification', $notiEArray );

					$this->db->insert( 'pms_student_notification', $notiIArray );

				} elseif ( ( !empty($checkInterview) ) and ( $result == 0 ) ) {
					
					$this->db->where('interview_pass_id', $checkInterview['interview_pass_id']);
					$this->db->delete('pms_interview_pass');

					$this->db->where('student_id', $notiEArray['student_id']);
					$this->db->where('student_notification_detail', $notiEArray['student_notification_detail']);
					$this->db->delete('pms_student_notification');

					$this->db->where('student_id', $notiIArray['student_id']);
					$this->db->where('student_notification_detail', $notiIArray['student_notification_detail']);
					$this->db->delete('pms_student_notification');

				}
				
			}
		}
		
		redirect( base_url().'company/ExamResult/index/'.$comReqId.'/'.$comId );

	}
	
}
?>