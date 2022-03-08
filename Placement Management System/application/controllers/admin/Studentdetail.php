<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Studentdetail extends CI_Controller {

	public function __construct() {

		parent::__construct();

		// Session expire OR try to Login from the URL (Preventing)
		$admin = $this->session->userdata( 'admin' );

		if ( empty($admin) ) {
			$this->session->set_flashdata('msg', 'Your Session has been expired. Please try again.');
			redirect(base_url().'login/login/index');
		}

		// Acount Active / Deactive
		$this->load->model('Check_status_model');
		$adminStatus = $this->Check_status_model->checkStatus( $this->session->userdata['admin']['email'] );

		if ( $adminStatus != 1 ) {

			// Destroy session
			$this->session->set_flashdata('msg', 'Your account has been deactivated. Please contact administrator.');
			$this->session->unset_userdata( 'admin' );
			redirect(base_url().'login/login/index');
		}

	}

	public function index()	{

		$data = array();
        
		$this->load->model('Get_user_info_model');
		$userInfo = $this->Get_user_info_model->get_user_info( $this->session->userdata['admin']['email'] );
        
		$this->load->model('Users_model');
		$students = $this->Users_model->getAllStudents();
		
		$this->db->where('user_role', 'student');
		$status = $this->db->get('pms_users')->result_array();

		$data['userInfo'] = $userInfo;		
		$data['students'] = $students;
		$data['status'] = $status;		

		$this->load->view('admin/studentdetail', $data);
	}

	public function changeStatus( $id ) {

		$this->load->model('Change_status_model');
		$this->Change_status_model->changeStatus( $id );

		redirect(base_url().'admin/studentdetail/index');

	}

	public function resetPW( $id ) {
		
		$this->load->model('Change_password_model');
		
        $this->db->where('student_id', $id);
        $userInfo = $this->db->get('pms_student_info')->row_array();

		if ( $this->Change_password_model->changePassword(  $userInfo['student_email'], $userInfo['student_email'] ) ) {
			$this->session->set_flashdata('updateRSMsg','Password Reset successfully.');
		} else {
			$this->session->set_flashdata('updateRFMsg','Password Reset Failed.');
		}

		redirect(base_url().'admin/studentdetail/index');
	}

}

?>
