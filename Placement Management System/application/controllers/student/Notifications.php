<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Notifications extends CI_Controller {

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

	public function index()	{
		
		$this->load->model('Get_user_info_model');
		$userInfo = $this->Get_user_info_model->get_user_info($this->session->userdata['student']['email']);
		
		$this->load->model('Notification_fetch_model');
		$notifications = $this->Notification_fetch_model->get_Notifications();

		$quickNotifications = array();

		$data['userInfo'] = $userInfo;
		$data['notifications'] = $notifications;
		$data['quickNotifications'] = $quickNotifications;
		
		$update = array('student_notification_seen' => 1);
		$this->db->where('student_id', $userInfo['sid']);
		$this->db->update('pms_student_notification', $update);

		$this->load->view('student/notifications', $data);
	}
}
