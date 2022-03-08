<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Addadmin extends CI_Controller {

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
		
		$this->load->model('Get_user_info_model');
		$userInfo = $this->Get_user_info_model->get_user_info( $this->session->userdata['admin']['email'] );
		
		if ( $userInfo['power'] != 1 ) {
		    
		    $data['userInfo'] = $userInfo;
		    $this->load->view('admin/profile', $data);

		}

	}

	public function index()	{
        
		$this->load->model('Get_user_info_model');
		$userInfo = $this->Get_user_info_model->get_user_info( $this->session->userdata['admin']['email'] );
		
		$this->load->library('form_validation');
		
		if ( $userInfo['power'] == 1 ) {
		    
		    $this->load->view('admin/addadmin', $userInfo);

		} else {
		    
		    $data['userInfo'] = $userInfo;
		    $this->load->view('admin/profile', $data);
		
		}

	}

	public function authenticate() {

		// Load Libraries & Models
		$this->load->library('form_validation');
		$this->load->model('Admin_info_model');
		
		$this->form_validation->set_rules('first_name', 'First name', 'trim|required');
		$this->form_validation->set_rules('middle_name', 'Middle name', 'trim');
		$this->form_validation->set_rules('last_name', 'Last name', 'trim|required');
		$this->form_validation->set_rules('gender', 'Gender', 'trim|required');
		$this->form_validation->set_rules('dob', 'Dob', 'trim|required');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[pms_users.user_email]');
		$this->form_validation->set_rules('password', 'Password', 'trim|required');

		if ( $this->form_validation->run() == TRUE) {

			$adminArray = array();

			$adminArray['admin_first_name'] = $this->input->post('first_name');
			$adminArray['admin_middle_name'] = $this->input->post('middle_name');
			$adminArray['admin_last_name'] = $this->input->post('last_name');
			$adminArray['admin_gender'] = $this->input->post('gender');
			$adminArray['admin_email'] = $this->input->post('email');
			$adminArray['admin_password'] = password_hash( $this->input->post('password'), PASSWORD_DEFAULT);
			$adminArray['admin_dob'] = $this->input->post('dob');

			// Store Data In Database
			if ( !empty($adminArray) ) {

				// student array is not empty - success !
				$this->Admin_info_model->store_admin_data($adminArray);
				
				$emailArray['to'] = $this->input->post('email');
				$emailArray['subject'] = "Welcome";
				$emailArray['from'] = "pms.bussiness@gmail.com";
				$emailArray['msg'] = "Hello,".$adminArray['admin_first_name']." Thanks for Sign Up !!!";
				
				$this->load->model('Email_model');
				$this->Email_model->sendEmail($emailArray);

				$this->session->set_flashdata('signuplogAMsg','Admin account has been created successfully.');
				redirect( base_url().'admin/addadmin/index' );
		
			} else {

				// When Inserted Data is Empty - Failure !
				$this->session->set_flashdata('signupAMsg','Please insert data to create an accout.');
				// $this->load->view('admin/addadmin/index');
				$this->index();


			}

		} else {

			// Failure !
			$this->session->set_flashdata('signupAMsg','Please insert all the required fields with proper values to create an accout.');
			// $this->load->view('admin/addadmin');
			$this->index();
		}

	}
}

?>
