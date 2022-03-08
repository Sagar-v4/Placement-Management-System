<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Interviews extends CI_Controller {

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
        
		$this->load->library('form_validation');
		$this->load->model('Get_user_info_model');
		$userInfo = $this->Get_user_info_model->get_user_info( $this->session->userdata['company']['email'] );
		
		$this->db->where('company_requirement_status', 1);
		$this->db->where('company_id', $userInfo['cid']);
		$requirements = $this->db->get('pms_company_requirements')->result_array();
		
		$i = 0;
		if ( !empty($requirements) ) { 
			foreach ($requirements as $requirement) { 
				$this->db->where('company_id', $requirement['company_id']);
				$pic = $this->db->get('pms_company_media')->row_array();

				$requirements[$i++]['company_requirement_pic'] = $pic['company_profile_pic'] ;
				
			}
		}
		
		$this->load->model('Notification_fetch_model');
		$quickNotifications = $this->Notification_fetch_model->get_quick_com_Notifications();
				
		$data['userInfo'] = $userInfo;
		$data['requirements'] = $requirements;
		$data['quickNotifications'] = $quickNotifications;

		$this->load->view('company/interviews', $data);
	}

	
	public function activation( $comReqId ) {

		$this->db->where('company_requirement_id', $comReqId );
		$req = $this->db->get('pms_company_requirements')->row_array();
		
		if ( $req['company_requirement_interview_status'] == 1) {			
			$update = array(
				'company_requirement_interview_status' => 0
			);
		} else {
			$update = array(
				'company_requirement_interview_status' => 1
			);
		}

		$this->db->where('company_requirement_id', $comReqId );
		$this->db->update('pms_company_requirements', $update );

		redirect(base_url().'company/interviews/index');

	}
}
