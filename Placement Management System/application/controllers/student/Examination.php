<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Examination extends CI_Controller {

	public function __construct() {

		parent::__construct();

		// Session expire OR try to Login from the URL (Preventing)
		$student = $this->session->userdata( 'student' );

		if ( empty($student) ) {
			$this->session->set_flashdata('msg', 'Your Session has been expired. Please try again.');
			redirect(base_url().'login/login/index');
		}

		// Acount Active / Deactive
		$this->load->model('Check_status_model');
		$studentStatus = $this->Check_status_model->checkStatus( $this->session->userdata['student']['email'] );

		if ( $studentStatus != 1 ) {

			// Destroy session
			$this->session->set_flashdata('msg', 'Your account has been deactivated. Please contact administrator.');
			$this->session->unset_userdata( 'student' );
			redirect(base_url().'login/login/index');
		}
		
	}

    public function index( $comReqId, $comId, $queId = 0 ) {

		$this->load->library('form_validation');

		$this->load->model('Get_user_info_model');
		$userInfo = $this->Get_user_info_model->get_user_info( $this->session->userdata['student']['email'] );

		$this->db->where('company_requirement_id', $comReqId );
		$this->db->where('company_id', $comId );
		$requirement = $this->db->get('pms_company_requirements')->row_array();

		$this->db->where('company_requirement_id', $comReqId );
		$this->db->where('company_id', $comId );
		$examQues = $this->db->get('pms_company_requirement_exam_create')->result_array();

		$this->db->where('company_requirement_id', $comReqId );
		$this->db->where('company_id', $comId );
		$totalExamQues = $this->db->count_all_results('pms_company_requirement_exam_create');

		$this->db->where('company_requirement_id', $comReqId);
		$this->db->where('company_id', $comId);
		$this->db->where('student_id', $userInfo['sid']);
		$check = $this->db->get('pms_student_applied_req')->row_array();

		if (empty($check)){
			redirect( base_url().'student/profile/index', $userInfo);
		}

		$this->db->where('company_requirement_id', $comReqId);
		$this->db->where('company_id', $comId);
		$this->db->where('student_id', $userInfo['sid']);
		$ansSubmits = $this->db->get('pms_company_requirement_exam_submitted')->result_array();
		
		$i = 0;
		foreach ( $examQues as $exam) {
			$examQues[$i++]['ansSubmitted'] = NULL;
		}

		$i=0;
		foreach ($examQues as $exam) {
			foreach ( $ansSubmits as $ans) {

				if ( $exam['exam_question_id'] == $ans['exam_question_id'] ) {
					$examQues[$i]['ansSubmitted'] = $ans['option_submitted'];
				}

			} $i++;
		}
		$totalAnsSubmited = $i;
		
		date_default_timezone_set("Asia/Kolkata");
		$current = strtotime(date("Y-m-d H:i:s", time()));
		$start = strtotime( $requirement['company_requirement_exam_date'] );
		$end = strtotime( $requirement['company_requirement_exam_date_end'] );

		if ( ( $current > $start ) && ( $end > $current ) ) {
			
			$data['userInfo'] = $userInfo;
			$data['requirement'] = $requirement;
			$data['examQues'] = $examQues;
			$data['totalExamQues'] = $totalExamQues;
			$data['totalAnsSubmited'] = $totalAnsSubmited;

			$this->load->view('student/examination', $data);

		}
		else {
			redirect( base_url().'student/profile/index', $userInfo);

		}
    }

	public function save( $comReqId, $comId, $queId, $studId ) {

		$this->load->library('form_validation');
		date_default_timezone_set('Asia/Kolkata');
		
		
		$this->load->model('Get_user_info_model');
		$userInfo = $this->Get_user_info_model->get_user_info( $this->session->userdata['student']['email'] );

		
		$this->db->where('company_requirement_id', $comReqId);
		$this->db->where('company_id', $comId);
		$this->db->where('student_id', $studId);
		$check = $this->db->get('pms_student_applied_req')->row_array();

		if (empty($check)){
			redirect( base_url().'student/profile/index', $userInfo);
		}

		$this->db->where('company_requirement_id', $comReqId);
		$this->db->where('company_id', $comId);
		$requirement = $this->db->get('pms_company_requirements')->row_array();
		
		date_default_timezone_set("Asia/Kolkata");
		$current = strtotime(date('Y/m/d H:i:s', time()));
		$start = strtotime( $requirement['company_requirement_exam_date'] );
		$end = strtotime( $requirement['company_requirement_exam_date_end'] );

		if ( ( $current < $start ) && ( $end < $current ) ) {
			redirect( base_url().'student/profile/index', $userInfo);

		}


		$this->form_validation->set_rules('que'.$queId , 'Question '.$queId, 'trim|required');

		if ( $this->form_validation->run() == TRUE) { 
            
			$ansArray = array();

			$ansArray['company_requirement_id'] = $comReqId;
			$ansArray['company_id'] = $comId;
			$ansArray['exam_question_id'] = $queId;
			$ansArray['student_id'] = $studId;
			$ansArray['option_submitted'] = $this->input->post('que'.$queId);

			$this->db->where('exam_question_id', $queId);
			$correctAnswer = $this->db->get('pms_company_requirement_exam_create')->row_array();
			$ansArray['option_correct'] = $correctAnswer['option_correct'];
            $ansArray['student_presented_at'] = date('Y/m/d H:i:s', time());
            $ansArray['exam_question_submitted_at'] = date('Y/m/d H:i:s', time());

			$this->db->where('exam_question_id', $queId);
			$this->db->where('company_requirement_id', $comReqId);
			$this->db->where('company_id', $comId);
			$this->db->where('student_id', $studId);
			$ansSubmitId = $this->db->get('pms_company_requirement_exam_submitted')->row_array();

			if ( !empty($ansSubmitId) ) {

				$update = array(
					'option_submitted' => $ansArray['option_submitted'],
                    'exam_question_submitted_at' => date('Y/m/d H:i:s', time())
				);

				$this->db->where('exam_question_id', $queId);
				$this->db->where('company_requirement_id', $comReqId);
				$this->db->where('company_id', $comId);
				$this->db->where('student_id', $studId);
				
				$this->db->update('pms_company_requirement_exam_submitted', $update);
				
				$this->session->set_flashdata('queSSave','Question Updated Successfully.');
                redirect( base_url().'student/Examination/index/'.$comReqId.'/'.$comId.'/'.$queId );

			} elseif ( !empty($ansArray) ) {

                $this->db->insert('pms_company_requirement_exam_submitted', $ansArray);

				$this->session->set_flashdata('queSSave','Question Added Successfully.');
                redirect( base_url().'student/Examination/index/'.$comReqId.'/'.$comId.'/'.$queId );

			}
		} else {
			
			$this->session->set_flashdata('queESave','Incorrect Inputs.');
            redirect( base_url().'student/Examination/index/'.$comReqId.'/'.$comId.'/'.$queId );

		}
		
	}
}
?>