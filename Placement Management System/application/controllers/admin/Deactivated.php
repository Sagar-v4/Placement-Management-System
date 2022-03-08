<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Deactivated extends CI_Controller {

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
        
		$this->load->model('Deactivated_model');
		$admins = $this->Deactivated_model->getAllAdmins();
		$companys = $this->Deactivated_model->getAllCompanies();
		$students = $this->Deactivated_model->getAllStudents();

		$data['userInfo'] = $userInfo;		
		$data['admins'] = $admins;		
		$data['companys'] = $companys;		
		$data['students'] = $students;	
		
		$this->load->view('admin/deactivated', $data);
	}

	public function activate( $id ) {

		$update = array(
			'user_status' => 1
		);

		$this->db->where('user_id', $id);
		$this->db->update('pms_users', $update);
	
		redirect(base_url().'admin/deactivated/index');
		

	}
}

?>
