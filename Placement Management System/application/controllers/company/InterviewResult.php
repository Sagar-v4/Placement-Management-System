<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class InterviewResult extends CI_Controller {

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

		$this->load->model('Get_user_info_model');
		$userInfo = $this->Get_user_info_model->get_user_info( $this->session->userdata['company']['email'] );

		$this->db->where('company_requirement_id', $comReqId );
		$this->db->where('company_id', $comId );
		$requirement = $this->db->get('pms_company_requirements')->row_array();
            
		$this->db->where('company_requirement_id', $comReqId );
		$this->db->where('company_id', $comId );
		$studentPassed = $this->db->get('pms_interview_pass')->result_array();
		
		$this->db->where('company_requirement_id', $comReqId );
		$this->db->where('company_id', $comId );
		$totalCandidates = $this->db->count_all_results('pms_interview_pass');
		
		$this->db->where('company_requirement_id', $comReqId );
		$this->db->where('company_id', $comId );
		$totalPlaced = $this->db->count_all_results('pms_placed');

        $studentPassInfos = array();
        $i = 0;
        if ( !empty($studentPassed)  ) {
            
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
            
        }
		
		$data['requirement'] = $requirement;
		$data['studentPassInfos'] = $studentPassInfos;
		$data['totalCandidates'] = $totalCandidates;
		$data['totalPlaced'] = $totalPlaced;
		
		date_default_timezone_set("Asia/Kolkata");
		$current = strtotime(date("Y-m-d H:i:s", time()));
		$end = strtotime( $requirement['company_requirement_interview_date_end'] );
		
        if ( $current > $end ) {
            
    		if ( $userInfo['cid'] == $comId ) {
    			$this->load->view('company/interviewresult', $data);
    		} else {
    			$data['heading'] = "404";
    			$data['message'] = "Page Not Found";
    
    			$this->load->view('errors/html/error_404', $data);
    		}
        }

    }

	
	public function placed( $comReqId, $comId ) {

        $this->load->library('form_validation');
        date_default_timezone_set('Asia/Kolkata');

		$this->db->where('company_id', $comId);
		$this->db->where('company_requirement_id', $comReqId);
		$allStudents = $this->db->get('pms_interview_pass')->result_array();
		
		$this->db->where('company_requirement_id', $comReqId);
		$requirementInfo = $this->db->get('pms_company_requirements')->row_array();

		if( !empty($allStudents) ) {
			foreach ($allStudents as $student) {

				$result = $this->input->post($student['interview_pass_id'],TRUE)==null ? 0 : 1;

				$update = array(
					'placement_pass' => $result
				);
				
				$this->db->where('interview_pass_id', $student['interview_pass_id']);
				$this->db->update('pms_interview_pass', $update);

				$this->db->where('interview_pass_id', $student['interview_pass_id']);
				$sid = $this->db->get('pms_interview_pass')->row_array();
								
				$this->db->where('student_id', $sid['student_id'] );
				$this->db->where('company_requirement_id', $comReqId);
				$this->db->where('company_id', $comId);
				$checkInterview = $this->db->get('pms_placed')->row_array();

				$notiArray['student_id'] = $sid['student_id'];
				$notiArray['student_notification_class'] = "fas fa-map-marked-alt text-success";
				$notiArray['student_notification_created_at'] = date('Y/m/d H:i:s', time());
				$notiArray['student_notification_detail'] = "Congratulations !!!<br>Your placed at <strong>".$requirementInfo['company_requirement_name']."</strong> for ".$requirementInfo['company_requirement_post']." post at <i>".$requirementInfo['company_name']."</i>";

				if ( ( empty($checkInterview) ) and ( $result == 1 ) ) {
					
					$data['student_id'] = $sid['student_id'] ;
					$data['company_requirement_id'] = $comReqId;
					$data['company_id'] = $comId;
					$data['interview_pass_id'] = $sid['interview_pass_id'];
					$data['placed_at'] = date('Y/m/d H:i:s', time());
					$this->db->insert('pms_placed', $data);

					$this->db->insert( 'pms_student_notification', $notiArray );

				} elseif ( ( !empty($checkInterview) ) and ( $result == 0 ) ) {
					
					$this->db->where('placed_id', $checkInterview['placed_id']);
					$this->db->delete('pms_placed');

					$this->db->where('student_id', $notiArray['student_id']);
					$this->db->where('student_notification_detail', $notiArray['student_notification_detail']);
				$notiArray['student_notification_created_at'] = date('Y/m/d H:i:s', time());
					$this->db->delete('pms_student_notification');



				}
				
			}
		}
		
		redirect( base_url().'company/InterviewResult/index/'.$comReqId.'/'.$comId );
	}
	
}
?>