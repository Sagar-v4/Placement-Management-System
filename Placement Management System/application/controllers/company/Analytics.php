<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Analytics extends CI_Controller {

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

	public function index()	{
        
		$this->load->model('Get_user_info_model');
		$userInfo = $this->Get_user_info_model->get_user_info( $this->session->userdata['company']['email'] );

		$this->load->model('Notification_fetch_model');
		$quickNotifications = $this->Notification_fetch_model->get_quick_com_Notifications();
		
		$this->db->where('company_id', $userInfo['cid']);
		$totalPlaced = $this->db->count_all_results('pms_placed');
		
		$this->db->where('company_id', $userInfo['cid']);
		$this->db->where('company_requirement_status', 1);
		$totalActive = $this->db->count_all_results('pms_company_requirements');
		
		$this->db->where('company_id', $userInfo['cid']);
		$this->db->where('company_requirement_status', 0);
		$totalDeactive = $this->db->count_all_results('pms_company_requirements');
		
		$this->db->where('company_id', $userInfo['cid']);
		$totalReqs = $this->db->count_all_results('pms_company_requirements');
		
		$this->db->where('company_id', $userInfo['cid']);
		$applications =  $this->db->select('student_applied_req_status as status, count(*) as application')->group_by('student_applied_req_status')->get(' pms_student_applied_req')->result_array();
		
		$this->db->where('company_id', $userInfo['cid']);
		$exams =  $this->db->select('company_requirement_exam_status as exam, count(*) as status')->group_by('company_requirement_exam_status')->get(' pms_student_applied_req')->result_array();
		
		$this->db->where('company_id', $userInfo['cid']);
		$interviews =  $this->db->select('company_requirement_interview_status as interview, count(*) as status')->group_by('company_requirement_interview_status')->get(' pms_student_applied_req')->result_array();
		
		$data['userInfo'] = $userInfo;
		$data['quickNotifications'] = $quickNotifications;
		$data['totalPlaced'] = $totalPlaced;
		$data['totalActive'] = $totalActive;
		$data['totalDeactive'] = $totalDeactive;
		$data['totalReqs'] = $totalReqs;
		$data['applications'] = $applications;
		$data['exams'] = $exams;
		$data['interviews'] = $interviews;
		
		$this->load->view('company/analytics', $data);
	}
}
