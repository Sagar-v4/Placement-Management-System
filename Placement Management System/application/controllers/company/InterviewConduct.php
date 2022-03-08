<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class InterviewConduct extends CI_Controller {

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

		$this->load->library('form_validation');

		$this->load->model('Get_user_info_model');
		$userInfo = $this->Get_user_info_model->get_user_info( $this->session->userdata['company']['email'] );

		$this->db->where('company_requirement_id', $comReqId );
		$this->db->where('company_id', $comId );
		$requirement = $this->db->get('pms_company_requirements')->row_array();

		$this->db->where('company_requirement_id', $comReqId );
		$this->db->where('company_id', $comId );
		$interviewStudents = $this->db->get('pms_interview_pass')->result_array();
		
		$this->db->where('company_requirement_id', $comReqId );
		$this->db->where('company_id', $comId );
		$totalCandidates = $this->db->count_all_results('pms_interview_pass');

        $i = 0;
        foreach ($interviewStudents as $interviewStudent) {

            $this->db->where('student_id', $interviewStudent['student_id'] );

            array_push($interviewStudents[$i] , $this->db->get('pms_student_info')->row_array() );

            $this->db->where('company_requirement_id', $comReqId );
            $this->db->where('company_id', $comId );
            $this->db->where('student_id', $interviewStudent['student_id'] );

            array_push($interviewStudents[$i++] , $this->db->get('pms_student_applied_req')->row_array() );

        }

		$data['requirement'] = $requirement;
		$data['interviewStudents'] = $interviewStudents;
		$data['totalCandidates'] = $totalCandidates;
		
		date_default_timezone_set("Asia/Kolkata");
		$current = strtotime(date("Y-m-d H:i:s", time()));
		$end = strtotime( $requirement['company_requirement_interview_date_end'] );
		
        if ( $current < $end ) {
            
    		if ( $userInfo['cid'] == $comId ) {
    			$this->load->view('company/interviewconduct', $data);
    		} else {
    			$data['heading'] = "404";
    			$data['message'] = "Page Not Found";
    
    			$this->load->view('errors/html/error_404', $data);
    		}
        }

    }

	public function save( $comReqId, $comId ) {

		$this->load->library('form_validation');
		date_default_timezone_set('Asia/Kolkata');
        
		$this->db->where('company_id', $comId);
		$this->db->where('company_requirement_id', $comReqId);
		$allStudents = $this->db->get('pms_interview_pass')->result_array();

		$this->db->where('company_requirement_id', $comReqId);
		$requirementInfo = $this->db->get('pms_company_requirements')->row_array();

        if ( ! empty($allStudents) ) {
            $i = 0;

            foreach ($allStudents as $student) {
                
				$allStudents[$i]['interview_time'] = $this->input->post('date'.$student['interview_pass_id']);
				$allStudents[$i]['interview_link']  = $this->input->post('link'.$student['interview_pass_id']);
				$allStudents[$i]['candidates_marks']  = $this->input->post('mark'.$student['interview_pass_id']);
				$allStudents[$i]['candidates_extra_detail']  = $this->input->post('details'.$student['interview_pass_id']);

                $update = array(
                    'interview_time' => (!empty($this->input->post('date'.$student['interview_pass_id'])) ? $this->input->post('date'.$student['interview_pass_id']) : NULL),
                    'interview_link' => (!empty($this->input->post('link'.$student['interview_pass_id'])) ? $this->input->post('link'.$student['interview_pass_id']) : NULL),
                    'candidates_marks' => (!empty($this->input->post('mark'.$student['interview_pass_id'])) ? $this->input->post('mark'.$student['interview_pass_id']) : NULL),
                    'candidates_extra_detail' => (!empty($this->input->post('details'.$student['interview_pass_id'])) ? $this->input->post('details'.$student['interview_pass_id']) : NULL),
                    'interview_pass_created_at' => date('Y/m/d H:i:s', time())
                );
                
                $this->db->where('interview_pass_id', $student['interview_pass_id']);
                $this->db->update('pms_interview_pass', $update );

				if ( (empty($update['candidates_marks']) or $update['candidates_marks'] == 0) and empty($update['candidates_extra_detail']) ) {
					$notiArray['student_id'] = $allStudents[$i]['student_id'];
					$notiArray['student_notification_class'] = "fas fa-clock text-danger";
					$notiArray['student_notification_detail'] = "Interview time ".date('h:i A', strtotime($update['interview_time']))." Date ".date('j F Y', strtotime($update['interview_time']))." for <strong>".$requirementInfo['company_requirement_name']."</strong> for ".$requirementInfo['company_requirement_post']." post at <i>".$requirementInfo['company_name']."</i>";
					$notiArray['student_notification_created_at'] = date('Y/m/d H:i:s', time());
					$this->db->insert( 'pms_student_notification', $notiArray );
				}

				$i++;
            }
        }

		redirect( base_url().'company/InterviewConduct/index/'.$comReqId.'/'.$comId );
        
	}
}
?>