<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Notifications extends CI_Controller {

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
		$notifications = $this->Notification_fetch_model->get_com_Notifications();

		$quickNotifications = array();

		$data['userInfo'] = $userInfo;
		$data['notifications'] = $notifications;
		$data['quickNotifications'] = $quickNotifications;
		
		$update = array('company_notification_seen' => 1);
		$this->db->where('company_id', $userInfo['cid']);
		$this->db->update('pms_company_notification', $update);

		$this->load->view('company/notifications', $data);
	}
}
